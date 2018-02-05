<?php


if(!isset($_SESSION['usuario'])){ //Si no hay usuario en lasesion redirige a login
    
    header('Location:index.php?location=login');
}else{//Si hay usuario
    
    
     
if(isset($_POST['dptoborr'])){//Si se pulsa borrar departamento
    //Borra el departamento 
    Departamento::borrarDepartamento($_POST['codDptoborr']);
    //Redirige a manenimiento
     header('Location:index.php?location=mantenimiento');
}

if(isset($_POST['volverlista3'])){//Si se pulsa volver vuelve a la pagina de mantenimiento(Lista de departamentos)
     header('Location:index.php?location=mantenimiento');
}else{
    include 'view/layout.php';
}


}
?>