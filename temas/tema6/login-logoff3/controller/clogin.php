<?php

require_once  'model/Usuario.php';

if(isset($_SESSION['usuario'])){//Si hay sesion te lleva al index
    header("Location:index.php?location=inicio");
}else{ //Si no hay sesion se realiza la validacion de usuario
    if(isset($_POST['registro'])){
        header('Location:index.php?location=registro');
    }
    $loginOK=false; //Sirve para comprobar que el usuario es correcto o no
    if(isset($_POST['enviar']) && isset($_POST['usuario']) && isset($_POST['contrasena'])){
        
        $usu = Usuario::validarUsuario(trim($_POST['usuario']), hash('sha256', $_POST['contrasena']));
       
        if(is_null($usu)){ //Si no es correcto se muestra este mensaje
          
           $errores['errorPassword']="<p style='color:red;'>Usuario o contraseña no válidos<p>"; 
        }else{ //Si se devuelve el usuario loginOk se pone true
            $loginOK=true;
        }
    }
    
    if($loginOK){//Si el login es correcto el usuario se guarda en la sesion y te lleva al index
        $_SESSION['usuario']=$usu;
        header('Location:index.php?location=inicio');
    }else{//Si no es correcto te lleva al formulario
        include 'view/layout.php';
    }
    
}

?>
