<?php
   // include 'DBPDO.php';
   // include 'UsuarioBD.php';
	/*Cada una estas funciones devolverá
		
		0: Si el valor introducido es correcto
		1: Si el valor introducido es vacio
		2: Si el valor introducido no es valido
	
	
	*/
    
    
class Validacion{    
	function limpiarCampos($valor) {
    return htmlspecialchars(strip_tags(trim($valor)));
}
function validarCadenaAlfanumerica($valor, $minimo = 3, $maximo = 100) {
     $valida = "";
    $patron_texto = "/^[0-9a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
    if (empty($valor)) {
        $valida = "No ha introducido ningun valor";
    } else if (!preg_match($patron_texto, $valor)) {
        $valida = "Cadena no valida";
    } else if (strlen($valor) < $minimo) {
        $valida = "Tamaño demasiado corto";
    } else if (strlen($valor) > $maximo) {
        $valida = "Tamaño demasiado largo";
    }
    return $valida;
}
function validarCadenaAlfabetica($valor, $minimo = 3, $maximo = 100) {
    $valida = "";
    $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
    if (empty($valor)) {
        $valida = "No ha introducido ningun valor";
    } else if (!preg_match($patron_texto, $valor)) {
        $valida = "Cadena no valida";
    } else if (strlen($valor) < $minimo) {
        $valida = "Tamaño demasiado corto";
    } else if (strlen($valor) > $maximo) {
        $valida = "Tamaño demasiado largo";
    }
    return $valida;
}
function validarEntero($valor, $minimo, $maximo) {
    $valida = "";
    if (empty($valor)) {
        $valida = "No ha introducido ningun valor";
    } else if (!filter_var($valor, FILTER_VALIDATE_INT)) {
        $valida = "No ha introducido un entero";
    } else if ($valor < $minimo) {
        $valida = "Tamaño demasiado corto";
    } else if ($valor > $maximo) {
        $valida = "Tamaño demasiado largo";
    }
    return $valida;
}
function validarReal($valor, $minimo, $maximo) {
    $valida = "";
    if (empty($valor)) {
        $valida = "No ha introducido ningun valor";
    } else if (!filter_var($valor, FILTER_VALIDATE_FLOAT)) {
        $valida = "No ha introducido un numero real";
    } else if ($valor < $minimo) {
        $valida = "Tamaño demasiado corto";
    } else if ($valor > $maximo) {
        $valida = "Tamaño demasiado largo";
    }
    return $valida;
}
function validarBooleano($valor) {
    $valida = "";
    if (empty($valor)) {
        $valida = "No ha introducido ningun valor";
    } else if (!filter_var($valor, FILTER_VALIDATE_BOOLEAN)) {
        $valida = "No es un booleano";
    }
    return $valida;
}
function validarURL($valor) {
    $valida = "";
    if (empty($valor)) {
        $valida = "No ha introducido ningun valor";
    } else if (!filter_var($valor, FILTER_VALIDATE_URL)) {
        $valida = "URL no valida";
    }
    return $valida;
}
function validarEmail($valor) {
    $valida = "";
    if (empty($valor)) {
        $valida = "No ha introducido ningun valor";
    } else if (!filter_var($valor, FILTER_VALIDATE_EMAIL)) {
        $valida = "Email no valido";
    }
    return $valida;
}
function validarDNI($valor) {
    $letra = substr($valor, -1);
    $numeros = substr($valor, 0, -1);
    $valida = "";
    if (empty($valor)) {
        $valida = "No ha introducido ningun valor";
    } else if (!( substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros % 23, 1) == $letra && strlen($letra) == 1 && strlen($numeros) == 8 )) {
        $valida = "Dni no valido";
    }
    return $valida;
}
function validarTelefono($valor) {
    $valida = "";
    $patron = "/^((\+?34([ \t|\-])?)?[9|6|7]((\d{1}([ \t|\-])?[0-9]{3})|(\d{2}([ \t|\-])?[0-9]{2}))([ \t|\-])?[0-9]{2}([ \t|\-])?[0-9]{2})$/";
    if (empty($valor)) {
        $valida = "No ha introducido ningun valor";
    } else if (!preg_match($patron, $valor)) {
        $valida = "Telefono no valido";
    }
    return $valida;
}

function comprobarUsuario($valor){
     $valida = "";
     
     
     if(empty($valor)){
         $valida="No ha introducido ningun valor";
     }else{
         
         $consulta = "select * from Usuarios where codUsuario ='$valor'";
         $resultado = DBPDO::ejecutarConsulta($consulta, [$valor]);
         if($resultado->rowCount()==0){
       
         $valida="El usuario no existe";
         
        } 
     }
    
     return $valida;
}


function comprobarPassword($user,$pass){
     $valida = "";
     
     
     if(empty($pass)){
         $valida="No ha introducido ningun valor";
     }else{
         
         $consulta = "select * from Usuarios where codUsuario='$user' and password =sha2('$pass','256')";
         $resultado = DBPDO::ejecutarConsulta($consulta, [$user,$pass]);
         if($resultado->rowCount()==0){
       
         $valida="Contraseña incorrecta";
         
        } 
     }
    
     return $valida;
}

function comprobarYaExistente($valor){
     $valida = "";
     
     if(empty($valor)){
         $valida="No ha introducido ningun valor";
     }else{
         
         $consulta = "select * from Usuarios where codUsuario ='$valor'";
         $resultado = DBPDO::ejecutarConsulta($consulta, [$valor]);
         if($resultado->rowCount()==1){
       
         $valida="El usuario ya existe";
         
        } 
     }
    
     return $valida;
}

function comprobarYaExistenteDep($valor){
     $valida = "";
     
     if(empty($valor)){
         $valida="No ha introducido ningun valor";
     }else{
         
         $consulta = "select * from Departamentos where codDepartamento ='$valor'";
         $resultado = DBPDO::ejecutarConsulta($consulta, [$valor]);
         if($resultado->rowCount()==1){
       
         $valida="El departamento ya existe";
         
        } 
     }
    
     return $valida;
}
}
?>