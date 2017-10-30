<?php

	/*Cada una estas funciones devolverá
		
		0: Si el valor introducido es correcto
		1: Si el valor introducido es vacio
		2: Si el valor introducido no es valido
	
	
	*/
	function limpiarCampos($valor) {
		htmlspecialchars(strip_tags(trim($valor)));
	}



	function validarCadenaAlfanumerica($valor,$minimo,$maximo){
		limpiarCampos($valor);
		$valida = 0;
		if(empty($valor)){
			$valida = 1;
		}
		else if(strlen($valor) < $minimo){
			$valida = 3;
		}
		
		else if(strlen($valor) > $maximo){
			$valida = 4;
		}
		return $valida;
		
	}

	function validarCadenaAlfabetica($valor,$minimo,$maximo) {
		limpiarCampos($valor);
		$valida = 0;
		$patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙñ\s]+$/";
       
		if(empty($valor)) {
			$valida = 1;
		}
		else if(!preg_match($patron_texto, $valor)) {
			$valida = 2;
		}
		else if(strlen($valor) < $minimo){
			$valida = 3;
		}
		
		else if(strlen($valor) > $maximo){
			$valida = 4;
		}
		return $valida;
		
	}

	function validarEntero($valor,$minimo,$maximo){
		limpiarCampos($valor);
		$valida = 0;
		
		if(empty($valor)){
			$valida = 1;
		}
		else if(!filter_var($valor,FILTER_VALIDATE_INT)){
			$valida = 2;
		}
		else if($valor < $minimo){
			$valida = 3;
		}
		
		else if($valor > $maximo){
			$valida = 4;
		}
		return $valida;
		return $valida;
	}
	
	function validarReal($valor,$minimo,$maximo){
		limpiarCampos($valor);
		$valida = 0;
		if(empty($valor)){
			$valida = 1;
		}
		else if(!filter_var($valor,FILTER_VALIDATE_FLOAT)){
			$valida = 2;
		}
		else if($valor < $minimo){
			$valida = 3;
		}
		
		else if($valor > $maximo){
			$valida = 4;
		}
		return $valida;
	}

	
	function validarBooleano($valor) {
		limpiarCampos($valor);
		$valida = 0;
		if(empty($valor)){
			$valida = 1;
		}
		else if(!filter_var($valor,FILTER_VALIDATE_BOOLEAN)){
			$valida = 2;
		}
		return $valida;
	}

	function validarURL($valor) {
		limpiarCampos($valor);
		$valida = 0;
		if(empty($valor)){
			$valida = 1;
		}
		else if(!filter_var($valor,FILTER_VALIDATE_URL)){
			$valida = 2;
		}
		
		return $valida;
	}
	
	function validarEmail($valor) {
		limpiarCampos($valor);
		$valida = 0;
		if(empty($valor)){
			$valida = 1;
		}
		else if(!filter_var($valor,FILTER_VALIDATE_EMAIL)){
			$valida = 2;
		}
		
		return $valida;
	}
	
	function validarDNI($valor) {
		limpiarCampos($valor);
		$valida = 0;
		if (empty($valor)){
			$valida = 1;
		}
		else if (!( substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 8 )){
			$valida = 2;
		}

		return $valida;
	}
	
	function validarTelefono($valor) {
		
		
		limpiarCampos($valor);
		$valida = 0;
		$patron =  "/^((\+?34([ \t|\-])?)?[9|6|7]((\d{1}([ \t|\-])?[0-9]{3})|(\d{2}([ \t|\-])?[0-9]{2}))([ \t|\-])?[0-9]{2}([ \t|\-])?[0-9]{2})$/";
       
		if(empty($valor)) {
			$valida = 1;
		}
		else if(!preg_match($patron_texto, $valor)) {
			$valida = 2;
		}
		return $valida;
		
		
	}
	
	function validarVector($valor) {
		$valida = 0;
		if (!isset($valor)){
			$valida = 1;
		}
		return $valida;
	}
	
      /*  function validarCadenaAlfabetica2($valor,$minimo,$maximo) {
		limpiarCampos($valor);
		$respuesta = "";
		$patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙñ\s]+$/";
       
		if(empty($valor)) {
			$respuesta .= "La cadena esta vacia Funcion 2 ";
		}
		else if(!preg_match($patron_texto, $valor)) {
			$respuesta .= "El valor no es valido Funcion 2";
		}
		else if(strlen($valor) < $minimo){
			$respuesta .= "Longitud minima no valida Funcion 2 ";
		}
		
		else if(strlen($valor) > $maximo){
			$respuesta .= "Longitud maxima  no valida Funcion 2";
		}
		return $respuesta;
		
	}*/
        
?>