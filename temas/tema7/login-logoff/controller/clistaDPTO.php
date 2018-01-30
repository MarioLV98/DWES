<?php


if(!isset($_SESSION['usuario'])){
    header("Location:index.php?location=login");
} else {
    if(isset($_POST['crardtpo'])){
        header("Location:index.php?location=creardpto");
    }
    
    if(isset($_POST['volverInicio'])){
        header("Location:index.php?location=inicio"); 
    }
    
    $departamentos= Departamento::listarDepartamentos();
   $_GET['location']="mantenimiento";
    include 'view/layout.php';
}
