<?php


require 'model/Usuario.php'; 
session_start();
require 'config/config.php';


$errores = ['errorPassword' => ''];
$controlador = 'controller/cinicio.php';

echo "1 :".$controlador;
if (isset($_SESSION['usuario'])) {
    if (isset($_GET['location'])  && isset($controladores[$_GET['location']])) {
        
        $controlador = $controladores[$_GET['location']];
        echo "2 :".$controlador;
    }
 
 
} else {
    $_GET['location'] = 'login';
    $controlador = $controladores[$_GET['location']];
    echo "3 :".$controlador;
}


 echo "Ruta :".$controlador;
include $controlador;
?>