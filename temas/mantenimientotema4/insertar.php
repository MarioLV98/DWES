<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="estilos.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>Mantenimiento</title>
    </head>
    <body>


        <?php
        include "configuracion.php";


        include "LibreriaValidacionFormulariosjc.php";
        define("MIN", 3);
        define("MAX", 3);
        $arrayErrores = array(" ", "No ha introducido ningun valor<br />", "El valor introducido no es valido<br />", "Tamaño minimo no valido<br />", "Tamaño maximo no valido<br />","Este código ya existe<br />");
        $error = false;
        $valida = 0;
        $cuestionario = array(
            'CodDepartamento' => '',
            'DescDepartamento' => ''
        );
        $erroresCampos = array(
            'CodDepartamento' => '',
            'DescDepartamento' => ''
        );
        //SI SE PULSA EL BOTON ENVIAR SE REALIZARA LA VALIDACION DE LOS DATOS INRODUCIDOS
        if (isset($_POST['cancelar'])) {
            header('Location: buscar.php');
        }
        if (filter_has_var(INPUT_POST, 'enviar')) {
            $valida = validarCadenaAlfabetica($_POST['CodDepartamento'], MIN, MAX);
            $duplicate = $conec = new PDO($datosConexion, $usuario, $contraseña);
            $duplicate->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sent = $duplicate->query("select * from Departamento where CodDepartamento=\"" . $_POST['CodDepartamento'] . "\"");
            $res = $sent->fetchColumn(0);
            unset($conec);

            if ($res) {
                $erroresCampos['CodDepartamento'] =$arrayErrores[5];
                $error=true;
            }
            if ($valida != 0) {
                $erroresCampos['CodDepartamento'] = $arrayErrores[$valida];
                $error = true;
            } else {
                $cuestionario['CodDepartamento'] = $_POST['CodDepartamento'];
            }

            $valida = validarCadenaAlfanumerica($_POST['DescDepartamento'], 1, 15);
            if ($valida != 0) {
                $erroresCampos['DescDepartamento'] = $arrayErrores[$valida];
                $erroresEstilos['DescDepartamento'] = "error";
                $error = true;
            } else {
                $cuestionario['DescDepartamento'] = $_POST['DescDepartamento'];
            }
        }
        //SI NO SE HA PULSADO ENVIAR O SI HAY UN ERROR NOS MUESTRA EL FORMULARIO
        if (!filter_has_var(INPUT_POST, 'enviar') || $error) {
            ?>
            <div>
                <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method="post">
                     <h2>Insertar</h2>
                    <label for="CodDepartamento">Codigo Departamento:</label><br />
                    <input type="text" name="CodDepartamento" value="<?php echo $cuestionario['CodDepartamento']; ?>" class="<?PHP echo $erroresEstilos['CodDepartamento']; ?>"><br /><br />
                    <?PHP echo $erroresCampos['CodDepartamento']; ?>
                    <label for="DescDepartamento">Descripcion Departamento:</label><br />
                    <input type="text" name="DescDepartamento" value="<?php echo $cuestionario['DescDepartamento']; ?>" class="<?PHP echo $erroresEstilos['DescDepartamento']; ?>"><br /><br />
                    <?PHP echo $erroresCampos['DescDepartamento']; ?>

                    <input type="submit" name="enviar" value="Enviar">
                    <input type="submit" name="cancelar" value="Cancelar">
                </form>
            </div>
            <?PHP
        } else {

            try {
                //Realizamos la conexion con la BD  usando los datos de configuracion.php
                $conexion = new PDO($datosConexion, $usuario, $contraseña);
                //Creamos los atributos para lanzar excepcion en caso de error
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //Orden sql
                $orden = "insert into Departamento (CodDepartamento,DescDepartamento) values (\"" . $cuestionario['CodDepartamento'] . "\",\"" . $cuestionario['DescDepartamento'] . "\")";
                //Ejecutamos la consulta y vemos los registros afectados
                $num = $conexion->exec($orden);
                //Si el numero de registros afectados es 1 la inseccion es existosa
                if ($num = 1) {
                    echo "Inserccion exitosa";
                    header('Location:buscar.php');
                } else {
                    echo "Error";
                }
                //Cuando hayamos terminado cerramos la conexion
                unset($conexion);
                //Capturamos la excepcion
            } catch (PDOException $Pdoe) {
                //echo "Error<br>";
                //echo($Pdoe->getMessage());
                //En caso de error se cierra la conexion
                unset($conexion);
            }
        }
        ?>
    </body>
</html>
