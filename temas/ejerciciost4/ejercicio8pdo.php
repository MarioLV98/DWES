<?php
try {

    include 'configuracion.php';
    //Realizamos la conexion con la BD  usando los datos de configuracion.php   
    $conexion = new PDO($datosConexion, $usuario, $contraseña);
    //Creamos los atributos para lanzar excepcion en caso de error
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $error = false;


    //Si no hemos pulsado el boton, o ha habido un error en la validacion mostrarmos el formulario
    if (!filter_has_var(INPUT_POST, 'Exportar') || $error) {
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
        $sentencia = $conexion->query($consulta); //Se almacena el resultado de la consulta
        $resultado = $sentencia->execute();
        //Cotenido del fichero XML
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?> <Departamentos></Departamentos>'); //creación del XML y su nodo raiz
        header("Content-type: text/xml");
        while ($registro = $resultado->fetch(PDO::FETCH_OBJ)) {//Mientras haya resultados, se imprimen. FETCH avanza el puntero
            $departamento = $xml->addChild('Departamento'); //nuevo elemento hijo
            $departamento->addChild('CodDepartamento', $registro->CodDepartamento); //nuevo elemento hijo de departamento
            $departamento->addChild('DescDepartamento', $registro->DescDepartamento); //nuevo elemento hijo de departamento
        }
        print($xml->asXML()); //Se imprime el xml creado
        //
    }
    //Cerramos la conexion
    unset($conexion);
} catch (PDOException $PDOE) {
    echo $PDOE->getMessage();
    //Cerramos la conexion
    unset($conexion);
}


