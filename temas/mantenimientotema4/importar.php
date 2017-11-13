<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="estilos.css">
        <title>Mantenimiento</title>
    </head>
    <body>   
        
         <ul>
            <li><a href="buscar.php">Buscar</a></li>
            <li><a href="insertar.php">Insertar</a></li>
            <li><a href="importar.php">Importar</a></li>
            <li><a href="">Exportar</a></li>
            
        </ul>
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
if(isset($_POST['cancelar'])) { 
        header('Location: buscar.php'); 
    } 
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
        <div>    
    <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

        <label for="fichero">Seleccione archivo XML:</label><br />
        <input type="file" id="fichero" name="fichero" >
        <br /><br />
        <input type="submit" name="Importar" value="Importar">
        <input type="submit" name="cancelar" value="Cancelar">

    </form>
            </div>
    <?PHP
} else {
    $bien=true;
    $registroserror = 0;
    $registrosbien = 0;
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
        
        try {
            $registrosbien++;
            $bien = $sentencia->execute();
            echo "Registro ".$registrosbien." insertado correctamente<br>";
        } catch (PDOException $PDOE) {
            $registroserror++;
            echo "Ha fallado la inserccion del registro: " . $registroserror."<br>";
            echo $PDOE->getMessage()."<br>";
            //Cerramos la conexion
           
        }
    }

   
        $conexion->commit();
    
    //Cerramos la conexion
    unset($conexion);
}
?>
 </body>
</html>



