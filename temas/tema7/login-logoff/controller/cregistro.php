
<?php





   
    if(isset($_POST['registrar'])){//Si se pulsa registrar
        
        //Guardamos en variables el resultado de las validaciones
        $validoUsuario = Usuario::comprobarYaExistente($_POST['usuario']);
        $validoPass = validarCadenaAlfanumerica($_POST['contrasena']);
        $validoDesc = validarCadenaAlfabetica($_POST['descripcion']);
        $validoPerf = validarCadenaAlfabetica($_POST['perfil']);
        //Si el resultado de las validaciones es diferente al que deberia de ser cuando son correctas salta un error
        if($validoUsuario!=""|| $validoPass!="" || $validoDesc!="" ||$validoPerf!=""){ //Si no es correcto se muestra este mensaje
          echo "Error";
           
        }else{ //Si es correcto se crea el usuario
            //Actualizamos los accesos
            $actualizarAccesos = Usuario::actualizarAccesos($_POST['usuario']);
            //Actualizamos la fecha de acceso
            $actualizarFechaAcceso = Usuario::actualizarFechaAcceso($_POST['usuario']);
            //Registramos el usuario
            $usu = Usuario::registrarUsuario(trim($_POST['usuario']), hash('sha256', $_POST['contrasena']),$_POST['descripcion'],$_POST['perfil']);
            //Cargamos el usuario en la sesion
             $_SESSION['usuario']=$usu;
             //Nos redirige a incio
              header('Location:index.php?location=inicio');
        }
    }
    
    if(isset($_POST['cancelar'])){ //Si pulsa caclear lleva al login
        header('Location:index.php?location=login');
    }else{//Si no es correcto incluimos la vista
        include 'view/layout.php';
    }
    

?>
