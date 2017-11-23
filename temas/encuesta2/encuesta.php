<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Encuesta</title>
        <link rel="stylesheet" type="text/css" href="estilos.css">
    </head>
    <body>
        <?php
        //Autor: Mario Labra Villar
        //Ultima modificación: 17/11/2017 
        include 'configuracion.php';
        include "LibreriaValidacionFormulariosjc.php";

        define("MIN", 5);       //Constante que indica minimo de valores de campo de texto
        define("MAX", 30);      //Constante que indica maximo de valores de campo de texto
        define("DIMENSION", 3); //Tamaño array
        $error = false;
        $arrayErrores = array(" ", "No ha introducido ningun valor<br />", "El valor introducido no es valido<br />", "Tamaño minimo no valido<br />", "Tamaño maximo no valido<br />", "El registro ya existe<br />"); //array en el que se almacenan los diferentes tipos de errores que puede dar dependiendo del valor que devuelva la libreria al validar
        $valida = 0;

        try {
            $conexion = new PDO($datosConexion, $usuario, $contraseña);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $PdoE) {
            //Capturamos la excepcion en caso de que se produzca un error,mostramos el mensaje de error y deshacemos la conexion
            echo($PdoE->getMessage());
            unset($conexion);
        }






        $cuestionario = array(//En este array se almacenarán los datos
            'nombreyapellidos' => '',
            'dni' => '',
            'satisfaccion' => '',
            'fechanac' => '',
            'materiales' => '',
            'opiniones' => '',
            'ip' => ''
        );

        $erroresCampos = array(//En este array se almacenan los posibles errores que puedan tener cada uno de los campos
            'nombreyapellidos' => '',
            'dni' => '',
            'satisfaccion' => '',
            'fechanac' => '',
            'materiales' => '',
            'opiniones' => ''
        );


        $arrayMateriales = array(//Array necesario para hacer checkbox
            'Malos' => '',
            'Muy Mejorables' => '',
            'Regulares' => '',
            'Buenos' => '',
            'Muy Buenos' => ''
        );








        if (isset($_POST['cancelar'])) {
            header('Location:index.php');
        }

        if (filter_has_var(INPUT_POST, 'enviar')) { //SI SE PULSA EL BOTON DE ENVIAR SE REALIZARAN LAS VALIDACIONES
            $valida = validarCadenaAlfabetica($_POST['nombreyapellidos'], 1, 50);

            $sent = $conexion->query("select * from Encuesta where dni=\"" . $_POST['dni'] . "\"");
            $res = $sent->fetchColumn(0);


            if ($res) {
                $erroresCampos['dni'] = $arrayErrores[5];
                $error = true;
            }
            if ($valida != 0) {
                $erroresCampos['nombreyapellidos'] = $arrayErrores[$valida];
                $error = true;
            } else {
                $cuestionario['nombreyapellidos'] = $_POST['nombreyapellidos'];
            }

            $valida = validarDNI($_POST['dni'], 9, 9);
            if ($valida != 0) {
                $erroresCampos['dni'] = $arrayErrores[$valida];
                $error = true;
            } else {
                $cuestionario['dni'] = $_POST['dni'];
            }

            $valida = validarEntero($_POST['satisfaccion'], 1, MAX);
            if ($valida != 0) {
                $erroresCampos['satisfaccion'] = $arrayErrores[$valida];
                $error = true;
            } else {
                $cuestionario['satisfaccion'] = $_POST['satisfaccion'];
            }

            if (empty($_POST['fechanac'])) {
                $erroresCampos['fechanac'] = $arrayErrores[1];
                $error = true;
            } else {
                $cuestionario['fechanac'] = $_POST['fechanac'];
            }

            if (!isset($_POST['materiales'])) {
                $erroresCampos['materiales'] = $arrayErrores[0];
            } else {
                $cuestionario['materiales'] = $_POST['materiales'];
                $arrayMateriales[$cuestionario['materiales']] = 'checked';
            }

            $valida = validarCadenaAlfanumerica($_POST['opiniones'], 1, 250);
            if ($valida != 0 && $valida != 1) {
                $erroresCampos['opiniones'] = $arrayErrores[$valida];
                $error = true;
            } else {
                $cuestionario['opiniones'] = $_POST['opiniones'];
            }

            $ip = $_SERVER['REMOTE_ADDR'];
            $cuestionario['ip'] = $ip;
        }
        if (!filter_has_var(INPUT_POST, 'enviar') || $error) {
            ?>

            <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" id="formulario1" method="post">

                <div id="encuesta">
                    <h4>Encuesta</h4>
                    <label for="nombreyapellidos">Nombre Y Apellidos:</label><br />
                    <input type="text" name="nombreyapellidos" value="<?PHP echo $cuestionario['nombreyapellidos']; ?>"><br />
                    <p id="err"><?PHP echo $erroresCampos['nombreyapellidos']; ?></p>

                    <label for="dni">Dni:</label><br />
                    <input type="text" name="dni" value="<?PHP echo $cuestionario['dni']; ?>"><br />
                    <p id="err"><?PHP echo $erroresCampos['dni']; ?></p>

                    <label for="satisfaccion">Satisfaccion[1-10]:</label><br />
                    <input type="number" name="satisfaccion" value="<?PHP echo $cuestionario['satisfaccion']; ?>" max="10"><br />
                    <p id="err"><?PHP echo $erroresCampos['satisfaccion']; ?></p>

                    <label for="fechanac">Fecha nacimiento:</label><br />
                    <input type="date" name="fechanac" value="<?PHP echo $cuestionario['fechanac']; ?>"><br />
                    <p id="err"><?PHP echo $erroresCampos['fechanac']; ?></p>


                    <label for="materiales">Materiales: </label><br />	
                    <input type="radio" name="materiales" value="Malos" <?php echo $arrayMateriales['Malos']; ?>>Malos<br />
                    <input type="radio" name="materiales" value="Muy Mejorables"  <?php echo $arrayMateriales['Muy Mejorables']; ?>>Muy Mejorables<br />
                    <input type="radio" name="materiales" value="Regulares" <?php echo $arrayMateriales['Regulares']; ?>>Regulares<br />
                    <input type="radio" name="materiales" value="Buenos" <?php echo $arrayMateriales['Buenos']; ?>>Buenos<br />
                    <input type="radio" name="materiales" value="Muy buenos" <?php echo $arrayMateriales['Muy Buenos']; ?>>Muy buenos<br /><br />
    <?PHP echo $erroresCampos['materiales']; ?>



                    <label for="opiniones">Opiniones:</label><br />
                    <textarea name="opiniones" rows="5" cols="40"><?PHP echo $cuestionario['opiniones']; ?></textarea><br> 

    <?PHP echo $erroresCampos['opiniones']; ?>

                    <input type="submit" name="enviar" value="Enviar"/>
                    <input type="submit" name="cancelar" value="Cancelar"/>
                </div>






            </form>

    <?php
    //EN EL CASO EN EL QUE TODO HAYA IDO BIEN PROCESAMOS EL FORUMULARIO Y MOSTRAMOS LOS DATOS POR PANTALLA
} else {

    $consulta = "Insert into  Encuesta (nombreyapellidos,dni,satisfaccion,fechanac,materiales,opiniones,ip) VALUES (:nombreyapellidos,:dni,:satisfaccion,:fechanac,:materiales,:opiniones,:ip)";
    //Preparamos la sentencia
    $sentencia = $conexion->prepare($consulta);
    //Inyectamos los parametros del insert en el query
    $sentencia->bindParam(":nombreyapellidos", $cuestionario['nombreyapellidos']);
    $sentencia->bindParam(":dni", $cuestionario['dni']);
    $sentencia->bindParam(":satisfaccion", $cuestionario['satisfaccion']);
    $sentencia->bindParam(":fechanac", $cuestionario['fechanac']);
    $sentencia->bindParam(":opiniones", $cuestionario['opiniones']);
    $sentencia->bindParam(":materiales", $cuestionario['materiales']);
    $sentencia->bindParam(":ip", $cuestionario['ip']);


    //Ejecutamos la consulta
    try {
        $sentencia->execute();
        header("Location: index.php");
    } catch (PDOException $PdoE) {
        echo $PdoE->getMessage() . "<br>";
        echo "<p>Inserccion erronea<p>";
        echo "<a href='index.php'><button>Volver</button></a>";
    }
    unset($conexion);
}
?>
        <footer>
            <h3><a href="../tema4/indextema4.html">Mario Labra Villar</a></h3>
        </footer>
    </body>
</html>
