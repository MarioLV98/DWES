<?php


if(!isset($_SESSION['usuario'])){//Si no hay usuario en lasesion redirige a login
    
    header('Location:index.php?location=login');
}else{

if(isset($_POST['borra'])){//Si se pulsa borrar borra el usuario se cierra la sesion y se vuelve al inicio
    
    
        //Pasamos el usuario que se debe borrar
        $usu = Usuario::borrarUsuario($_POST['usuarioborrar']);
        //Cerramos la sesion
        session_destroy();
        //Redirigimos al index
        header('Location:index.php?location=login');
        
}

if(isset($_POST['cancelar'])){//Si se pusla cancelar vuelve a inicio
     header('Location:index.php?location=inicio');
}else{  //Si no se carga la vista
    include 'view/layout.php';
}

}