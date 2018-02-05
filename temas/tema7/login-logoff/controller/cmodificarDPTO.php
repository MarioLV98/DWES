<?php


if(!isset($_SESSION['usuario'])){// si no hay sesion de usuario te redirige al login
    
    header('Location:index.php?location=login');
}else{ //si hay sesion de usuario carga la vista
    
   
if(isset($_POST['dptomod'])){//Si se pulsa modificar departamento se realizan todas las validaciones 
    
    //Guardamos en variables el resultado de las validaciones
    $validoDesc = validarCadenaAlfabetica($_POST['descDptomod']);
    $validoVol = validarEntero($_POST['volumenNegociomod'],0,100000000000);
    
    //Si el resultado de las validaciones es diferente al que deberia de ser cuando son correctas salta un error
    if($validoDesc!=""||$validoVol!=""){
        echo ""; 
    }else{ //Si es correcto modifica y redirige a index
        Departamento::modificarDepartamento($_POST['codDptomod'], $_POST['descDptomod'],$_POST['volumenNegociomod']);
        header('Location:index.php?location=mantenimiento');
    }
    
}

if(isset($_POST['volverlista2'])){//Si se pulsa vuelve a la ventana de mantenimiento
     header('Location:index.php?location=mantenimiento');
}else{//Si no carga la vista
     include 'view/layout.php';
}


}
