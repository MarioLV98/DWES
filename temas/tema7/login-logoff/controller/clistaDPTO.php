<?php


if(!isset($_SESSION['usuario'])){//Si no hay usuario en lasesion redirige a login
    header("Location:index.php?location=login");
} else {
    if(isset($_POST['crardtpo'])){//Si se pulsa crear nos redirige al formulario para crear departamento
        header("Location:index.php?location=creardpto");
    }
    
    if(isset($_POST['volverInicio'])){//Si se pulsa volver volvemos a inicio
        header("Location:index.php?location=inicio"); 
    }
    
    //Llamamos a la funcion listar departamentos
    $departamentos= Departamento::listarDepartamentos();
    //Le pasamos por get la ruta
   $_GET['location']="mantenimiento";
   //Incluimos la vista
    include 'view/layout.php';
}
