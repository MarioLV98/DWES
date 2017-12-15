
        <?php
        //Autor: Mario Labra Villar
        //Ultima modificación: 17/11/2017 
        session_start();
        //Si no hay usuario nos redirige al login
        if (!empty($_SESSION['usuario'])) {
            //Creamos una cookiea para la ultima conexion
            setcookie("fecha_ultima_conexion", date("j, n, Y, g:i a"), time() + 3600);
            //Si se pulsa salir, se cierra la sesion
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
                'dni' => '',
                'satisfaccion' => '',
                'ndias' => '',
                'mejor' => '',
                'peor' => '',
                'opiniones' => ''
            );

            $erroresCampos = array(//En este array se almacenan los posibles errores que puedan tener cada uno de los campos
                'dni' => '',
                'satisfaccion' => '',
                'ndias' => '',
                'mejor' => '',
                'peor' => '',
                'opiniones' => ''
            );

            if (isset($_POST['cancelar'])) {
                header('Location:indexencuesta.php');
            }

            if (filter_has_var(INPUT_POST, 'enviar')) { //SI SE PULSA EL BOTON DE ENVIAR SE REALIZARAN LAS VALIDACIONES
                $sent = $conexion->query("select * from Encuesta2 where dni=\"" . $_POST['dni'] . "\"");
                $res = $sent->fetchColumn(0);


                if ($res) {
                    $erroresCampos['dni'] = $arrayErrores[5];
                    $error = true;
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

                $valida = validarEntero($_POST['ndias'], 1, MAX);
                if ($valida != 0) {
                    $erroresCampos['ndias'] = $arrayErrores[$valida];
                    $error = true;
                } else {
                    $cuestionario['ndias'] = $_POST['ndias'];
                }


                $valida = validarCadenaAlfabetica($_POST['mejor'], 1, 100);
                if ($valida != 0) {
                    $erroresCampos['mejor'] = $arrayErrores[$valida];
                } else {
                    $cuestionario['mejor'] = $_POST['mejor'];
                }

                $valida = validarCadenaAlfabetica($_POST['peor'], 1, 100);
                if ($valida != 0) {
                    $erroresCampos['peor'] = $arrayErrores[$valida];
                } else {
                    $cuestionario['peor'] = $_POST['peor'];
                }

                $valida = validarCadenaAlfanumerica($_POST['opiniones'], 1, 250);
                if ($valida != 0 && $valida != 1) {
                    $erroresCampos['opiniones'] = $arrayErrores[$valida];
                    $error = true;
                } else {
                    $cuestionario['opiniones'] = $_POST['opiniones'];
                }
            }
            if (!filter_has_var(INPUT_POST, 'enviar') || $error) {
                ?>

               

                <?php
                //EN EL CASO EN EL QUE TODO HAYA IDO BIEN PROCESAMOS EL FORUMULARIO Y MOSTRAMOS LOS DATOS POR PANTALLA
            } else {
                print_r($cuestionario);
                $consulta = "Insert into  Encuesta2 (dni,satisfaccion,ndias,mejor,peor,opiniones) VALUES (:dni,:satisfaccion,:ndias,:mejor,:peor,:opiniones)";
                //Preparamos la sentencia
                $sentencia = $conexion->prepare($consulta);
                //Inyectamos los parametros del insert en el query
                $sentencia->bindParam(":dni", $cuestionario['dni']);
                $sentencia->bindParam(":satisfaccion", $cuestionario['satisfaccion']);
                $sentencia->bindParam(":ndias", $cuestionario['ndias']);
                $sentencia->bindParam(":mejor", $cuestionario['mejor']);
                $sentencia->bindParam(":peor", $cuestionario['peor']);
                $sentencia->bindParam(":opiniones", $cuestionario['opiniones']);



                //Ejecutamos la consulta
                try {
                    $sentencia->execute();
                    header("Location: indexencuesta.php");
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
        <link rel="stylesheet" type="text/css" href="estilos/estilos.css">
    </head>
    <body>
         <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" id="formulario1" method="post">

                    <div id="encuesta">
                        <h4>Encuesta</h4>

                        <label for="dni">Dni:</label><br />
                        <input type="text" name="dni" value="<?PHP echo $cuestionario['dni']; ?>"><br />
                        <p id="err"><?PHP echo $erroresCampos['dni']; ?></p>

                        <label for="satisfaccion">Satisfaccion[1-10]:</label><br />
                        <input type="number" name="satisfaccion" value="<?PHP echo $cuestionario['satisfaccion']; ?>" max="10"><br />
                        <p id="err"><?PHP echo $erroresCampos['satisfaccion']; ?></p>

                        <label for="ndias">Numero de dias:</label><br />
                        <input type="number" name="ndias" value="<?PHP echo $cuestionario['ndias']; ?>"><br />
                        <p id="err"><?PHP echo $erroresCampos['ndias']; ?></p>

                        <label for="mejor">Mejor:</label><br />
                        <input type="text" name="mejor" value="<?PHP echo $cuestionario['mejor']; ?>"><br />
                        <p id="err"><?PHP echo $erroresCampos['mejor']; ?></p>

                        <label for="peor">Peor:</label><br />
                        <input type="text" name="peor" value="<?PHP echo $cuestionario['peor']; ?>"><br />
                        <p id="err"><?PHP echo $erroresCampos['peor']; ?></p>

                        <label for="opiniones">Opiniones:</label><br />
                        <textarea name="opiniones" rows="5" cols="40"><?PHP echo $cuestionario['opiniones']; ?></textarea><br> 

                        <?PHP echo $erroresCampos['opiniones']; ?>

                        <input type="submit" name="enviar" value="Enviar"/>
                        <input type="submit" name="cancelar" value="Cancelar"/>
                    </div>
                </form>
        <footer>
            <h3><a href="../tema4/indextema4.html">Mario Labra Villar</a></h3>
        </footer>
    </body>
</html>
