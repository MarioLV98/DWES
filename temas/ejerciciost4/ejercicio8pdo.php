<?php

include "configuracion.php";
try {
    
    $conexion = new PDO($datosConexion,$usuario,$contraseña);
  
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if (!filter_has_var(INPUT_POST, 'Exportar')) {
        ?>
        <html lang="en" xmlns="http://www.w3.org/1999/html">
            <head>
            </head>
            <body>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <label for="Exportar"></label>
                    <input type="submit" name="Exportar" id="Exportar" value="Exportar">
                </form>
            </body>
        </html>
        <?PHP
    } else {
        $consulta = "SELECT * from Departamento"; //Consulta de todos los registros para generar la tabla
        $sentencia = $conexion->prepare($consulta); //Se almacena el resultado de la consulta
        $resultado = $sentencia->execute();
        //Cotenido del fichero XML
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><Departamentos></Departamentos>'); //creación del XML y su nodo raiz
        header("Content-type: text/xml");
        while ($reg = $sentencia->fetch(PDO::FETCH_OBJ)) {//Mientras haya resultados, se imprimen. FETCH avanza el puntero
            $departamento = $xml->addChild('Departamento'); //nuevo elemento hijo
            $departamento->addChild('CodDepartamento', $reg->CodDepartamento); //nuevo elemento hijo de departamento
            $departamento->addChild('DescDepartamento', $reg->DescDepartamento); //nuevo elemento hijo de departamento
        }
        $xml->asXML("Departamentos.xml"); //Se imprime el xml creado
    }
    //Cerramos la conexion
    unset($conexion);
} catch (PDOException $PdoE) {
    //Capturamos la excepcion en caso de que se produzca un error,mostramos el mensaje de error y deshacemos la conexion
    echo($PdoE->getMessage());
    unset($conexion);
}
?>