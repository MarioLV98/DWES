<?php

if(isset($_POST['Salir'])){
    unset($_SESSION['usuario']);
    header("Location:index.php");
}else{
    require '../Vista/vinicio.php';
}

