<?php

require_once 'model/Usuario.php';

if(isset($_POST['salir'])){//Si se pulsa salir se cierra la sesion y te lleva al index
    unset($_SESSION['usuario']);
    session_destroy();
    header('Location: index.php');
}else{//Si no hay sesion se muestra el inicio
    if(isset($_POST['modificar'])){
    
    header('Location:index.php?location=modificar');
}

 if(isset($_POST['borrar'])){
    
    header('Location:index.php?location=borrar');
}
    include 'view/layout.php';
}

