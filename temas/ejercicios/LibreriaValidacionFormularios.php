<?php

	function limpiarCampos($valor){
		
		return strip_tags(trim($valor));
	}
	
	function comprobarTexto($valor){ 
                 //Patrón para campos de solo texto 
                $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/"; 
                $valor=limpiarCampos($valor);  
                $correcto=null; 
                if( preg_match($patron_texto, $valor))
                {         
                    $correcto = 1; 
                } 
                return $correcto; 
             } 
	
	function validarEntero($valor){
		$valido = true;
		if(!filter_var($valor,FILTER_VALIDATE_INT)){
			$valido = false;
		}
		
		return $valido;
	}
	
	
	function validarFloat($valor){
		
		$valido = true;
		if(!filter_var($valor,FILTER_VALIDATE_FLOAT)){
			$valido = false;
		}
		
		return $valido;
		
	}
	
	function validarBooleano($valor){
		
		
	}
	
	function validarDNI($valor){
		
		
	}
	
	function validarTelefono($valor){
		
		
	}
	
	function validarEmail($valor){
		
		
	}
	
?>