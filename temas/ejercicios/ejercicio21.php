<html>

    <head>

    </head>



    <?php
    //Autor: Mario Labra Villar
    //Ultima modificación: 25/10/2017 
    if (!isset($_POST["boton"])) {

        //formulario ( si no se pulsa en boton nos muestra el formulario  ).
        ?>	

        <form  method="post">

            <input type="text" name="nombre" required>Nombre</input><br>
            <input type="text" name="apellido" required>Apellido</input><br>
            <input type="number" name="edad" required>Edad</input><br>		
            <input type="radio" name="sexo" value="Hombre"> Hombre<br>
            <input type="radio" name="sexo" value="Mujer"> Mujer<br>
            <input type="checkbox" name="robot" value="No soy un robot"> No soy un robot<br>
            <input type="textaera" name="texto" >Cuentame una historia<br>

            <input type="submit" name="boton"/><br>
        </form>

    <?php
} else {
    // ejecutamos las condiciones que en este caso es simplemente mostrar los datos que hemos intoducido
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $edad = $_POST["edad"];
    $sexo = $_POST["sexo"];
    $robot = $_POST["robot"];
    $relato = $_POST["texto"];

    echo "Hola " . $_POST["nombre"] . " " . $_POST["apellido"] . " tu edad es " . $_POST["edad"] . " y eres " . $_POST["sexo"];
    echo "<br>";
    echo $_POST["robot"];
    echo "<br>";
    echo "Esta es tu historia: " . $relato;
}
?>

</html>