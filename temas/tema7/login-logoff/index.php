<?php


require_once  'model/Usuario.php'; 
session_start();//Iniciamos sesion
require_once  'config/config.php';
require_once 'model/Departamento.php';




$controlador = $controladores['inicio'];


if (isset($_SESSION['usuario'])) {
    //Se comprueba que hay sesion de usuario y se usa el controlador
    if (isset($_GET['location'])  && isset($controladores[$_GET['location']])) {
        
        $controlador = $controladores[$_GET['location']];
        
    }
 
 
} else {
    if (isset($_GET['location'])  && isset($controladores[$_GET['location']])) {
     $controlador = $controladores[$_GET['location']];     

     }else{
            $_GET['location'] = 'login';
    $controlador = $controladores[$_GET['location']];
     }
   
}


include "$controlador";
$_GET['anterior']=$controlador;
?>