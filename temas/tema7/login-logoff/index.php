<?php
/*
 * La localización comienza con el primer intento de inicio de sesion
 * 
 * Ultima revision: 03/02/2018
 * Autor: Mario Labra Villar
 */

//Cargamos todos los archivos necesarios para que nuestro prorama funcione
require_once  'config/config.php';  //Ficheros de configuracion con las rutas
require_once 'model/Departamento.php';  //Departamento
require_once  'model/Usuario.php';  //Usuario
require_once 'model/DBPDO.php'; //Ejecucion de los query
include 'model/validacion.php'; //Libreria de validacion
require_once 'model/UsuarioPDO.php';    //UsuarioPDO
require_once 'model/DepartamentoPDO.php'; //DepartamentoPDO
require_once 'model/Soap.php'; //Soap
require_once 'model/Rest.php';  //Rest

session_start();//Iniciamos sesion




//Inicializamos la variable controlador a la posicion inicio;
$controlador = $controladores['inicio'];

//Si hay un usuario definido y una ruta nos lleva a la ruta que tenga cargada el controlador
if (isset($_SESSION['usuario'])) {
    //Se comprueba que hay sesion de usuario y se usa el controlador
    if (isset($_GET['location'])  && isset($controladores[$_GET['location']])) {
        //Cargamos la ruta en el controlador
        $controlador = $controladores[$_GET['location']];
        
    }
 
 //Si no hay usuario hacemos lo mismo
} else {
    if (isset($_GET['location'])  && isset($controladores[$_GET['location']])) {
     $controlador = $controladores[$_GET['location']];     

     }else{//Si no hay ruta definida nos lleva al login
            $_GET['location'] = 'login';
    $controlador = $controladores[$_GET['location']];
     }
   
}


include "$controlador";
$_GET['anterior']=$controlador;
?>