<?php

if (!isset($_SESSION['usuario'])) {//Si no hay usuario en la sesion nos lleva al login
    header("Location:index.php?location=login");
} else {//Si no ejecutamos las operaciones
    
    //Creamos un datetime con la fecha que le pasamos
    $fecha = new DateTime($_POST['hora']);
    //Lo transformamos en timestamp(Ya que nuestro servicio rest cuenta la hora en formato timestamp)
    $timestamp = $fecha->getTimestamp();
    
    //Si se pulsa buscar se pasan los datos a la clase Rest
    if(isset($_POST['buscar'])){
      $_SESSION['busquedareset'] = Rest::usoRest($_POST['localizacion'], $timestamp);
    }
    
    //Si se pulsa volver nos redirige al index
    if(isset($_POST["volver"])){
        header("Location:index.php?location=inicio");
    }else{//Si no carga la vista
        include 'view/layout.php';
    }
}
