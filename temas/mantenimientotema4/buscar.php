<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="estilos.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>Buscar</title>
    </head>
    <body>

        <ul>
            <li><a href="buscar.php"><i class="material-icons">search</i>Buscar</a></li>
            <li><a href="insertar.php"><i class="material-icons">add</i>Insertar</a></li>
            <li><a href="importar.php"><i class="material-icons">cloud_download</i>Importar</a></li>
            <li><a href="exportar.php"><i class="material-icons">cloud_upload</i>Exportar</a></li>
            <li><a href="../tema4/indextema4.html"><i class="material-icons">trending_flat</i>Salir</a></li>
            
        </ul>
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
        $DescDepartamento = "";
        $ErrorDepartamento = "";
        //SI SE PULSA EL BOTON ENVIAR SE REALIZARA LA VALIDACION DE LOS DATOS INRODUCIDOS
        if (filter_has_var(INPUT_POST, 'filtrar')) {
            $valida = validarCadenaAlfanumerica($_POST['DescDepartamento'], 1, 15);
            if ($valida != 0) {
                $ErrorDepartamento = $arrayErrores[$valida];
                $error = true;
            } else {
                $DescDepartamento = $_POST['DescDepartamento'];
            }
        }
        //SI NO SE HA PULSADO ENVIAR O SI HAY UN ERROR NOS MUESTRA EL FORMULARIO
       
            ?>
        <div>
            <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method="post">
                 <h2>Buscar</h2>
                <label for="DescDepartamento">Descripcion:</label><br />
                <input type="text" name="DescDepartamento" value="<?php echo $DescDepartamento ?>"<br />
                <?PHP echo $ErrorDepartamento ?>
                <input id="boton" type="submit" name="filtrar" value="Buscar">

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
                $sql->bindParam(":DescDepartamento", $DescDepartamento);
                //Ejecutamos la orden sql
                $sql->execute();
                //Mostramos datos mientras los hacha con el Fetch
                ?>
        
        <table border="1">
            <tr>
                <th>Codigo Dpto</th>
                <th>Descripcion</th>
                <th>Modificaciones</th>
            </tr>
                <?PHP
                while ($cuestionario = $sql->fetch(PDO::FETCH_OBJ)) {
                    
                   echo "<tr>" 
           ."<td>".$cuestionario->CodDepartamento."</td>" 
           ."<td>".$cuestionario->DescDepartamento."</td>"                
           ."<td><a href='modificar.php?CodDepartamento=$cuestionario->CodDepartamento'><i class=\"material-icons\">create</i></a><a href='borrar2.php?CodDepartamento=$cuestionario->CodDepartamento'> <i class=\"material-icons\">delete</i> </a><td>"                
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

        <footer>
            <h3>Mario Labra Villar</h3>
        </footer>
    </body>
</html>

