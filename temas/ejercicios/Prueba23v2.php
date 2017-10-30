<html>
    <head>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title></title>
    </head>
    <body>
       
	   <?php
           
                include 'LibreriaValidacionFormulariosmlv.php';
               /* include 'Libreria3.php';*/
	   
                $MIN = 5;
		$MAX = 30;
		$DIMENSION = 3;
                $errores=0;
                $cuestionario = array();
		
		for($i = 0;$i < $DIMENSION; $i++){
			$cuestionario[$i] = array(
			'nombre' => '',
			'apellido' => '',
                        'sexo'=>'',
                        'edad'=>'',
                        'altura'=>''    
			);
				
		}
		
		for($i = 0;$i < $DIMENSION; $i++){
			$erroresCampos[$i] = array(
			'nombre' => '',
			'apellido' => '',
                        'sexo'=> '',
                        'edad'=>'',
                        'altura'=>''
			);
				
		}
		
		
		$cuestionario[1] = array(
			'nombre' => '',
			'apellido' => '',
                        'sexo'=> ''
		);
                
                
            $arrayErrores = array(" ", "No ha introducido ningun valor<br />", "El valor introducido no es valido<br />","Tamaño minimo no valido<br />", "Tamaño maximo no valido<br />");
			
			$error = false;
			
			
			if(isset($_POST['enviar'])){
				
                                $errores = validarCadenaAlfabetica($_POST['nombre'][0], $MIN,$MAX);
				if($errores!=0){
                                    $erroresCampos[0]['nombre'] = $arrayErrores[$errores];
					$error = true;
				}
				else {
					$cuestionario[0]['nombre'] = $_POST['nombre'][0];
					
				}
                                
                               
                                
				
                                $errores = validarCadenaAlfabetica($_POST['apellido'][0], $MIN,$MAX);
				if($errores!=0){
                                    $erroresCampos[0]['apellido'] = $arrayErrores[$errores];
					$error = true;
				}
				else {
					$cuestionario[0]['apellido'] = $_POST['apellido'][0];
					
				}
				
				 $errores = validarBooleano($_POST['sexo'][0]);
				if($errores!=0){
                                    $erroresCampos[0]['sexo'] = $arrayErrores[$errores];
					$error = true;
				}
				else {
					$cuestionario[0]['sexo'] = $_POST['sexo'][0];
					$cuestionario[0]['sexo']= "checked";
				}
                                
                                $errores = validarEntero($_POST['edad'][0], $MIN,$MAX);
				if($errores!=0){
                                    $erroresCampos[0]['edad'] = $arrayErrores[$errores];
					$error = true;
				}
				else {
					$cuestionario[0]['edad'] = $_POST['edad'][0];
					
				}
                                
                                 $errores = validarFloat($_POST['altura'][0], $MIN,$MAX);
				if($errores!=0){
                                    $erroresCampos[0]['altura'] = $arrayErrores[$errores];
					$error = true;
				}
				else {
					$cuestionario[0]['altura'] = $_POST['altura'][0];
					
				}
                                
                                 $errores = validarCadenaAlfabetica($_POST['nombre'][1], $MIN,$MAX);
				if($errores!=0){
                                    $erroresCampos[1]['nombre'] = $arrayErrores[$errores];
					$error = true;
				}
				else {
					$cuestionario[1]['nombre'] = $_POST['nombre'][1];
					
				}
                                
                               
                                
				
                                $errores = validarCadenaAlfabetica($_POST['apellido'][1], $MIN,$MAX);
				if($errores!=0){
                                    $erroresCampos[1]['apellido'] = $arrayErrores[$errores];
					$error = true;
				}
				else {
					$cuestionario[1]['apellido'] = $_POST['apellido'][1];
					
				}
				
				 $errores = validarBooleano($_POST['sexo'][1]);
				if($errores!=0){
                                    $erroresCampos[1]['sexo'] = $arrayErrores[$errores];
					$error = true;
				}
				else {
					$cuestionario[1]['sexo'] = $_POST['sexo'][1];
					$cuestionario[1]['sexo']= "checked";
				}
                                
                                $errores = validarEntero($_POST['edad'][1], $MIN,$MAX);
				if($errores!=0){
                                    $erroresCampos[1]['edad'] = $arrayErrores[$errores];
					$error = true;
				}
				else {
					$cuestionario[1]['edad'] = $_POST['edad'][1];
					
				}
                                
                                 $errores = validarFloat($_POST['altura'][1], $MIN,$MAX);
				if($errores!=0){
                                    $erroresCampos[1]['altura'] = $arrayErrores[$errores];
					$error = true;
				}
				else {
					$cuestionario[1]['altura'] = $_POST['altura'][1];
					
				}
                                
                                 $errores = validarCadenaAlfabetica($_POST['nombre'][2], $MIN,$MAX);
				if($errores!=0){
                                    $erroresCampos[2]['nombre'] = $arrayErrores[$errores];
					$error = true;
				}
				else {
					$cuestionario[2]['nombre'] = $_POST['nombre'][2];
					
				}
                                
                               
                                
				
                                $errores = validarCadenaAlfabetica($_POST['apellido'][2], $MIN,$MAX);
				if($errores!=0){
                                    $erroresCampos[2]['apellido'] = $arrayErrores[$errores];
					$error = true;
				}
				else {
					$cuestionario[2]['apellido'] = $_POST['apellido'][2];
					
				}
				
				 $errores = validarBooleano($_POST['sexo'][2]);
				if($errores!=0){
                                    $erroresCampos[2]['sexo'] = $arrayErrores[$errores];
					$error = true;
				}
				else {
					$cuestionario[2]['sexo'] = $_POST['sexo'][2];
					$cuestionario[2]['sexo']= "checked";
				}
                                
                                $errores = validarEntero($_POST['edad'][2], $MIN,$MAX);
				if($errores!=0){
                                    $erroresCampos[2]['edad'] = $arrayErrores[$errores];
					$error = true;
				}
				else {
					$cuestionario[2]['edad'] = $_POST['edad'][2];
					
				}
                                
                                 $errores = validarFloat($_POST['altura'][2], $MIN,$MAX);
				if($errores!=0){
                                    $erroresCampos[2]['altura'] = $arrayErrores[$errores];
					$error = true;
				}
				else {
					$cuestionario[2]['altura'] = $_POST['altura'][2];
					
				}
                                
                                
			}
			
	   
			if(!isset($_POST['enviar']) || $error){
				
				?>
				
			<form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method="post">
                        
                            
                            <div id="1">
			<label for="nombre[0]">Nombre:</label><br />
			<input type="text" name="nombre[0]" value="<?php echo $cuestionario[0]['nombre']; ?>"><br /><br />
			<?PHP echo $erroresCampos[0]['nombre']; ?>
			<label for="apellido[0]">Apellido:</label><br />
			<input type="text" name="apellido[0]" value="<?php echo $cuestionario[0]['apellido']; ?>"><br /><br />
			<?PHP echo $erroresCampos[0]['apellido']; ?>
			<input type="radio" name="sexo" value="Hombre"<?php echo $cuestionario[0]['sexo'] ?>>Hombre</input>
			<input type="radio" name="sexo" value="Mujer" <?php echo $cuestionario[0]['sexo'] ?>>Mujer</input><br /><br />
			<?PHP echo $erroresCampos[0]['sexo']; ?><br /><br />
                        <input type="text" name="edad[0]" value="<?php echo $cuestionario[0]['edad']?>">Edad</input>
                        <?PHP echo $erroresCampos[0]['edad']; ?><br /><br />
                        <input type="text" name="altura[0]" value="<?php echo $cuestionario[0]['altura']?>">Altura</input>
                        <?PHP echo $erroresCampos[0]['altura']; ?><br /><br />      
			
			
                            </div>
                            
                             <div id="2">
			<label for="nombre[0]">Nombre:</label><br />
			<input type="text" name="nombre[0]" value="<?php echo $cuestionario[1]['nombre']; ?>"><br /><br />
			<?PHP echo $erroresCampos[0]['nombre']; ?>
			<label for="apellido[0]">Apellido:</label><br />
			<input type="text" name="apellido[0]" value="<?php echo $cuestionario[1]['apellido']; ?>"><br /><br />
			<?PHP echo $erroresCampos[0]['apellido']; ?>
			<input type="radio" name="sexo" value="Hombre"<?php echo $cuestionario[1]['sexo'] ?>>Hombre</input>
			<input type="radio" name="sexo" value="Mujer" <?php echo $cuestionario[1]['sexo'] ?>>Mujer</input><br /><br />
			<?PHP echo $erroresCampos[0]['sexo']; ?><br /><br />
                        <input type="text" name="edad[0]" value="<?php echo $cuestionario[1]['edad']?>">Edad</input>
                        <?PHP echo $erroresCampos[0]['edad']; ?><br /><br />
                        <input type="text" name="altura[0]" value="<?php echo $cuestionario[1]['altura']?>">Altura</input>
                        <?PHP echo $erroresCampos[0]['altura']; ?><br /><br />   
			
			
                            </div>
                            
                            
                             <div id="3">
			<label for="nombre[0]">Nombre:</label><br />
			<input type="text" name="nombre[0]" value="<?php echo $cuestionario[2]['nombre']; ?>"><br /><br />
			<?PHP echo $erroresCampos[0]['nombre']; ?>
			<label for="apellido[0]">Apellido:</label><br />
			<input type="text" name="apellido[0]" value="<?php echo $cuestionario[2]['apellido']; ?>"><br /><br />
			<?PHP echo $erroresCampos[0]['apellido']; ?>
			<input type="radio" name="sexo" value="Hombre"<?php echo $cuestionario[2]['sexo'] ?>>Hombre</input>
			<input type="radio" name="sexo" value="Mujer" <?php echo $cuestionario[2]['sexo'] ?>>Mujer</input><br /><br />
			<?PHP echo $erroresCampos[0]['sexo']; ?><br /><br />
                        <input type="text" name="edad[0]" value="<?php echo $cuestionario[2]['edad']?>">Edad</input>
                        <?PHP echo $erroresCampos[0]['edad']; ?><br /><br />
                        <input type="text" name="altura[0]" value="<?php echo $cuestionario[2]['altura']?>">Altura</input>
                        <?PHP echo $erroresCampos[0]['altura']; ?><br /><br />  
			
			
                            </div>
                            
                            <input type="submit" name="enviar" value="Enviar">
			</form>
				
		
		<?php
			}
			else{
				
				for($i = 0; $i < sizeof($cuestionario); $i++){
					
					foreach($cuestionario[$i] as $clave => $valor){
						
						echo $clave.":".$valor."<br />";
					}
				}
				
			}
	   
	   ?>
					
			
        
    </body>
</html>
