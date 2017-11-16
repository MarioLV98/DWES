<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="estilos.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>Borrado</title>
    </head>
    <body>
<?php
    include 'configuracion.php';
    try{
        //Realizamos la conexion con la BD  usando los datos de configuracion.php
                $conexion = new PDO($datosConexion,$usuario,$contraseña);
                //Creamos los atributos para lanzar excepcion en caso de error
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //Orden sql
                $borrarCodDepartamento=$_GET['CodDepartamento'];
                ?>
<form action="<?PHP echo $_SERVER['PHP_SELF']."?CodDepartamento=$borrarCodDepartamento" ?>" method="post">
    <p>Seguro que quiere borrar <?php echo $borrarCodDepartamento ?> ?</p>
    <input type="submit" name="si" value="si"/> 
    <input type="submit" name="no" value="no"/> 
    
</form>
    <?php
        if(isset($_POST["si"])){
                $orden = "delete from Departamento where CodDepartamento=:CodDepartamento";
                //Preparamos la consulta
                $sql = $conexion->prepare($orden);
                //Pasamos los parametros al query
                $sql->bindParam(":CodDepartamento", $borrarCodDepartamento);
                //Ejecutamos la orden sql
                if($sql->execute()){
                    header('Location:buscar.php');
                }
                unset($conexion);
                header('Location: buscar.php');
        }
        if(isset($_POST["no"])){
            header('Location:buscar.php');
        }
    }catch(PDOException $pdoe){
        echo $pdoe->getMessage();
        echo "No se puede borrar";
        unset($conexion);
    }

?>
</body>
</html>