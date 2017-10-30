<?php

function limpiarCampos($valor) {

    return strip_tags(trim($valor));
}

function validarCadenaAlfabetica($valor, $minimo, $maximo) {
    //Expresion regular
    $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
    limpiarCampos($valor);
    $error = 0;
    if (empty($valor)) {
        $error = 1;
    }
    if (!preg_match($patron_texto, $valor)) {
        $error= 2;
    }
    if (strlen($valor) < $minimo) {
        $error = 3;
    }
    if (strlen($valor) > $maximo) {
        $error = 4;
    }
    return $error;
}

function validarEntero($valor, $minimo, $maximo) {
    limpiarCampos($valor);
    $error = 0;

    if (empty($valor)) {
        $error = 1;
    }
    if (!filter_var($valor, FILTER_VALIDATE_INT)) {
        $error = 2;
    }

    if (strlen($valor) < $minimo) {
        $error= 3;
    }
    if (strlen($valor) > $maximo) {
        $error = 4;
    }


    return $error;
}

function validarFloat($valor, $minimo, $maximo) {
    limpiarCampos($valor);

    $error = 0;
    if (empty($valor)) {
        $error = 1;
    }

    if (!filter_var($valor, FILTER_VALIDATE_FLOAT)) {
         $error = 2;
    }

    if (strlen($valor) < $minimo) {
        $error = 3;
    }
    if (strlen($valor) > $maximo) {
        $error = 4;
    }

    return $error;
}

function validarBooleano($valor) {
    limpiarCampos($valor);
 
		$error = 0;
		if(empty($valor)){
			$error = 1;
		}
		else if(!filter_var($valor,FILTER_VALIDATE_BOOLEAN)){
			$error = 2;
		}
		return $valida;

    return $valido;
}

function validarDNI($valor) {
    
}

function validarTelefono($valor) {
    
}

function validarEmail($valor, $minimo, $maximo) {
    limpiarCampos($valor);
    
    $error=0;
     if (empty($valor)) {
        $error .= 1;
    }
    if (!filter_var($valor, FILTER_VALIDATE_EMAIL)) {
        $error = 2;
    }
    
     if (strlen($valor) < $minimo) {
        $error = 3;
    }
    if (strlen($valor) > $maximo) {
        $error = 4;
    }

    return $error;

   
}

function validarURL($valor, $minimo, $maximo) {
    limpiarCampos($valor);
     $error=0;
      if (empty($valor)) {
        $error = 1;
    }
    if (!filter_var($valor, FILTER_VALIDATE_URL)) {
         $error = 2;
    }
    
    if (strlen($valor) < $minimo) {
        $error = 3;
    }
    if (strlen($valor) > $maximo) {
        $error = 4;
    }

    return $error;
}

?>