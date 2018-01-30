<?php

require_once 'model/Usuario.php';
require_once 'model/validacion.php';


if(!isset($_SESSION['usuario'])){
    
    header('Location:index.php?location=login');
}else{
    
    include 'view/layout.php';
if(isset($_POST['dptomod'])){//Si se pulsa salir se cierra la sesion y te lleva al index
    
    $validoDesc = Validacion::validarCadenaAlfabetica($_POST['descDptomod']);
    $validoVol = Validacion::validarEntero($_POST['volumenNegociomod'],0,100);
    
    if($validoDesc!=""||$validoVol!=""){
        
        echo "Error";
      
    }else{
        
        Departamento::modificarDepartamento($_POST['codDptomod'], $_POST['descDptomod'],$_POST['volumenNegociomod']);
        header('Location:index.php?location=mantenimiento');
    }
    
}

if(isset($_POST['volverlista2'])){
     header('Location:index.php?location=mantenimiento');
}


}
