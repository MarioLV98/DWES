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



        $CodDepartamentoBorrar = $_GET['CodDepartamento'];
        $consulta = "select * from Departamento where CodDepartamento = :CodDepartamento";
        //Preparamos la sentencia
        $sentencia = $conexion->prepare($consulta);
        //Inyectamos los parametros  en el query
        $sentencia->bindParam(":CodDepartamento", $CodDepartamentoBorrar);
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
                    <form action="<?PHP echo $_SERVER['PHP_SELF'] . "?CodDepartamento=$CodDepartamentoBorrar"; ?>" method="post">
                        <h2>Borrar</h2>
                        <label for="CodDepartamento">Codigo Departamento:</label><br />
                        <input type="text" name="CodDepartamento" value="<?php echo $cuestionario->CodDepartamento; ?>" readonly><br /><br />


                        <label for="DescDepartamento">Descripcion Departamento:</label><br />
                        <input type="text" name="DescDepartamento" value="<?php echo $cuestionario->DescDepartamento; ?>" readonly><br /><br />

                        <p>Desea borrar?</p>
                        <input type="submit" name="Borrar" value="Borrar">
                        <input type="submit" name="Cancelar" value="Cancelar">

                    </form>
                    <?php
                    if (isset($_POST['Cancelar'])) {
                         echo "<script> window.location='buscar.php'</script>";
                    }
                    if (isset($_POST['Borrar'])) {
                        print_r($_POST);
                        $CodDepartamentoBorrar = $_GET['CodDepartamento'];
                        $orden = "delete from Departamento where CodDepartamento=:CodDepartamento";
                        //Preparamos la consulta
                        $sql = $conexion->prepare($orden);
                        //Pasamos los parametros al query
                        $sql->bindParam(":CodDepartamento", $CodDepartamentoBorrar);
                        //Ejecutamos la orden sql
                        $sql->execute();
                        unset($conexion);
                        echo "<script> window.location='buscar.php'</script>";
                    }
                } else {
                    echo "El departamento buscado no existe";
                    echo "<br/>codigo borrar".$CodDepartamentoBorrar;
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
