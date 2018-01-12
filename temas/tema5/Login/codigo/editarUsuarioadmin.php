<?php
//Autor: Mario Labra Villar
//Ultima modificación: 1/12/2017 
include '../../configuracion.php';
include "../libreria/LibreriaValidacionFormulariosjc.php";
$error = false;
$arrayErrores = array(" ", "No ha introducido ningun valor<br />", "El valor introducido no es valido<br />", "Tamaño minimo no valido<br />", "Tamaño maximo no valido<br />", "El registro ya existe<br />", "El usuario no existe<br />", "Contraseña incorrecta<br />", "El usuario ya existe<br />"); //array en el que se almacenan los diferentes tipos de errores que puede dar dependiendo del valor que devuelva la libreria al validar
$valida = 0;
$correcto = false;

session_start();
 $userName = $_GET['usuario'];
 echo "Usuario pasado".$userName;
if (!empty($_SESSION['usuario'])) {
    try {
        $conexion = new PDO($datosConexion, $usuario, $contraseña);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $PdoE) {
        //Capturamos la excepcion en caso de que se produzca un error,mostramos el mensaje de error y deshacemos la conexion
        echo($PdoE->getMessage());
    }
    $cuestionario = array(//En este array se almacenarán los datos
        'usuario' => '',
        'contrasena' => ''
    );
    
    $cuestionario['usuario']=$userName;
    $erroresCampos = array(//En este array se almacenan los posibles errores que puedan tener cada uno de los campos
        'usuario' => '',
        'contrasena' => ''
    );
    if (isset($_POST['cancelar'])) {
        header('Location:login.php');
    }
    if (filter_has_var(INPUT_POST, 'enviar')) { //SI SE PULSA EL BOTON DE ENVIAR SE REALIZARAN LAS VALIDACIONES
        $valida = validarCadenaAlfanumerica($_POST['usuario'], 1, 50);

        if ($valida != 0) {
            $erroresCampos['usuario'] = $arrayErrores[$valida];
            $error = true;
        } else {
            $cuestionario['usuario'] = $userName;
        }
        $valida = validarCadenaAlfanumerica($_POST['contrasena'], 1, 20);
        if ($valida != 0) {
            $erroresCampos['contrasena'] = $arrayErrores[$valida];
            $error = true;
        } else {
            $cuestionario['contrasena'] = $_POST['contrasena'];
        }
    }
    if (!filter_has_var(INPUT_POST, 'enviar') || $error) {
        ?>


        <?php
        //EN EL CASO EN EL QUE TODO HAYA IDO BIEN REALIZAMOS LAS MODIFICACIONES PERTINENTES EN EL USUARIO
    } else {
        
        $consulta = "update Usuarios set contrasena=:pw where usuario=:user ";
        //Preparamos la sentencia
        $sentencia = $conexion->prepare($consulta);
        $passwd = hash('sha256', $cuestionario['contrasena']);
        //Inyectamos los parametros del insert en el query
        $sentencia->bindParam(":user", $cuestionario['usuario']);
        $sentencia->bindParam(":pw", $passwd);

        //Ejecutamos la consulta
        try {
            if($sentencia->execute()){
           header('Location:administracion.php');
            }
        } catch (PDOException $PdoE) {
            echo $PdoE->getMessage() . "<br>";
            echo "<p>Inserccion erronea<p>";
            echo "<a href='index.php'><button>Volver</button></a>";
        }
        unset($conexion);

       
    }
} else {

    header('Location:login.php');
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cambiar contraseña</title>
        <link rel="stylesheet" type="text/css" href="../../estilos.css">
    </head>
    <body>

        <form action="<?PHP echo $_SERVER['PHP_SELF'] . "?usuario=$userName"; ?>" id="formulario1" method="post">

            <div id="encuesta">
                <h4>Cambiar contraseña</h4>
                <label for="usuario">Usuario:</label><br />
                <input type="text" name="usuario" value="<?PHP echo $cuestionario['usuario'] ?>" readonly><br />
                <p id="err"><?PHP echo $erroresCampos['usuario']; ?></p>

                <label for="contrasena">Contraseña:</label><br />
                <input type="password" name="contrasena" value="<?PHP echo $cuestionario['contrasena']; ?>"><br />
                <p id="err"><?PHP echo $erroresCampos['contrasena']; ?></p>

                <input type="submit" name="enviar" value="Cambiar contraseña"/>
                <input type="submit" name="cancelar" value="Cancelar"/>


        </form>


        <footer>

        </footer>
    </body>
</html>