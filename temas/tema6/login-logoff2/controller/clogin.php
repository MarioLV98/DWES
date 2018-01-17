<?php

require_once  'model/Usuario.php';

if(isset($_SESSION['usuario'])){
    header("Location:index.php?location=inicio");
}else{
    $loginOK=false;
    if(isset($_POST['enviar']) && isset($_POST['usuario']) && isset($_POST['contrasena'])){
        
        $usu = Usuario::validarUsuario(trim($_POST['usuario']), hash('sha256', $_POST['contrasena']));
        echo "Usuario: ".$usu;
        if(is_null($usu)){
          
           $errores['errorPassword']="<p style='text-align: center;margin-bottom: 10px;' class='error required_info'>Usuario o contraseña no válidos<p>"; 
        }else{
            $loginOK=true;
        }
    }
    
    if($loginOK){
        $_SESSION['usuario']=$usu;
        header('Location:index.php?location=inicio');
    }else{
        include 'view/layout.php';
    }
    
}

?>
