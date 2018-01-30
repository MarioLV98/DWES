<?php



if(!isset($_SESSION['usuario'])){
    
    header('Location:index.php?location=login');
}else{
    
if(isset($_POST['salir'])){//Si se pulsa salir se cierra la sesion y te lleva al index
    unset($_SESSION['usuario']);
    session_destroy();
    header('Location: index.php');
}else{//Si no hay sesion se muestra el inicio
    if(isset($_POST['modificar'])){
    
    header('Location:index.php?location=modificar');
}

 if(isset($_POST['borrar'])){
    
    header('Location:index.php?location=borrar');
}

if(isset($_POST['dpto'])){
     header('Location:index.php?location=mantenimiento');
}
if(isset($_POST['encusta'])){
     header('Location:index.php?location=wip');
}
if(isset($_POST['soap'])){
     header('Location:index.php?location=wip');
}
if(isset($_POST['reset'])){
     header('Location:index.php?location=wip');
}
    include 'view/layout.php';
}
}
