<?php
try {

    include 'configuracion.php';
    //Realizamos la conexion con la BD  usando los datos de configuracion.php   
    $conexion = new PDO($datosConexion, $usuario, $contraseña);
    //Creamos los atributos para lanzar excepcion en caso de error
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $error = false;

    if (filter_has_var(INPUT_POST, 'Importar')) {//Si hemos pulsado el boton de Enviar
        $xml_file = $_FILES['fichero']['tmp_name']; //Archivo xml a cargar
        if (file_exists($xml_file)) { //Si existe, se carga
            $xml = simplexml_load_file($xml_file);
        } else {//si no existe, error
            $error = true;
            unset($conexion);
        }
    }

    //Si no hemos pulsado el boton, o ha habido un error en la validacion mostrarmos el formulario
    if (!filter_has_var(INPUT_POST, 'Importar') || $error) {
        ?>
        <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

            <label for="fichero">Seleccione archivo XML:</label><br />
            <input type="file" id="fichero" name="fichero" >
            <br /><br />
            <input type="submit" name="Importar" value="Importar">

        </form>
        <?PHP
    } else {
        $registros = 0;
        //Recorremos nuestro fichero XML 
        echo $xml->Departamento;
        foreach ($xml->Departamento as $departamento) {
            //Creamos la consulta sql
            $consulta = "INSERT INTO Departamento (CodDepartamento,DescDepartamento) VALUES (:CodDepartamento,:DescDepartamento)";
             //Preparamos la consulta
            $result = $conexion->prepare($consulta);
             //Pasamos los datos a la consulta para que se inserten
            $result->bindParam(":CodDepartamento", $departamento->CodDepartamento);
            $result->bindParam(":DescDepartamento", $departamento->DescDepartamento);

            if ($result->execute()) {
                $registros++;
            }
        }
        echo ("Se han insertado " . $registros . " registros");
    }
    //Cerramos la conexion
    unset($conexion);
} catch (PDOException $PDOE) {
    echo $PDOE->getMessage();
    //Cerramos la conexion
    unset($conexion);
}

