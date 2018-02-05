<?php





if(!isset($_SESSION['usuario'])){//Si no hay usuario en lasesion redirige a login
    
    header('Location:index.php?location=login');
}else{
if(isset($_POST['modifica'])){//Si se pulsa modificar se realizan las validaciones
    
    //Guardamos en variables el resultado de las validaciones
    $validoPass = validarCadenaAlfanumerica($_POST['contrasenaregistro']);
    $validoDesc = validarCadenaAlfabetica($_POST['descripcionmod']);
    $validoPerf = validarCadenaAlfabetica($_POST['perfilmod']);
    
    //Si el resultado de las validaciones es erroneo no se modifica el usuario
    if($validoPass!=""||$validoDesc!=""||$validoPerf!=""){
        
        echo "Error";
    }else{//Si el resultado de las validaciones es correcto se ejecuta la modifiacion
     $usu= Usuario::modificiarUsuario(trim($_POST['usuario']), hash('sha256', $_POST['contrasenaregistro']),$_POST['descripcionmod'],$_POST['perfilmod']);
     $_SESSION['usuario']=$usu;
      header('Location:index.php?location=inicio');
    }
    
}

if(isset($_POST['cancelar'])){//Si se pulsa cancelar nos lleva a inicio
     header('Location:index.php?location=inicio');
}else{//Si no, carga la vista
   include 'view/layout.php';  
}

}
