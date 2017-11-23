<?php
include "configuracion.php";

include "LibreriaValidacionFormulariosjc.php";

define("MIN", 1);
define("MAX", 3);
$erroresCampos = array(
    'CodDepartamento' => '',
    'DescDepartamento' => ''
);

$arrayErrores = array(" ", "No ha introducido ningun valor<br />", "El valor introducido no es valido<br />", "Tamaño minimo no valido<br />", "Tamaño maximo no valido<br />");

$error = false;

$valida = 0;
try {
    //Creamos la conexion a la base de datos
    $conexion = new PDO($datosConexion, $usuario, $contraseña);
    //Definición de los atributos para lanzar una excepcion si se produce un error
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['CodDepartamento'])) {



        $CodDepartamentoBuscar = $_GET['CodDepartamento'];
        $consulta = "SELECT * FROM Departamento WHERE CodDepartamento = :CodDepartamento";
        //Preparamos la sentencia
        $sentencia = $conexion->prepare($consulta);
        //Inyectamos los parametros  en el query
        $sentencia->bindParam(":CodDepartamento", $CodDepartamentoBuscar);
        //La ejecutamos
        $sentencia->execute();
        if ($sentencia->rowCount() == 1) {
            $cuestionario = $sentencia->fetch(PDO::FETCH_OBJ);
            ?>
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <link rel="stylesheet" type="text/css" href="estilos.css">
                    <title>Mantenimiento</title>
                </head>
                <body>
                    <form action="<?PHP echo $_SERVER['PHP_SELF'] . "?CodDepartamento=$CodDepartamentoBuscar"; ?>" method="post">
                             <h2>Modificar</h2>
                        <label for="CodDepartamento">Codigo Departamento:</label><br />
                        <input type="text" name="CodDepartamento" value="<?php echo $cuestionario->CodDepartamento; ?>" readonly><br /><br />


                        <label for="DescDepartamento">Descripcion Departamento:</label><br />
                        <input type="text" name="DescDepartamento" value="<?php echo $cuestionario->DescDepartamento; ?>"><br /><br />


                        <input type="submit" name="Editar" value="Editar">
                        <input type="submit" name="Cancelar" value="Cancelar">

                    </form>
                    <?php
                    if (isset($_POST['Cancelar'])) {
                         echo "<script> window.location='buscar.php'</script>";
                    }
                    if (isset($_POST['Editar'])) {
                        $cuestionario->CodDepartamento = limpiarCampos($_POST['CodDepartamento']);
                        //Ejecutamos la funcion de validacion y recogemos el valor devuelto
                        $valida = validarCadenaAlfanumerica(limpiarCampos($_POST['DescDepartamento']));
                        //Si el valor es distinto de 0 ha habido un error y procedemos a tratarlo
                        if ($valida != 0) {
                            //Asignamos el error producido al valor correspondiente en el array de errores
                            $erroresCampos['DescDepartamento'] = $arrayErrores[$valida];
                            //Activamos el class correspondiente para marcar el borde del campo en rojo
                            $erroresEstilos['DescDepartamento'] = "error";
                            //Como ha habido un error, la variable de control $error toma el valor true
                            $error = true;
                        } else {
                            //Si no ha habido ningun error, guardamos el valor enviado en el array de departamento
                            $cuestionario->DescDepartamento = limpiarCampos($_POST['DescDepartamento']);
                        }
                        if (!$error) {
                            $consulta = "UPDATE Departamento SET DescDepartamento = :DescDepartamento WHERE CodDepartamento = :CodDepartamento";
                            //Preparamos la sentencia
                            $sentencia = $conexion->prepare($consulta);
                            //Inyectamos los parametros  en el query
                            $sentencia->bindParam(":CodDepartamento", $cuestionario->CodDepartamento);
                            $sentencia->bindParam(":DescDepartamento", $cuestionario->DescDepartamento);
                            //La ejecutamos
                            if ($sentencia->execute()) {
                                // header('Location: buscar.php');
                                echo "<script> window.location='buscar.php'</script>";
                            }
                        } else {
                            echo "<p>" . $erroresCampos['DescDepartamento'] . "</p>";
                        }
                    }
                } else {
                    echo "El registro buscado no existe";
                    //sleep(5);
                    echo "<script> window.location='buscar.php'</script>";
                }
            } else {
                echo "<script> window.location='buscar.php'</script>";
            }
        } catch (PDOException $PdoE) {
            //Capturamos la excepcion en caso de que se produzca un error,mostramos el mensaje de error y deshacemos la conexion
            echo($PdoE->getMessage());
            unset($conexion);
        }
        ?>

    </body>
</html>
