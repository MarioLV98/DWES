<?php
require_once 'model/validacion.php';
if(!isset($_SESSION['usuario'])){
   header("Location:index.php?location=login");
    
}else{
    include_once 'view/layout.php';
    if(isset($_POST['volverlista'])){
        header('Location:index.php?location=mantenimiento');
    }
    
   if(isset($_POST['registrardpto'])||isset($_POST['codDpto'])||isset($_POST['descDpto'])||isset($_POST['volumenNegocio'])){
       
       $codigo= Validacion::comprobarYaExistenteDep($_POST['codDpto']);
       $descripcion= Validacion::validarCadenaAlfanumerica($_POST['descDpto']);
       $volumen= Validacion::validarEntero($_POST['volumenNegocio'],0,100);
       
       if($codigo!=""||$descripcion!=""||$volumen!=""){
           echo "Error";
       }else{
           
           Departamento::crearDepartamento($_POST['codDpto'],$_POST['descDpto'],$_POST['volumenNegocio']);
           include_once 'view/layout.php';
           header("Location:index.php?location=mantenimiento");
       }
   } 
}

