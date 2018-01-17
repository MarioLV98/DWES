<?php

require_once 'model/Usuario.php';

if(isset($_POST['salir'])){
    unset($_SESSION['usuario']);
    session_destroy();
    header('Location: index.php');
}else{
    include 'view/layout.php';
}