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
        
         <ul>
            <li><a href="buscar.php"><i class="material-icons">search</i>Buscar</a></li>
            <li><a href="insertar.php"><i class="material-icons">add</i>Insertar</a></li>
            <li><a href="importar.php"><i class="material-icons">cloud_download</i>Importar</a></li>
            <li><a href=""><i class="material-icons">cloud_upload</i>Exportar</a></li>
            
        </ul>
        <?php
        include "configuracion.php";


        include "LibreriaValidacionFormulariosjc.php";
        define("MIN", 1);
        define("MAX", 3);
        $arrayErrores = array(" ", "No ha introducido ningun valor<br />", "El valor introducido no es valido<br />", "Tamaño minimo no valido<br />", "Tamaño maximo no valido<br />");
        $error = false;
        $valida = 0;
        $departamento = array(
            'CodDepartamento' => '',
            'DescDepartamento' => ''
        );
       
        $erroresCampos = array(
            'CodDepartamento' => '',
            'DescDepartamento' => ''
        );
         //SI SE PULSA EL BOTON ENVIAR SE REALIZARA LA VALIDACION DE LOS DATOS INRODUCIDOS
          if(isset($_POST['cancelar'])) { 
        header('Location: buscar.php'); 
    } 
        if (filter_has_var(INPUT_POST, 'enviar')) {
            $valida = validarCadenaAlfanumerica($_POST['CodDepartamento'], MIN, MAX);
            if ($valida != 0) {
                $erroresCampos['CodDepartamento'] = $arrayErrores[$valida];
                $error = true;
            } else {
                $departamento['CodDepartamento'] = $_POST['CodDepartamento'];
            }
            $valida = validarCadenaAlfanumerica($_POST['DescDepartamento'], 1, 15);
            if ($valida != 0) {
                $erroresCampos['DescDepartamento'] = $arrayErrores[$valida];
                $erroresEstilos['DescDepartamento'] = "error";
                $error = true;
            } else {
                $departamento['DescDepartamento'] = $_POST['DescDepartamento'];
            }
        }
        //SI NO SE HA PULSADO ENVIAR O SI HAY UN ERROR NOS MUESTRA EL FORMULARIO
        if (!filter_has_var(INPUT_POST, 'enviar') || $error) {
            ?>
        <div>
            <form action="<?PHP echo $_SERVER['PHP_SELF']. "?CodDepartamento=$codDptoBuscar"; ?>" method="post">
                <label for="CodDepartamento">Codigo Departamento:</label><br />
                <input type="text" name="CodDepartamento" value="<?php echo $departamento['CodDepartamento']; ?>" class="<?PHP echo $erroresEstilos['CodDepartamento']; ?>" readonly=""><br /><br />
            <?PHP echo $erroresCampos['CodDepartamento']; ?>
                <label for="DescDepartamento">Descripcion Departamento:</label><br />
                <input type="text" name="DescDepartamento" value="<?php echo $departamento['DescDepartamento']; ?>" class="<?PHP echo $erroresEstilos['DescDepartamento']; ?>"><br /><br />
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
                    $orden = "update from Departamento set DescDepartamento =(\"" . $departamento['DescDepartamento'] . "\")  where CodDepartamento=(\"" . $departamento['CodDepartamento'] . "\")";
                    //Ejecutamos la consulta y vemos los registros afectados
                    
                     $codDptoBuscar=$_GET['CodDepartamento'];
                     
                    $num = $conexion->exec($orden);
                    //Si el numero de registros afectados es 1 la inseccion es existosa
                    if ($num = 1) {
                        echo "Modificacion correcta";
                    } else {
                        echo "Error";
                    }
                     //Cuando hayamos terminado cerramos la conexion
                    unset($conexion);
                     //Capturamos la excepcion
                } catch (PDOException $Pdoe) {
                    echo "Error<br>";
                    echo($Pdoe->getMessage());
                    //En caso de error se cierra la conexion
                    unset($conexion);
                }
            }
            ?>
    </body>
</html>
