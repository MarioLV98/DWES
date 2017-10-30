<html>

    <head>

    </head>




    <?php
    //Autor: Mario Labra Villar
    //Ultima modificación: 25/10/2017 
    include "LibreriaValidacionFormularios.php";
    //creamos las variables necesarias
    $nombre = "";  //almacenamos nombre
    $apellido = ""; //almacenamos apellido
    $arrayErrores = array(//almacenamos los errores
        'Nombre' => "", //error para nombre
        'Apellido' => "" //error para apellido
    );

    $error = false;

    if (isset($_POST['enviar'])) { //si se pulsa el boton enviar :
        if (empty(comprobarTexto($_POST['nombre']))) {

            $arrayErrores['Nombre'] = "Por favor intoduzca nombre";  //si el nombre esta vacio error es true y guarda el mensaje en la variable
            $error = true;
        } else {
            $nombre = $_POST['nombre'];
        }

        if (empty(comprobarTexto($_POST['apellido']))) {


            $arrayErrores['Apellido'] = "Por favor intoduzca apellido";  //si el nombre esta vacio error es true y guarda el mensaje en la variable
            $error = true;
        } else {
            $apellido = $_POST['apellido'];
        }
    }

    if (!isset($_POST['enviar']) || $error) {  //si no se pulsa enviar o hay un error vuelve a mostrar el formularo o el error
        ?>

        <form  method="post">

            <input type="text" name="nombre" >Nombre</input><br>
        <?php echo $arrayErrores['Nombre'] . "<br>"; ?>
            <input type="text" name="apellido" >Apellido</input><br>
        <?php echo $arrayErrores['Apellido'] . "<br>"; ?>
            <input type="submit" name="enviar"/><br>

        </form>

        <?php
    } else {

        echo "Tu nombre es $nombre <br>";
        echo "Tu apellido es $apellido <br>";
    }
    ?>

</html>