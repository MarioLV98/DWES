<?php

require_once 'model/Usuario.php';
require_once 'model/validacion.php';
if(!isset($_SESSION['usuario'])){
    
    header('Location:index.php?location=login');
}else{
$borradoOk=false;
if(isset($_POST['borra'])){//Si se pulsa salir se cierra la sesion y te lleva al index
    
    
        $borradoOk=true;
        $usu = Usuario::borrarUsuario($_POST['usuarioborrar']);
        
}

if(isset($_POST['cancelar'])){
     header('Location:index.php?location=inicio');
}

if($borradoOk){
    session_destroy();
    header('Location:index.php?location=login');
}else{  
    include 'view/layout.php';
}

}