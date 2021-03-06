<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="estilos.css">
        <title>Ejercicio 4</title>
    </head>
    <body>


        <?php
        //Añadimos el fichero con los datos de la conexion
        //Añadimos el fichero con la libreria de validacion
        include 'configuracion.php';
        include "LibreriaValidacionFormulariosjc.php";
        define("MIN", 1);
        define("MAX", 3);
        $arrayErrores = array(" ", "No ha introducido ningun valor<br />", "El valor introducido no es valido<br />", "Tamaño minimo no valido<br />", "Tamaño maximo no valido<br />");
        $error = false;
        $valida = 0;
        $nombreuser = "";
        $erroruser = "";
        //SI SE PULSA EL BOTON ENVIAR SE REALIZARA LA VALIDACION DE LOS DATOS INRODUCIDOS
        if (filter_has_var(INPUT_POST, 'filtrar')) {
            $valida = validarCadenaAlfanumerica($_POST['DescDepartamento'], 1, 15);
            if ($valida != 0) {
                $erroruser = $arrayErrores[$valida];
                $error = true;
            } else {
                $nombreuser = $_POST['DescDepartamento'];
            }
        }
        //SI NO SE HA PULSADO ENVIAR O SI HAY UN ERROR NOS MUESTRA EL FORMULARIO
       
            ?>
        <div>
            <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label for="DescDepartamento">Descripcion:</label><br />
                <input type="text" name="DescDepartamento" value="<?php echo $nombreuser ?>"<br />
                <?PHP echo $erroruser ?>
                <input id="boton" type="submit" name="filtrar" value="Filtrar">

            </form>
        </div>    
            <?PHP
       
            try {
                //Realizamos la conexion con la BD  usando los datos de configuracion.php
                $conexion = new PDO($datosConexion,$usuario,$contraseña);
                //Creamos los atributos para lanzar excepcion en caso de error
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //Orden sql
                $orden = "select * from Departamento where DescDepartamento like concat('%',:DescDepartamento,'%')";
                //Preparamos la consulta
                $sql = $conexion->prepare($orden);
                //Pasamos los parametros al query
                $sql->bindParam(":DescDepartamento", $nombreuser);
                //Ejecutamos la orden sql
                $sql->execute();
                //Mostramos datos mientras los hacha con el Fetch
                ?>
        
        <table border="1">
            <tr>
                <th>Codigo Dpto</th>
                <th>Descripcion</th>          
            </tr>
                <?PHP
                while ($cuestionario = $sql->fetch(PDO::FETCH_OBJ)) {
                    
                   echo "<tr>" 
           ."<td>".$cuestionario->CodDepartamento."</td>" 
           ."<td>".$cuestionario->DescDepartamento."</td>"
           ."</tr>"; 
                }
                 ?>
        </table>
        <?PHP
                   
               
                //Cuando hayamos terminado cerramos la conexion
                unset($conexion);
                //Capturamos la excepcion
            } catch (PDOException $pdoe) {
                echo "Error: ";
                echo $pdoe->getMessage();
                //En caso de error se cierra la conexion
                unset($conexion);
            }
        
        ?>


    </body>
</html>

