<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="estiloCuestionario.css">
  <title>Cuestionario</title>
</head>
<body>


<?php
		include "LibreriaValidacionFormulariosjc.php";
		
		$MIN = 5;
		$MAX = 30;
		$DIMENSION = 3;
		$error = false;
		$valida = 0;
		
		$cuestionario = array();
		
		for($i = 0;$i < $DIMENSION; $i++){
			$cuestionario[$i] = array(
			'nombre' => '',
			'apellido' => '',
                        'altura' => '',
                        'fechanac' => '',
                        'sexo'=> '',
                        'email'=>''
			);
				
		}
                
                for($i = 0;$i < $DIMENSION; $i++){
			$arrayRadiob[$i] = array(
			'Hombre' => '',
			'Mujer' => ''
                    
			);
				
		}
		
		for($i = 0;$i < $DIMENSION; $i++){
			$erroresCampos[$i] = array(
			'nombre' => '',
			'apellido' => '',
                        'altura' => '',
                        'fechanac' => '',
                        'sexo'=> '',
                        'email'=>''
			);
				
		}
		
		
		$cuestionario[1] = array(
			'nombre' => '',
			'apellido' => '',
                        'altura' => '',
                        'fechanac' => '',
                        'sexo'=> '',
                        'email'=>''
		);
		
		
		$arrayErrores = array(" ", "No ha introducido ningun valor<br />", "El valor introducido no es valido<br />","Tamaño minimo no valido<br />", "Tamaño maximo no valido<br />");
		
		if (filter_has_var(INPUT_POST,'enviar')){
			
			
			for ($i = 0;$i<$DIMENSION;$i++){
			$valida = validarCadenaAlfabetica($_POST['nombre'][$i],$MIN,$MAX);
			if($valida != 0) {
			$erroresCampos[$i]['nombre'] = $arrayErrores[$valida];
			$error = true;
			}
			else {
				$cuestionario[$i]['nombre'] = $_POST['nombre'][$i];
				
			}
						
				
			$valida =  validarCadenaAlfabetica($_POST['apellido'][$i],$MIN,$MAX);
			if($valida != 0) {
				$erroresCampos[$i]['apellido'] = $arrayErrores[$valida];
				$error = true;
				}
				else {
					$cuestionario[$i]['apellido'] = $_POST['apellido'][$i];
			}
                        
                        $valida = validarReal($_POST['altura'][$i],1,$MAX);
			if($valida != 0) {
				$erroresCampos[$i]['altura'] = $arrayErrores[$valida];
				$error = true;
				}
				else {
					$cuestionario[$i]['altura'] = $_POST['altura'][$i];
			}
                        
                        
                        
            $valida = validarEmail($_POST['email'][$i]);
			if($valida != 0) {
			$erroresCampos[$i]['email'] = $arrayErrores[$valida];
			$error = true;
			}
			else {
				$cuestionario[$i]['email'] = $_POST['email'][$i];
				
			}
                        
                        
			if(!isset($_POST['sexo0'])) {
				$erroresCampos[0]['sexo'] = $arrayErrores[1];
				$error = true;
				}
				else {
					$cuestionario[0]['sexo'] = $_POST['sexo0'];
					$arrayRadiob[0][$cuestionario[0]['sexo']] = 'checked';
			}
			
			if(!isset($_POST['sexo1'])) {
				$erroresCampos[1]['sexo'] = $arrayErrores[1];
				$error = true;
				}
				else {
					$cuestionario[1]['sexo'] = $_POST['sexo1'];
					$arrayRadiob[1][$cuestionario[1]['sexo']] = 'checked';
			}
			
			if(!isset($_POST['sexo2'])) {
				$erroresCampos[2]['sexo'] = $arrayErrores[1];
				$error = true;
				}
				else {
					$cuestionario[2]['sexo'] = $_POST['sexo2'];
					$arrayRadiob[2][$cuestionario[2]['sexo']] = 'checked';
					
			}

			
			}
			
			
			
			/*foreach($_POST as $clave => $array){
				
				for($i = 0; $i < sizeof($array);$i++){
					if($clave != 'enviar'){
					
						$cuestionario[$i][$clave] = $_POST[$clave][$i];
						
					}
					echo "$clave:$array[$i]</br>";
				}
				
			}
			
			print_r($cuestionario);
			*/
			
		}
		if(!filter_has_var(INPUT_POST,'enviar')|| $error ){
			
			?>
			
			<form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" id="formulario1" method="post">
	
			<div id="persona1">
				<label for="nombre[0]">Nombre:</label><br />
				<input type="text" name="nombre[0]" value="<?PHP echo $cuestionario[0]['nombre']; ?>"><br /><br />
				<?PHP echo $erroresCampos[0]['nombre']; ?>
			
				<label for="apellido[0]">Apellido:</label><br />
				<input type="text" name="apellido[0]" value="<?PHP echo $cuestionario[0]['apellido']; ?>"><br /><br />
				<?PHP echo $erroresCampos[0]['apellido']; ?>
                                
                                <label for="altura[0]">Altura:</label><br />
				<input type="text" name="altura[0]" value="<?PHP echo $cuestionario[0]['altura']; ?>"><br /><br />
				<?PHP echo $erroresCampos[0]['altura']; ?>
                                
                                <input type="radio" name="sexo0" value="Hombre"<?php echo $arrayRadiob[0]['Hombre'] ?>>Hombre</input>
                                <input type="radio" name="sexo0" value="Mujer" <?php echo $arrayRadiob[0]['Mujer'] ?>>Mujer</input><br /><br />
                                <?PHP echo $erroresCampos[0]['sexo']; ?><br /><br />
                                
                                 <label for="email[0]">Email:</label><br />
				<input type="text" name="email[0]" value="<?PHP echo $cuestionario[0]['email']; ?>"><br /><br />
				<?PHP echo $erroresCampos[0]['email']; ?>
			</div>
			
			<div id="persona2">
				<label for="nombre[1]">Nombre:</label><br />
				<input type="text" name="nombre[1]" value="<?PHP echo $cuestionario[1]['nombre']; ?>"><br /><br />
				<?PHP echo $erroresCampos[1]['nombre']; ?>
			
				<label for="apellido[1]">Apellido:</label><br />
				<input type="text" name="apellido[1]" value="<?PHP echo $cuestionario[1]['apellido']; ?>"><br /><br />
				<?PHP echo $erroresCampos[1]['apellido']; ?>
                                
                                 <label for="altura[1]">Altura:</label><br />
				<input type="text" name="altura[1]" value="<?PHP echo $cuestionario[0]['altura']; ?>"><br /><br />
				<?PHP echo $erroresCampos[1]['altura']; ?>
                                
                                 <input type="radio" name="sexo1" value="Hombre"<?php echo $arrayRadiob[1]['Hombre'] ?>>Hombre</input>
                                <input type="radio" name="sexo1" value="Mujer" <?php echo $arrayRadiob[1]['Mujer'] ?>>Mujer</input><br /><br />
                                <?PHP echo $erroresCampos[1]['sexo']; ?><br /><br />
                                
                                <label for="email[1]">Email:</label><br />
				<input type="text" name="email[1]" value="<?PHP echo $cuestionario[1]['email']; ?>"><br /><br />
				<?PHP echo $erroresCampos[1]['email']; ?>
			</div>
			
			<div id="persona2">
				<label for="nombre[2]">Nombre:</label><br />
				<input type="text" name="nombre[2]" value="<?PHP echo $cuestionario[2]['nombre']; ?>"><br /><br />
				<?PHP echo $erroresCampos[2]['nombre']; ?>
			
				<label for="apellido[2]">Apellido:</label><br />
				<input type="text" name="apellido[2]" value="<?PHP echo $cuestionario[2]['apellido']; ?>"><br /><br />
				<?PHP echo $erroresCampos[2]['apellido']; ?>
                                
                                 <label for="altura[2]">Altura:</label><br />
				<input type="text" name="altura[2]" value="<?PHP echo $cuestionario[2]['altura']; ?>"><br /><br />
				<?PHP echo $erroresCampos[2]['altura']; ?>
                                
                                 <input type="radio" name="sexo2" value="Hombre"<?php echo $arrayRadiob[2]['Hombre'] ?>>Hombre</input>
                                <input type="radio" name="sexo2" value="Mujer" <?php echo $arrayRadiob[2]['Mujer'] ?>>Mujer</input><br /><br />
                                <?PHP echo $erroresCampos[2]['sexo']; ?><br /><br />
                                
                                 <label for="email[2]">Email:</label><br />
				<input type="text" name="email[2]" value="<?PHP echo $cuestionario[2]['email']; ?>"><br /><br />
				<?PHP echo $erroresCampos[2]['email']; ?>
			</div>
			
		
			<input type="submit" name="enviar" value="Enviar">
	
		</form>
			
			<?php
			
			}else{
				
				for($i = 0; $i < sizeof($cuestionario); $i++){
					
					foreach($cuestionario[$i] as $clave => $valor){
						
						echo $clave.":".$valor."<br />";
					}
				}
				
			}
			
			?>
		
</body>
</html>