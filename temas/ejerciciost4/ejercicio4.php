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
       

        $conexion = new mysqli("192.168.20.19","DAW206","paso","DAW206_DBdepartamentos");

 
        if ($conexion->connect_errno) {
            echo "Error al conectarse a la base de datos<br/>";
            echo "Codigo de error:" . $conexion->connect_errno;
        } else {
            include "LibreriaValidacionFormulariosjc.php";
 
            define("MIN", 1);
            define("MAX", 3);
            $arrayErrores = array(" ", "No ha introducido ningun valor<br />", "El valor introducido no es valido<br />", "Tamaño minimo no valido<br />", "Tamaño maximo no valido<br />");
            $error = false;
            $valida = 0;

            $nombreuser="";
            $erroruser="";
           

            if (filter_has_var(INPUT_POST, 'enviar')) {
                
               


                $valida = validarCadenaAlfanumerica($_POST['DescDepartamento'], 1, 15);
                if ($valida != 0) {
                    $erroruser = $arrayErrores[$valida];
                    $error = true;
                } else {
                    $nombreuser = $_POST['DescDepartamento'];
                }
            }
            if (!filter_has_var(INPUT_POST, 'enviar') || $error) {
                ?>
                 <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <label for="DescDepartamento">Descripcion:</label><br />
                    <input type="text" name="DescDepartamento" value="<?php echo $nombreuser ?>"<br />
                <?PHP echo $erroruser ?>
                    <input type="submit" name="enviar" value="Enviar">
                </form>
                    <?PHP
                } else {
                    $orden = "select * from Departamento where DescDepartamento like concat('%',?,'%')";
                    $sql = $conexion->prepare($orden);
                    $sql->bind_param("s", $nombreuser);
                    $sql->execute();
                    $res=$sql->get_result();
                    $cuestionario=$res->fetch_object();
                        while($cuestionario!=null){
                          echo "Codigo dpto: ".$cuestionario->CodDepartamento."<br>";
                          echo "Descripcion dpto: ".$cuestionario->DescDepartamento."<br><br>";
                          $cuestionario=$res->fetch_object();
                        }
                    $sql->close();
                }
                $conexion->close();
            }
            ?>
    </body>
</html>
