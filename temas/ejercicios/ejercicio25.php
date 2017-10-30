<html> 
<head> 
    <META http-equiv=Content-Type content="text/html; charset=UTF-8"> 
    <link rel="icon" type="image/ico"  href="imagenes/favicon.ico"> 
    <link rel="stylesheet" type="text/css" href="../css/ejercicios1-30.css"> 
</head> 
<body> 
<?php 
//Autor: Mario Labra Villar
//Ultima modificación: 25/10/2017 
require 'LibreriaValidacion.php';// Instrucción para importar la libreria de funciones. 
$entradaOK=true;//Variable que controla si hay errores en el formulario. Si esta en 'true' la entrada es correcta. 
$aErrores;// Array para guardar mensajes y errores: 
$aEncuesta = array();//Array que contiene las respuestas de la encuesta. 
//Inicialización del array que contiene las respuestas de la encuesta y los errores. 

    $aEncuesta = array(); 
    $aEncuesta[0] = array( 
       'fecha' => '', 
       'temperatura' => '', 
       'presion' => '' 
    ); 
    $aErrores = array( 
       'fecha' => '', 
       'temperatura' => '', 
       'presion' => '' 
    ); 

    $cont = 0; 

// Condición para ver si se ha pulsado el botón de enviar. 
if(isset($_POST['calcular'])) { 


        // Usamos las funciones de validación y guardamos el resultado en el array $aErrores 
        // si hay algun campo erroneo entonces asigna al error null. 

     
        $aErrores['fecha']=validarFecha($_POST['fecha'],1); 
        $aErrores['temperatura']= comprobarFloat($_POST['temperatura'],1); 
        $aErrores['presion']=comprobarEntero($_POST['presion'],1); 
         
         

    //Bucle que recorre el array de errores para comprobar si hay alguno que tiene el valor null. 
    //Si encuentra un error en null entonces cambia el valor de $entradaOK a false. 
    foreach($aErrores as $valor){ 
            if($valor!=null){ 
                $entradaOK=false; 
            } 
        } 

} 
//Condición que controla que nunca se haya pulsado el boton enviar y la entrada no este en true. 
if(!filter_has_var(INPUT_POST,'calcular')|| $entradaOK==false ){ 
?> 
<!--    Estructura del formulario.--> 
<form name="input" action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method="post"> 

         
            <div id=""> 
                

                <!--        Tipo fecha --> 
                Fecha:<br> 
                <input type="date" name="fecha" <?php if(isset($_POST['fecha'][0]) && empty($mensajeError['fecha'])){ echo 'value="',$_POST['fecha'],'"';}?>/> 
                <span class="error"><?php echo $aErrores["fecha"];?></span><hr> 

                   <!--        Tipo numerico flotante--> 
               Temperatura:<br> 
                <input type="number" name="temperatura" step="0.01" min="-30" max="50"<?php if(isset($_POST['temperatura']) && empty($mensajeError['temperatura'])){ echo 'value="',$_POST['temperatura'],'"';}?> /> 
                <span class="error"><?php echo $aErrores["temperatura"];?></span><hr> 

                <!--        Tipo numerico entero--> 
                Presion :<br> 
                <input type="number" name="presion" min="950" max="1050"<?php if(isset($_POST['presion']) && empty($mensajeError['presion'])){ echo 'value="',$_POST['presion'],'"';}?> /> 
                <span class="error"><?php echo $aErrores["presion"];?></span><hr> 

           


        <!--      Botones para enviar el formulario y para limpiar los campos--> 
        <input id="enviar" type="submit" value="Añadir registro" name="anadir"/> 
         <input id="enviar" type="submit" value="Calcular promedios" name="calcular"/> 

    </form> 
    <!--        Fin de la estructura del formulario.--> 
    <?php 
    //Y en caso de que no haya error y se haya pulsado el botón de enviar se muestra la información del formulario. 
    } 
    else{ 
         
             
            $aEncuesta[0] = array( 
            'fecha' => $_POST['fecha'], 
            'temperatura' => $_POST['temperatura'], 
            'presion' => $_POST['presion']            
            ); 


        //Instruciones para mostrar los datos introducidos en el formulario. 
        echo "<div>"; 
            
            
          
             echo "Fecha:".$aEncuesta[0]['fecha']."<br>";
             echo "Temperatura:".$aEncuesta[0]['temperatura']."<br>";
             echo "Presion:".$aEncuesta[0]['presion']."<br>";
            echo "Temperatura maxima:". max(array_column($aEncuesta,'temperatura'))."<br>"." Temperatura Minima:". min(array_column($aEncuesta,'temperatura'))."<br>"." Media Temperatura:".array_sum(array_column($aEncuesta,'temperatura'))."<br />" ;  
            echo "Presion maxima:". max(array_column($aEncuesta,'presion'))."<br>"." Presion minima:".min(array_column($aEncuesta,'presion'))."<br>"." Media presion:".array_sum(array_column($aEncuesta,'presion'))/1; 
       echo "</div>"; 
    } 
    ?> 
</body> 
</html>