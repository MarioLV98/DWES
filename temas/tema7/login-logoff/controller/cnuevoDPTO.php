<?php

if(!isset($_SESSION['usuario'])){// si no hay sesion de usuario te redirige al login
   header("Location:index.php?location=login");
    
}else{// si no se ejecuta el siguiente codigo
   
    if(isset($_POST['volverlista'])){//Si se pulsa volver vuelve al mantenimiento
        header('Location:index.php?location=mantenimiento');
    }else{//Si no carga la vista
        include_once 'view/layout.php';
    }
    
   if(isset($_POST['registrardpto'])){//Si se pulsa registrar departamento se ejecuta lo siguiente
       //Guardamos en variables el resultado de las validaciones
       $codigo= DepartamentoPDO::comprobarYaExistenteDep($_POST['codDpto']);
       $descripcion= validarCadenaAlfanumerica($_POST['descDpto']);
       $volumen= validarEntero($_POST['volumenNegocio'],0,10000000000000000000000);
       //Si el resultado de las validaciones es diferente al que deberia de ser cuando son correctas salta un error
       if($codigo!=""||$descripcion!=""||$volumen!=""){
           echo "";
       } else{//Si es correcto crea el departamento y redirige a mantenimiento
           Departamento::crearDepartamento($_POST['codDpto'],$_POST['descDpto'],$_POST['volumenNegocio']);
           header("Location:index.php?location=mantenimiento");
       }
   } 
}

