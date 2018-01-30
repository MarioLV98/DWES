<?php


require_once 'model/validacion.php';

$borradoOk=false;
if(!isset($_SESSION['usuario'])){
    
    header('Location:index.php?location=login');
}else{
if(isset($_POST['moddpto'])){//Si se pulsa salir se cierra la sesion y te lleva al index
    
    $validoPass = Validacion::validarCadenaAlfanumerica($_POST['contrasenaregistro']);
    $validoDesc = Validacion::validarCadenaAlfabetica($_POST['descripcionmod']);
    $validoPerf = Validacion::validarCadenaAlfabetica($_POST['perfilmod']);
    
    if($validoPass!=""||$validoDesc!=""||$validoDesc!=""){
        
        echo "Error";
    }else{
        $borradoOk=true;
        Usuario::modificiarUsuario(trim($_POST['usuario']), hash('sha256', $_POST['contrasenaregistro']),$_POST['descripcionmod'],$_POST['perfilmod']);
        
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
}
