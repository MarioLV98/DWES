<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="estilos.css">
        <title>8pdo</title>
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
   
}catch (PDOException $exception) { 
    echo $exception->getMessage(); 
    unset($conexion); 
}
        ?>
    </body>
</html>