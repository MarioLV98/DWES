<?php



if(!isset($_SESSION['usuario'])){//Si no hay usuario en lasesion redirige a login
    
    header('Location:index.php?location=login');
}else{
    
if(isset($_POST['salir'])){//Si se pulsa salir se cierra la sesion y te lleva al index
    unset($_SESSION['usuario']);
    session_destroy();
    header('Location: index.php');
}else{//Si no se cierra sesion nos carga la vista 
    
    
    if(isset($_POST['modificar'])){//Si pulsas modificar lleva a la ventana de modificar
    
    header('Location:index.php?location=modificar');
}

 if(isset($_POST['borrar'])){//Si se pulsa borrar lleva a borrar usuario
    
    header('Location:index.php?location=borrar');
}

if(isset($_POST['dpto'])){ //Si se pulsa lleva a mantenimiento de departamentos
     header('Location:index.php?location=mantenimiento');
}
if(isset($_POST['encusta'])){ //Si se pulsa lleva a la encuesta
     header('Location:index.php?location=wip');
}
if(isset($_POST['soap'])){ //Si se pulsa lleva al servicio soap
     header('Location:index.php?location=wssoap');
}
if(isset($_POST['reset'])){ //Si se pulsa lleva al servicio reset
     header('Location:index.php?location=wsrest');
}
    include 'view/layout.php';//En caso contrario se carga la vista
}
}
