
<?php

require_once  'model/Usuario.php';
require_once  'model/validacion.php';


 //Si no hay sesion se realiza la validacion de usuario
    $loginOK=false; //Sirve para comprobar que el usuario es correcto o no
    if(isset($_POST['registrar']) && isset($_POST['usuario']) && isset($_POST['contrasena'])){
        
        
        $valido = Validacion::comprobarYaExistente($_POST['usuario']);
        echo "Validacion".$valido;
        if($valido!="Ok"){ //Si no es correcto se muestra este mensaje
          echo "Error";
           $errores['errorPassword']="<p style='text-align: center;margin-bottom: 10px;' class='error required_info'>Usuario o contraseña no válidos<p>"; 
        }else{ //Si se devuelve el usuario loginOk se pone true
            $loginOK=true;
            $usu = Usuario::registrarUsuario(trim($_POST['usuario']), hash('sha256', $_POST['contrasena']));
            
        }
    }
    
    if(isset($_POST['cancelar'])){
        header('Location:index.php?location=login');
    }
    
    if($loginOK){//Si el login es correcto el usuario se guarda en la sesion y te lleva al index
        header('Location:index.php?location=login');
    }else{//Si no es correcto te lleva al formulario
        include 'view/layout.php';
    }
   

?>
