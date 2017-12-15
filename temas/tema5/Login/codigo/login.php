
<?php
//Autor: Mario Labra Villar
//Ultima modificación: 13/12/2017 
include '../configuracion.php';
include "../libreria/LibreriaValidacionFormulariosjc.php";
$error = false;
$arrayErrores = array(" ", "No ha introducido ningun valor<br />", "El valor introducido no es valido<br />", "Tamaño minimo no valido<br />", "Tamaño maximo no valido<br />", "El registro ya existe<br />", "El usuario no existe<br />", "Contraseña incorrecta<br />"); //array en el que se almacenan los diferentes tipos de errores que puede dar dependiendo del valor que devuelva la libreria al validar
$valida = 0;
$correcto = false;
try {
    $conexion = new PDO($datosConexion, $usuario, $contraseña);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $PdoE) {
    //Capturamos la excepcion en caso de que se produzca un error,mostramos el mensaje de error y deshacemos la conexion
    echo($PdoE->getMessage());
    unset($conexion);
}
$cuestionario = array(//En este array se almacenarán los datos
    'usuario' => '',
    'contrasena' => ''
);
$erroresCampos = array(//En este array se almacenan los posibles errores que puedan tener cada uno de los campos
    'usuario' => '',
    'contrasena' => ''
);
if (isset($_POST['cancelar'])) {
    header('Location:../indextema5.html');
}
if (filter_has_var(INPUT_POST, 'enviar')) { //SI SE PULSA EL BOTON DE ENVIAR SE REALIZARAN LAS VALIDACIONES
    $valida = validarCadenaAlfanumerica($_POST['usuario'], 1, 50);
    //Hacemos una consulta en la base de datos para comprobar si el usuario existe.
    try {
        $usu = $conexion->query("select usuario from Usuarios where usuario=\"" . $_POST['usuario'] . "\"");
        $res = $usu->fetchColumn(0);
    } catch (PDOException $pdoe) {
        echo $PdoE->getMessage() . "<br>";
        echo "<p>Error<p>";
    }
    $res2 = "";

    //Si no existe nos devuelve el error que le indicamos.
    if (!$res) {
        $erroresCampos['usuario'] = $arrayErrores[6];
        $error = true;
    } else { //Luego comprobamos que la contraseña es correcta
        try {
            $pass = $conexion->query("select * from Usuarios where usuario=\"" . $_POST['usuario'] . "\" and contrasena =sha2(\"" . $_POST['contrasena'] . "\",'256') ");
            $res2 = $pass->fetchColumn(0);
           
        } catch (PDOException $pdoe) {
            echo $pdoe->getMessage() . "<br>";
            echo "<p>Error<p>";
        }
    }
 
    //Si no es correcta devuelve el error que le indicamos.
    if (!$res2) {
        $erroresCampos['contrasena'] = $arrayErrores[7];
        $error = true;
    }
    if ($valida != 0) {
        $erroresCampos['usuario'] = $arrayErrores[$valida];
        $error = true;
    } else {
        $cuestionario['usuario'] = $_POST['usuario'];
    }
    $valida = validarCadenaAlfanumerica($_POST['contrasena'], 1, 20);
    if ($valida != 0) {
        $erroresCampos['contrasena'] = $arrayErrores[$valida];
        $error = true;
    } else {
        $cuestionario['contrasena'] = $_POST['contrasena'];
    }
}
//Si no se pulsa enviar o se produce un error se muestra el formulario
if (!filter_has_var(INPUT_POST, 'enviar') || $error) {
    ?>



    <?php
    //EN EL CASO EN EL QUE TODO HAYA IDO BIEN PROCESAMOS EL FORUMULARIO Y MOSTRAMOS LOS DATOS POR PANTALLA
} else {
    $consulta = "select * from Usuarios where usuario=:user and contrasena=:pw";
    //Preparamos la sentencia
    $sentencia = $conexion->prepare($consulta);
    $passwd = hash('sha256', $cuestionario['contrasena']);
    //Inyectamos los parametros del insert en el query
    $sentencia->bindParam(":user", $cuestionario['usuario']);
    $sentencia->bindParam(":pw", $passwd);

    //Ejecutamos la consulta
    try {
        $sentencia->execute();
        if ($sentencia->rowCount() != 0) { //Si devuelve algun resultado es correcto, con lo cual accedemos.
            $correcto = true;
        }
    } catch (PDOException $PdoE) {
        echo $PdoE->getMessage() . "<br>";
        echo "<p>Error<p>";
    }
    unset($conexion);

    if ($correcto) {
        session_start();
        $_SESSION['usuario'] = $cuestionario['usuario'];
        header('Location:programa.php');
    }
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="../estilos.css">
    </head>
    <body>

        <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" id="formulario1" method="post">

            <div id="encuesta">
                <h4>Login</h4>
                <label for="usuario">Usuario:</label><br />
                <input type="text" name="usuario" value="<?PHP echo $cuestionario['usuario']; ?>"><br />
                <p id="err"><?PHP echo $erroresCampos['usuario']; ?></p>

                <label for="contrasena">Contraseña:</label><br />
                <input type="password" name="contrasena" value="<?PHP echo $cuestionario['contrasena']; ?>"><br />
                <p id="err"><?PHP echo $erroresCampos['contrasena']; ?></p>

                <input type="submit" name="enviar" value="Enviar"/>
                <input type="submit" name="cancelar" value="Cancelar"/>

                <p>No tienes cuenta?<a href="registro.php">Registrate</a></p>

                </div>
        </form>
        
        <img src="imagenes/modeloDeDatos.PNG" alt="Funcionamiento"/>
        <img src="imagenes/almacenamiento2.PNG" alt="Almacenamiento"/>
        <img src="imagenes/programaModelo.PNG" alt=""/>
        <footer>

        </footer>
    </body>
</html>