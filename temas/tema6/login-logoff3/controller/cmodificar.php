<?php

require_once 'model/Usuario.php';
require_once 'model/validacion.php';

$borradoOk=false;
if(isset($_POST['modifica'])){//Si se pulsa salir se cierra la sesion y te lleva al index
    
    $valido = Validacion::validarCadenaAlfanumerica($_POST['contrasenaregistro']);
    
    if($valido!=""){
        
        echo "Error";
    }else{
        $borradoOk=true;
        Usuario::modificiarUsuario(trim($_POST['usuario']), hash('sha256', $_POST['contrasenaregistro']));
        
    }
    
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

