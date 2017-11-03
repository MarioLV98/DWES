<?php

include "conexion.php";

try {

    $conexion = new PDO($datosConexion, $usuario, $contraseña);

    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo ("Conexion establecida exitosamente");
} catch (PDOException $Pdoe) {
    echo "Error";
    echo($Pdoe->getMessage());
    unset($conexion);
}
?>

