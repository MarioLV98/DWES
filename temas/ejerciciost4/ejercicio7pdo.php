<?php
 include 'configuracion.php';
try {
    //Realizamos la conexion con la BD  usando los datos de configuracion.php   
    $conexion = new PDO($datosConexion, $usuario, $contraseña);
    //Creamos los atributos para lanzar excepcion en caso de error
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $PDOE) {
    echo $PDOE->getMessage();
    //Cerramos la conexion
   
}
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
    $bien=true;
    $registros = 0;
    //Recorremos nuestro fichero XML 
    $conexion->beginTransaction();
    //Creamos la consulta sql
    $consulta = "insert into Departamento (CodDepartamento,DescDepartamento) values (:CodDepartamento,:DescDepartamento)";
    //Preparamos la consulta
    $sentencia = $conexion->prepare($consulta);
    $codigo="";
    $descripcion="";
    //Pasamos los datos a la consulta para que se inserten
    $sentencia->bindParam(":CodDepartamento", $codigo);
    $sentencia->bindParam(":DescDepartamento", $descripcion);
    echo $xml->Departamento;
    foreach ($xml->Departamento as $departamento) {
        $codigo = $departamento->CodDepartamento;
        $descripcion = $departamento->DescDepartamento;
        $registros++;
        try {
            
            $bien = $sentencia->execute();
        } catch (PDOException $PDOE) {

            echo "Ha fallado la inserccion del registro: " . $registros."<br>";
            echo $PDOE->getMessage()."<br>";
            //Cerramos la conexion
           
        }
    }

    if ($bien) {
        $conexion->commit();
        echo "Inserccion realizada";
    }
    //Cerramos la conexion
    unset($conexion);
}



