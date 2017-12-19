<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="../../estilos.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>Pagina Administracion</title>
    </head>
    <body>

        <?php
        session_start();
//Si no hay usuario nos redirige al login
        if (!empty($_SESSION['usuario'])) {
            //Añadimos el fichero con los datos de la conexion
            //Añadimos el fichero con la libreria de validacion
            include '../../configuracion.php';
            include "../libreria/LibreriaValidacionFormulariosjc.php";
            define("MIN", 1);
            define("MAX", 3);
            $arrayErrores = array(" ", "No ha introducido ningun valor<br />", "El valor introducido no es valido<br />", "Tamaño minimo no valido<br />", "Tamaño maximo no valido<br />");
            $error = false;
            $valida = 0;
            $nombreuser = "";
            $erroruser = "";

            //SI SE PULSA EL BOTON ENVIAR SE REALIZARA LA VALIDACION DE LOS DATOS INRODUCIDOS
            if (filter_has_var(INPUT_POST, 'filtrar')) {
                $valida = validarCadenaAlfanumerica($_POST['nombreuser'], 1, 15);
                if ($valida != 0) {
                    $erroruser = $arrayErrores[$valida];
                    $error = true;
                } else {
                    $nombreuser = $_POST['nombreuser'];
                }
            }
            //SI NO SE HA PULSADO ENVIAR O SI HAY UN ERROR NOS MUESTRA EL FORMULARIO
            ?>
            <div>
                <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <h2>Buscar</h2>
                    <label for="nombreuser">Descripcion:</label><br />
                    <input type="text" name="nombreuser" value="<?php echo $nombreuser ?>"<br />
                    <?PHP echo $erroruser ?>
                    <input id="boton" type="submit" name="filtrar" value="Buscar">
                    <input id="boton" type="submit" name="salir" value="Salir">

                </form>
            </div>    
            <?PHP
            if (isset($_POST['salir'])) {
                session_destroy();
                header('Location:login.php');
            }

            try {
                //Realizamos la conexion con la BD  usando los datos de configuracion.php
                $conexion = new PDO($datosConexion, $usuario, $contraseña);
                //Creamos los atributos para lanzar excepcion en caso de error
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //Orden sql
                $orden = "select * from Usuarios where usuario like concat('%',:user,'%')";
                //Preparamos la consulta
                $sql = $conexion->prepare($orden);
                //Pasamos los parametros al query
                $sql->bindParam(":user", $nombreuser);
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
                        . "<td>" . $cuestionario->usuario . "</td>"
                        . "<td>" . $cuestionario->contrasena . "</td>"
                        . "<td><a href='editarUsuarioadmin.php?usuario=$cuestionario->usuario'><i class=\"material-icons\">create</i></a><a href='borrar2.php?usuario=$cuestionario->usuario'> <i class=\"material-icons\">delete</i> </a><td>"
                        . "</tr>";
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
        }else{
    header('Location:login.php');
}
            ?>

        <footer>
            <h3>Mario Labra Villar</h3>
        </footer>
    </body>
</html>

