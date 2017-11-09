<?php

include "configuracion.php";

try {
    //Realizamos la conexion con la BD  usando los datos de configuracion.php
    $conexion = new PDO($datosConexion, $usuario, $contraseña);
    //Creamos los atributos para lanzar excepcion en caso de error
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Mostramos algunos datos para ver que la conexion se ha realizado correctamente
    echo "Cliente: ".$conexion->getAttribute(PDO::ATTR_CLIENT_VERSION);
  //Cuando hayamos terminado cerramos la conexion
     unset($conexion);
  //Capturamos la excepcion   
} catch (PDOException $Pdoe) {
    echo "Error en la conexion: <br>";
    echo $Pdoe->getMessage();
    unset($conexion);
}
?>

