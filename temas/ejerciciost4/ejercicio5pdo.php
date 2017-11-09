<?php

include "configuracion.php";
try {
     //Realizamos la conexion con la BD  usando los datos de configuracion.php
    $conexion = new PDO($datosConexion, $usuario, $contraseña);
    //Creamos los atributos para lanzar excepcion en caso de error
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $bien = true;
    //Realizamos la trasaccion desactivando el auto commit
    $conexion->beginTransaction();
    //consultas sql
    $c1 = "insert into Departamento (CodDepartamento,DescDepartamento) values('man','info1')";
    //Ejecutamos
    $conexion > exec($c1);
    $c2 = "insert into Departamento (CodDepartamento,DescDepartamento) values('ran','info2')";
    $conexion > exec($c2);
    $c3 = "insert into Departamento (CodDepartamento,DescDepartamento) values('pan','info2')";
    $conexion > exec($c3);
    //Si no se ejecuta bien se pone a false
    if (!$conexion->query($c1)) {
        $bien = false;
    }

    if (!$conexion->query($c2)) {
        $bien = false;
    }
    
    if (!$conexion->query($c3)) {
        $bien = false;
    }

    //Si bien esta a true se realizan los cambios si no se deshace todo
    if ($bien) {
        $conexion->commit();
        echo "Inserccion realizada";
    } else {
        $conexion->rollBack();
        echo "Error detectado";
    }
     //Cuando hayamos terminado cerramos la conexion
     unset($conexion);
} catch (PDOException $pdoe) {
     //Capturamos la excepcion
    echo($pdoe->getMessage());
     //En caso de error se cierra la conexion
    unset($conexion);
}
?>

