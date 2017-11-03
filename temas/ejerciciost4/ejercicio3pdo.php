<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="css/estilos23.css">
        <title>Ejercicio 3</title>
    </head>
    <body>


        <?php
        include "conexion.php";
       

        try {
            
             $conexion = new PDO($datosConexion, $usuario, $contraseña);
              $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        }catch (PDOException $Pdoe) {
              
                echo($Pdoe->getMessage());
                unset($conexion);
            }
            include "LibreriaValidacionFormulariosjc.php";

            define("MIN", 1);
            define("MAX", 3);
            $arrayErrores = array(" ", "No ha introducido ningun valor<br />", "El valor introducido no es valido<br />", "Tamaño minimo no valido<br />", "Tamaño maximo no valido<br />");
            $error = false;
            $valida = 0;

            $departamento = array(
                'CodDepartamento' => '',
                'DescDepartamento' => '',
                'FechaBaja' => ''
            );

            $erroresCampos = array(
                'CodDepartamento' => '',
                'DescDepartamento' => '',
                'FechaBaja' => ''
            );



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

                if (empty($_POST['FechaBaja'])) {

                    $erroresCampos['FechaBaja'] = $arrayErrores[$valida];

                    $error = true;
                } else {

                    $departamento['FechaBaja'] = $_POST['FechaBaja'];
                }
            }

            if (!filter_has_var(INPUT_POST, 'enviar') || $error) {
                ?>
                <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method="post">

                    <label for="CodDepartamento">Codigo Departamento:</label><br />
                    <input type="text" name="CodDepartamento" value="<?php echo $departamento['CodDepartamento']; ?>" class="<?PHP echo $erroresEstilos['CodDepartamento']; ?>"><br /><br />
                <?PHP echo $erroresCampos['CodDepartamento']; ?>

                    <label for="DescDepartamento">Descripcion Departamento:</label><br />
                    <input type="text" name="DescDepartamento" value="<?php echo $departamento['DescDepartamento']; ?>" class="<?PHP echo $erroresEstilos['DescDepartamento']; ?>"><br /><br />
                    <?PHP echo $erroresCampos['DescDepartamento']; ?>


                    <label for="FechaBaja">Fecha Baja:</label><br />
                    <input type="date" name="FechaBaja" value="<?php echo $departamento['FechaBaja']; ?>" class="<?PHP echo $erroresEstilos['FechaBaja']; ?>"><br /><br />
                    <?PHP echo $erroresCampos['FechaBaja']; ?>

        <?PHP echo $departamento['FechaBaja']; ?>
                    <input type="submit" name="enviar" value="Enviar">

                </form>
                    <?PHP
                } else {
                   
                    $orden = "insert into Departamento values (CodDepartamento,DescDepartamento,FechaBaja)";

                    $sentencia = $conexion->prepare($orden);
                    $sentencia->bindParam(":CodDepartamento",$departamento['CodDepartamento']);
                    $sentencia->bindParam(":DescDepartamento",$departamento['DescDepartamento']);
                    $sentencia->bindParam(":FechaBaja",$departamento['FechaBaja']);
                    
                    
                    try{
                    $sentencia->execute();

                    echo "Inserccion exitosa";
                    
                
                } catch (PDOException $Pdoe) {
                echo "Error<br>";
                echo($Pdoe->getMessage());
                unset($conexion);
                 }
                }
            ?>


    </body>
</html>

