<?php

require_once '../Modelo/Usuario.php';
require_once '../Modelo/UsuarioPDO.php';
require_once '../Libreria/LibreriaValidacionFormulariosJC.php';
session_start();


if(isset($_SESSION['usuario'])){ 
        require_once('/Controlador/cinicio.php');
    }else{ 
        require_once('/Controlador/clogin.php');
    } 

