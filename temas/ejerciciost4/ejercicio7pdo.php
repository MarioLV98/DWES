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
    $registroserror = 0;
    $registrosbien = 0;
    //Creamos la consulta sql
    $consulta = "insert into Departamento (CodDepartamento,DescDepartamento) values (:CodDepartamento,:DescDepartamento)";
    //Preparamos la consulta
    $sentencia = $conexion->prepare($consulta);
    $cod="";
    $desc="";
    //Pasamos los datos a la consulta para que se inserten
    $sentencia->bindParam(":CodDepartamento", $cod);
    $sentencia->bindParam(":DescDepartamento", $desc);
    echo $xml->Departamento;
    foreach ($xml->Departamento as $cuestionario) {
        $cod = $cuestionario->CodDepartamento;
        $desc = $cuestionario->DescDepartamento;
        
        try {
            $registrosbien++;
            $bien = $sentencia->execute();
        } catch (PDOException $PDOE) {
            $registroserror++;
            echo $PDOE->getMessage()."<br>";
            //Cerramos la conexion
           
        }
    }
    
    echo $registrosbien." insercciones realizadas<br>";
    echo $registroserror." insercciones fallidas<br>";

   
       
    
    //Cerramos la conexion
    unset($conexion);
}



