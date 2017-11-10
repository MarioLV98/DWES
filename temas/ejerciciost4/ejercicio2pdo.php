<?php

include "configuracion.php";

try {
    //Realizamos la conexion con la BD  usando los datos de configuracion.php
    $conexion = new PDO($datosConexion, $usuario, $contraseña);
    //Creamos los atributos para lanzar excepcion en caso de error
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     //Orden sql
    $sql = "select * from Departamento";
    //Ejecutamos la consulta
   $res =  $conexion->query($sql);
    //Si hay resultados se mostraran
    while ($departamento=$res->fetch(PDO::FETCH_OBJ)){
        echo "Codigo de departamento: ".$departamento->CodDepartamento."<br>";
        echo "Descripcion departamento: ".$departamento->DescDepartamento."<br>";
        echo "Fecha expriacion: ".$departamento->FechaBaja."<br><br>";   
    }
    //Cuando hayamos terminado cerramos la conexion
     unset($conexion);
     //Capturamos la excepcion
} catch (PDOException $Pdoe) {
    echo "Error";
    echo($Pdoe->getMessage());
    //En caso de error se cierra la conexion
    unset($conexion);
}
?>
