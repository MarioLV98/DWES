<?php
//Iniciamos la sesion
session_start();
//Si no hay usuario nos redirige al login
if (!empty($_SESSION['usuario'])) {
    //Creamos una cookiea para la ultima conexion
    setcookie("fecha_ultima_conexion", date("j, n, Y, g:i a"), time() + 3600);
    //Si se pulsa salir, se cierra la sesion
    if (isset($_POST['salir'])) {
        session_destroy();
        header('Location:login.php');
    }
    //Si se pulsa detalle, nos lleva a detalle
    if (isset($_POST['detalle'])) {
        header('Location:detalle.php');
    }

    if (isset($_POST['editar'])) {
        header('Location:editarusuario.php');
    }

    echo "<h1>Bienvenido " . $_SESSION['usuario'] . "La ultima conexion fue" . $_COOKIE['fecha_ultima_conexion'] . ";</h1>";

    echo "<h1>SERVER</h1><br>";

//Mostramos $_SERVER[]
    foreach ($_SERVER as $clave => $valor) {

        echo $clave . ":" . $valor . "</br>";
    }

    echo "<h1>COOCKIE</h1><br>";
//Mostramos $_COOKIE[]
    foreach ($_COOKIE as $claveK => $valorK) {

        echo $claveK . ":" . $valorK . "</br>";
    }

    echo "<h1>SESSION</h1><br>";
//Mostramos $_SESSION[]
    foreach ($_SESSION as $claveS => $valorS) {

        echo $claveS . ":" . $valorS . "</br>";
    }
//Si la fecha de ultima conexion esta vacia nos dice que no hay, si contiene un valor la muestra
    if (empty($_COOKIE['fecha_ultima_conexion'])) {

        echo "No hay fecha definida";
    } else {

        echo "La ultima conexion fue" . $_COOKIE['fecha_ultima_conexion'];
    }
} else {

    header('Location:login.php');
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="../estilos/estilos.css">
    </head>
    <body>
        <form id="formulario" name="salir" action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="submit" name="salir" value="Salir"/>
            <input type="submit" name="editar" value="Editar Usuario"/>
            <input type="submit" name="detalle" value="Detalle"/>

        </form>

        <footer>

        </footer>
    </body>
</html>        

