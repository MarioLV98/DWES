<?php

require_once 'model/Usuario.php';
require_once 'model/validacion.php';


if(!isset($_SESSION['usuario'])){
    
    header('Location:index.php?location=login');
}else{
    
    include 'view/layout.php';
     
if(isset($_POST['dptoborr'])){//Si se pulsa salir se cierra la sesion y te lleva al index
    echo "Estamos borrando";
    Departamento::borrarDepartamento($_POST['codDptoborr']);
     header('Location:index.php?location=mantenimiento');
}

if(isset($_POST['volverlista3'])){
     header('Location:index.php?location=mantenimiento');
}


}
?>