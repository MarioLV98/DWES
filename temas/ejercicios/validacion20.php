<?php

$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$edad = $_POST["edad"];   //GUARDAMOS LOS DATOS EN LAS VARIABLES con el metodo $_POST
$sexo = $_POST["sexo"];
$robot = $_POST["robot"];
$relato = $_POST["texto"];


echo "Hola " . $_POST["nombre"] . " " . $_POST["apellido"] . " tu edad es " . $_POST["edad"] . " y eres " . $_POST["sexo"];
echo "<br>";
echo $_POST["robot"];  //MOSTRAMOS LOS DATOS POR PANTALLA
echo "<br>";
echo "Esta es tu historia: " . $relato;
?>