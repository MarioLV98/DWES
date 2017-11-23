<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="estilos.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>Exportar</title>
    </head>
    <body>
         <h2>Exportar</h2>
        <?php
           include 'configuracion.php';
try { 
   
    $conexion = new PDO($datosConexion,$usuario,$contraseña); 
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    $xml = new DomDocument('1.0', 'UTF-8'); 
    $departamentos = $xml->createElement('Departamentos'); 
    $departamentos = $xml->appendChild($departamentos); 

    $sql = "select CodDepartamento,DescDepartamento from Departamento"; 
    $resultado = $conexion->query($sql);   

   
    while ($objeto = $resultado->fetch(PDO::FETCH_OBJ)) { 
        $cuestionario = $xml->createElement('Departamento'); 
        $cuestionario = $departamentos->appendChild($cuestionario); 
        $cod = $xml->createElement('Codigo',$objeto->CodDepartamento); 
        $cod = $cuestionario->appendChild($cod); 
        $desc = $xml->createElement('Descripcion',$objeto->DescDepartamento); 
        $desc = $cuestionario->appendChild($desc); 
    } 
    $xml->formatOutput = true; 
    $xml->saveXML(); 
    $xml->save('Departamentos.xml'); 

    highlight_file("Departamentos.xml"); 
    echo "<a href='buscar.php'><button>Volver</button></a>"; 
}catch (PDOException $exception) { 
    echo $exception->getMessage(); 
    unset($conexion); 
}
        ?>
    </body>
</html>
