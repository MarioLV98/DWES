<?php 
    //Funciones de Validación 
    //Blibioteca con funciones de validación 
            //Función para comprobar si es un campo solo texto 
            //Return 1 es correcto, si no muestra el error 
            // Si es un 1 es obligatorio, si es un 0 no lo es 
             function comprobarTexto($cadena,$maxTamanio,$minTamanio,$obligatorio){ 
                 //Patrón para campos de solo texto 
                $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/"; 
                $cadena=htmlspecialchars(strip_tags(trim($cadena)));  
                $correcto=null; 
                if( preg_match($patron_texto, $cadena) && comprobarNoVacio((string)$cadena) && comprobarMaxTamanio((string)$cadena,$maxTamanio) && comprobarMinTamanio((string)$cadena,$minTamanio) )
                {         
                    $correcto = 1; 
                } 
                if (comprobarNoVacio((string)$cadena)==false && $obligatorio==1){ 
                    $correcto= "Campo Vacio"; 
                } 
                if (comprobarMaxTamanio((string)$cadena,$maxTamanio)==false && $obligatorio==1){ 
                    $correcto .=" El tamaño maximo es ".$maxTamanio ; 
                } 
                if (comprobarMinTamanio((string)$cadena,$minTamanio)==false && $obligatorio==1 ){ 
                    $correcto.=" El tamaño minimo es ".$minTamanio; 
                } 
                return $correcto; 
             } 
             //Función para comprobar un campo AlfaNumerico 
            //Return 1 es correcto, si no muestra el error 
            // Si es un 1 es obligatorio, si es un 0 no lo es 
             function comprobarAlfaNumerico($cadena,$maxTamanio,$minTamanio,$obligatorio){ 
                $cadena=htmlspecialchars(strip_tags(trim($cadena)));  
                $correcto =null; 
                if (comprobarNoVacio((string)$cadena) && comprobarMaxTamanio((string)$cadena,$maxTamanio) && comprobarMinTamanio((string)$cadena,$minTamanio)){ 
                    $correcto =1; 
                } 
                if (comprobarNoVacio((string)$cadena)==false && $obligatorio==1){ 
                    $correcto= "Campo Vacio"; 
                } 
                if (comprobarMaxTamanio((string)$cadena,$maxTamanio)==false && $obligatorio==1 )  { 
                    $correcto .=" El tamaño maximo es ".$maxTamanio ; 
                } 
                if (comprobarMinTamanio((string)$cadena,$minTamanio)==false && $obligatorio==1 ){ 
                    $correcto.=" El tamaño minimo es ".$minTamanio; 
                } 
                return $correcto; 
             } 
             //Función para comprobar si es un campo entero 
             //Return 1 es correcto, si no muestra el error 
            // Si es un 1 es obligatorio, si es un 0 no lo es 
             function comprobarEntero($integer,$obligatorio){ 
                $correcto = null; 
                if( filter_var($integer, FILTER_VALIDATE_INT)){ 
                    $correcto = 1; 
                } 
                if (!comprobarNoVacio($integer) && $obligatorio==1){ 
                    $correcto= "Campo Vacio"; 
                } 
                return $correcto; 
             } 
             //Función para comprobar si es un campo float 
             //Return 1 es correcto, si no muestra el error 
            // Si es un 1 es obligatorio, si es un 0 no lo es 
             function comprobarFloat($float,$obligatorio){ 
                $correcto = null; 
                if (filter_var($float, FILTER_VALIDATE_FLOAT)){ 
                    $correcto= 1; 
                } 
                if (!comprobarNoVacio($float && $obligatorio==1)){ 
                    $correcto= "Campo Vacio"; 
                } 
                return $correcto; 
             } 
             //Función para comprobar si es un correo electronico 
            //Return 1 es correcto, si no muestra el error 
            // Si es un 1 es obligatorio, si es un 0 no lo es 
             function validarEmail ($email,$maxTamanio,$minTamanio,$obligatorio){ 
                $correcto = null; 
                if (filter_var($email, FILTER_VALIDATE_EMAIL)){ 
                    $correcto = 1; 
                } 
                if (!comprobarNoVacio($email) && $obligatorio==1){ 
                    $correcto= "Campo Vacio"; 
                } 
                if (!comprobarMaxTamanio($email,$maxTamanio) && $obligatorio==1 && comprobarNoVacio($email)){ 
                    $correcto .=" El tamaño maximo es ".$maxTamanio ; 
                } 
                if (!comprobarMinTamanio($email,$minTamanio) && $obligatorio==1 && comprobarNoVacio($email)){ 
                    $correcto.=" El tamaño minimo es ".$minTamanio; 
                } 
                return $correcto; 
             }              
             //Función para comprobar si es una url 
            //Return 1 es correcto, si no muestra el error 
            // Si es un 1 es obligatorio, si es un 0 no lo es 
             function validarURL ($url,$maxTamanio,$minTamanio,$obligatorio){ 
                $correcto = null; 
                if (filter_var ($url, FILTER_VALIDATE_URL)){ 
                    $correcto = 1; 
                } 
                if (!comprobarNoVacio($url) && $obligatorio==1){ 
                    $correcto= "Campo Vacio"; 
                } 
                if (!comprobarMaxTamanio($url,$maxTamanio) && $obligatorio==1 && comprobarNoVacio($url)){ 
                    $correcto .=" El tamaño maximo es ".$maxTamanio ; 
                } 
                if (!comprobarMinTamanio($url,$minTamanio) && $obligatorio==1 && comprobarNoVacio($url)){ 
                    $correcto.=" El tamaño minimo es ".$minTamanio; 
                } 
                return $correcto; 
             } 
            //Función para validar si no esta vacio 
            //Return false esta vacio, true no esta vacio 
            function comprobarNoVacio($cadena){ 
                $correcto = false; 
                $cadena=htmlspecialchars(strip_tags(trim($cadena)));  
                if (!empty($cadena)){ 
                    $correcto=true; 
                } 
                return $correcto; 
            } 
            //Función para tamaño maximo 
            // Si tamaño es 0 significa que no tiene limite 
            //Return false no valida, true valida 
            function comprobarMaxTamanio ($cadena,$tamanio){ 
                $correcto= false; 
                if ((strlen($cadena))<=$tamanio || $tamanio==0){ 
                    $correcto=true; 
                } 
                return $correcto;                 
            } 
            //Función para tamaño minimo 
            // Si tamaño es 0 significa que no tiene limite 
            //Return false no valida, true valida 
            function comprobarMinTamanio ($cadena,$tamanio){ 
                $correcto= false; 
                if (strlen($cadena)>=$tamanio || $tamanio==0){ 
                    $correcto=true; 
                } 
                return $correcto;                 
            } 
        ?>