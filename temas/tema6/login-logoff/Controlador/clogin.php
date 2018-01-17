<?php



$entradaOK= false;
$usuario = null;
$error="";

if(isset($_SESSION['usuario'])){
    header('Location:index.php');
}else{
    if (isset($_POST['Salir'])){ 
            header("Location: ../../IndexTema6.php"); 
        } 
        if(isset($_POST['Enviar'])) {
            $password = $_POST['password']; 
            $usuario = Usuario::validarUsuario($codUsuario, $password); 

            if (is_null($usuario)) { 
                //Aqui van los errores. 
                $error = 'El nombre o la contraseña son incorrectos'; 
            } else { 
                $entradaOK = true; 
                $error = 'bien'; 
            } 
        } 
            if ($entradaOK) {
                $_SESSION['usuario'] = $usuario; 
                header("Location: index.php"); 
            } else { 
                require_once('../Vista/vlogin.php'); 
               
            } 
}

