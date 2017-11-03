<?php

include "conexion.php";
$conexion = new PDO($datosConexion, $usuario, $contraseña);

try {
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $consulta = "select * from Departamento";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute();
    $registros= $sentencia->rowCount();
    
    while($departamento=$sentencia->fetch(PDO::FETCH_OBJ)){
        echo "Codigo de departamento: ".$departamento->CodDepartamento."<br>";
        echo "Descripcion departamento: ".$departamento->DescDepartamento."<br>";
        echo "Fecha expriacion: ".$departamento->FechaBaja."<br><br>";
        
        
    }
} catch (PDOException $Pdoe) {
    echo "Error";
    echo($Pdoe->getMessage());
    unset($conexion);
}
?>
