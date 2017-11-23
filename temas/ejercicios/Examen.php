<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="estiloExamen.css">
        <title>Cuestionario</title>
    </head>
    <body>


        <?php
        //Autor: Mario Labra Villar
        //Ultima modificación: 25/10/2017 
         
        include "LibreriaValidacionFormulariosjc.php"; //libreria medio hecha por mi

        define("MIN", 5);       //Constante que indica minimo de valores de campo de texto
        define("MAX", 30);      //Constante que indica maximo de valores de campo de texto
        define("DIMENSION", 3); //Tamaño array
        $error = false;
        $arrayErrores = array(" ", "No ha introducido ningun valor<br />", "El valor introducido no es valido<br />", "Tamaño minimo no valido<br />", "Tamaño maximo no valido<br />"); //array en el que se almacenan los diferentes tipos de errores que puede dar dependiendo del valor que devuelva la libreria al validar
        $valida = 0;
       
        



        for ($i = 0; $i < DIMENSION; $i++) {  //BUCLE CUYA FINALIDAD ES EL MSIMO ARRAY 3 VECES
            $cuestionario[$i] = array(//En este array se almacenarán los datos
                'nombre' => '',
                'apellido' => '',
                'altura' => '',
                'fechanac' => '',
                'sexo' => '',
                'email' => '',
                'marca' => '',
                'caballos' => '',
                'url' => ''
            );

            $erroresCampos[$i] = array(//En este array se almacenan los posibles errores que puedan tener cada uno de los campos
                'nombre' => '',
                'apellido' => '',
                'altura' => '',
                'fechanac' => '',
                'sexo' => '',
                'email' => '',
                'marca' => '',
                'caballos' => '',
                'url' => ''
            );

            $arrayRadiob[$i] = array(//Array necesario para hacer radiobutom
                'Hombre' => '',
                'Mujer' => ''
            );
            $arrayMateriales[$i] = array(//Array necesario para hacer checkbox
                'Audi' => '',
                'Mercedes' => '',
                'Subaru' => '',
                'Brabus' => ''
            );
        }







       

        if (filter_has_var(INPUT_POST, 'enviar')) { //SI SE PULSA EL BOTON DE ENVIAR SE REALIZARAN LAS VALIDACIONES
            for ($i = 0; $i < DIMENSION; $i++) {    //El bucle sirve para no tener que repetir continuamente las validaciones y solo ponerlas una vez
                $valida = validarCadenaAlfabetica($_POST['nombre'][$i], MIN, MAX);
                if ($valida != 0) {
                    $erroresCampos[$i]['nombre'] = $arrayErrores[$valida];
                    $error = true;
                }else {
                    $cuestionario[$i]['nombre'] = $_POST['nombre'][$i];
                }

                $valida = validarCadenaAlfabetica($_POST['apellido'][$i], MIN, MAX);
                if ($valida != 0) {
                    $erroresCampos[$i]['apellido'] = $arrayErrores[$valida];
                    $error = true;
                }else {
                    $cuestionario[$i]['apellido'] = $_POST['apellido'][$i];
                }

                $valida = validarReal($_POST['altura'][$i], 1, MAX);
                if ($valida != 0) {
                    $erroresCampos[$i]['altura'] = $arrayErrores[$valida];
                    $error = true;
                }else {
                    $cuestionario[$i]['altura'] = $_POST['altura'][$i];
                }

                if (empty($_POST['fechanac'][$i])) {
                    $erroresCampos[$i]['fechanac'] = $arrayErrores[1];
                    $error = true;
                }else {
                    $cuestionario[$i]['fechanac'] = $_POST['fechanac'][$i];
                }

                $valida = validarEmail($_POST['email'][$i]);
                if ($valida != 0) {
                    $erroresCampos[$i]['email'] = $arrayErrores[$valida];
                    $error = true;
                } else {
                    $cuestionario[$i]['email'] = $_POST['email'][$i];
                }

                $valida = validarEntero($_POST['caballos'][$i], 1, 5000);
                if ($valida != 0) {
                    $erroresCampos[$i]['caballos'] = $arrayErrores[$valida];
                    $error = true;
                }else {
                    $cuestionario[$i]['caballos'] = $_POST['caballos'][$i];
                }

                $valida = validarURL($_POST['url'][$i]);
                if ($valida != 0) {
                    $erroresCampos[$i]['url'] = $arrayErrores[$valida];
                    $error = true;
                }else {
                    $cuestionario[$i]['url'] = $_POST['url'][$i];
                }

                if (!isset($_POST['sexo' . $i])) {
                    $erroresCampos[$i]['sexo'] = $arrayErrores[1];
                    $error = true;
                } else {
                    $cuestionario[$i]['sexo'] = $_POST['sexo' . $i];
                    $arrayRadiob[$i][$cuestionario[$i]['sexo']] = 'checked';
                }

                if (!isset($_POST['marcas' . $i])) {
                    $erroresCampos[$i]['marca'] = $arrayErrores[1];
                    $error = true;
                } else {
                    $cuestionario[$i]['marca'] = $_POST['marcas' . $i];
                    foreach ($cuestionario[$i]['marca'] as $valor) {
                        $arrayMateriales[$i][$valor] = "checked";
                    }
                }
            }
        }
        if (!filter_has_var(INPUT_POST, 'enviar') || $error) {
            ?>

            <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" id="formulario1" method="post">

                <div id="persona1">
                    <h4>Persona 1</h4>
                    <label for="nombre[0]">Nombre:</label><br />
                    <input type="text" name="nombre[0]" value="<?PHP echo $cuestionario[0]['nombre']; ?>"><br /><br />
                    <?PHP echo $erroresCampos[0]['nombre']; ?>

                    <label for="apellido[0]">Apellido:</label><br />
                    <input type="text" name="apellido[0]" value="<?PHP echo $cuestionario[0]['apellido']; ?>"><br /><br />
    <?PHP echo $erroresCampos[0]['apellido']; ?>

                    <label for="altura[0]">Altura:</label><br />
                    <input type="text" name="altura[0]" value="<?PHP echo $cuestionario[0]['altura']; ?>"><br /><br />
                    <?PHP echo $erroresCampos[0]['altura']; ?>
                    <label for="sexo0">Sexo:</label><br />
                    <input type="radio" name="sexo0" value="Hombre"<?php echo $arrayRadiob[0]['Hombre'] ?>>Hombre</input>
                    <input type="radio" name="sexo0" value="Mujer" <?php echo $arrayRadiob[0]['Mujer'] ?>>Mujer</input><br /><br />
                    <?PHP echo $erroresCampos[0]['sexo']; ?><br /><br />

                    <label for="email[0]">Email:</label><br />
                    <input type="text" name="email[0]" value="<?PHP echo $cuestionario[0]['email']; ?>"><br /><br />
    <?PHP echo $erroresCampos[0]['email']; ?>


                    <label for="fechanac[0]">Fecha nacimiento:</label><br />
                    <input type="date" name="fechanac[0]" value="<?PHP echo $cuestionario[0]['fechanac']; ?>"><br /><br />
                    <?PHP echo $erroresCampos[0]['fechanac']; ?>


                    <label for="marcas0[]">Marcas: </label><br />	
                    <input type="checkbox" name="marcas0[]" value="Audi" <?php echo $arrayMateriales[0]['Audi']; ?>>Audi <br />
                    <input type="checkbox" name="marcas0[]" value="Mercedes"  <?php echo $arrayMateriales[0]['Mercedes']; ?>>Mercedes<br />
                    <input type="checkbox" name="marcas0[]" value="Subaru" <?php echo $arrayMateriales[0]['Subaru']; ?>>Subaru<br />
                    <input type="checkbox" name="marcas0[]" value="Brabus" <?php echo $arrayMateriales[0]['Brabus']; ?>>Brabus<br /><br />
                    <?PHP echo $erroresCampos[0]['marca']; ?>

                    <label for="caballos[0]">Caballos:</label><br />
                    <input type="text" name="caballos[0]" value="<?PHP echo $cuestionario[0]['caballos']; ?>"><br /><br />
                    <?PHP echo $erroresCampos[0]['caballos']; ?>

                    <label for="url[0]">URL:</label><br />
                    <input type="text" name="url[0]" value="<?PHP echo $cuestionario[0]['url']; ?>"><br /><br />
    <?PHP echo $erroresCampos[0]['url']; ?>
                </div>

                <div id="persona2">
                    <h4>Persona 2</h4>
                    <label for="nombre[1]">Nombre:</label><br />
                    <input type="text" name="nombre[1]" value="<?PHP echo $cuestionario[1]['nombre']; ?>"><br /><br />
    <?PHP echo $erroresCampos[1]['nombre']; ?>

                    <label for="apellido[1]">Apellido:</label><br />
                    <input type="text" name="apellido[1]" value="<?PHP echo $cuestionario[1]['apellido']; ?>"><br /><br />
                    <?PHP echo $erroresCampos[1]['apellido']; ?>

                    <label for="altura[1]">Altura:</label><br />
                    <input type="text" name="altura[1]" value="<?PHP echo $cuestionario[1]['altura']; ?>"><br /><br />
    <?PHP echo $erroresCampos[1]['altura']; ?>

                    <label for="sexo1">Sexo:</label><br />
                    <input type="radio" name="sexo1" value="Hombre"<?php echo $arrayRadiob[1]['Hombre'] ?>>Hombre</input>
                    <input type="radio" name="sexo1" value="Mujer" <?php echo $arrayRadiob[1]['Mujer'] ?>>Mujer</input><br /><br />
    <?PHP echo $erroresCampos[1]['sexo']; ?><br /><br />

                    <label for="email[1]">Email:</label><br />
                    <input type="text" name="email[1]" value="<?PHP echo $cuestionario[1]['email']; ?>"><br /><br />
                    <?PHP echo $erroresCampos[1]['email']; ?>

                    <label for="fechanac[1]">Fecha nacimiento:</label><br />
                    <input type="date" name="fechanac[1]" value="<?PHP  echo $cuestionario[1]['fechanac']; ?>"><br /><br />
    <?PHP echo $erroresCampos[1]['fechanac']; ?>

                    <label for="marcas1[]">Marcas: </label><br />	
                    <input type="checkbox" name="marcas1[]" value="Audi" <?php echo $arrayMateriales[1]['Audi']; ?>>Audi <br />
                    <input type="checkbox" name="marcas1[]" value="Mercedes"  <?php echo $arrayMateriales[1]['Mercedes']; ?>>Mercedes<br />
                    <input type="checkbox" name="marcas1[]" value="Subaru" <?php echo $arrayMateriales[1]['Subaru']; ?>>Subaru<br />
                    <input type="checkbox" name="marcas1[]" value="Brabus" <?php echo $arrayMateriales[1]['Brabus']; ?>>Brabus<br /><br />
                    <?PHP echo $erroresCampos[1]['marca']; ?>


                    <label for="caballos[1]">Caballos:</label><br />
                    <input type="text" name="caballos[1]" value="<?PHP echo $cuestionario[1]['caballos']; ?>"><br /><br />
    <?PHP echo $erroresCampos[1]['caballos']; ?>

                    <label for="url[1]">URL:</label><br />
                    <input type="text" name="url[1]" value="<?PHP echo $cuestionario[1]['url']; ?>"><br /><br />
                    <?PHP echo $erroresCampos[1]['url']; ?>



                </div>

                <div id="persona2">
                    <h4>Persona 3</h4>
                    <label for="nombre[2]">Nombre:</label><br />
                    <input type="text" name="nombre[2]" value="<?PHP echo $cuestionario[2]['nombre']; ?>"><br /><br />
                    <?PHP echo $erroresCampos[2]['nombre']; ?>

                    <label for="apellido[2]">Apellido:</label><br />
                    <input type="text" name="apellido[2]" value="<?PHP echo $cuestionario[2]['apellido']; ?>"><br /><br />
    <?PHP echo $erroresCampos[2]['apellido']; ?>

                    <label for="altura[2]">Altura:</label><br />
                    <input type="text" name="altura[2]" value="<?PHP echo $cuestionario[2]['altura']; ?>"><br /><br />
    <?PHP echo $erroresCampos[2]['altura']; ?>

                    <label for="sexo2">Sexo:</label><br />
                    <input type="radio" name="sexo2" value="Hombre"<?php echo $arrayRadiob[2]['Hombre'] ?>>Hombre</input>
                    <input type="radio" name="sexo2" value="Mujer" <?php echo $arrayRadiob[2]['Mujer'] ?>>Mujer</input><br /><br />
            <?PHP echo $erroresCampos[2]['sexo']; ?><br /><br />

                    <label for="email[2]">Email:</label><br />
                    <input type="text" name="email[2]" value="<?PHP echo $cuestionario[2]['email']; ?>"><br /><br />
                <?PHP echo $erroresCampos[2]['email']; ?>

                    <label for="fechanac[2]">Fecha nacimiento:</label><br />
                    <input type="date" name="fechanac[2]" value="<?PHP  echo $cuestionario[2]['fechanac']; ?>"><br /><br />
                <?PHP echo $erroresCampos[2]['fechanac']; ?>

                    <label for="marcas2[]">Marcas: </label><br />	
                    <input type="checkbox" name="marcas2[]" value="Audi" <?php echo $arrayMateriales[2]['Audi']; ?>>Audi <br />
                    <input type="checkbox" name="marcas2[]" value="Mercedes"  <?php echo $arrayMateriales[2]['Mercedes']; ?>>Mercedes<br />
                    <input type="checkbox" name="marcas2[]" value="Subaru" <?php echo $arrayMateriales[2]['Subaru']; ?>>Subaru<br />
                    <input type="checkbox" name="marcas2[]" value="Brabus" <?php echo $arrayMateriales[2]['Brabus']; ?>>Brabus<br /><br />
                <?PHP echo $erroresCampos[2]['marca']; ?>

                    <label for="caballos[2]">Caballos:</label><br />
                    <input type="text" name="caballos[2]" value="<?PHP echo $cuestionario[2]['caballos']; ?>"><br /><br />
                <?PHP echo $erroresCampos[2]['caballos']; ?>

                    <label for="url[2]">URL:</label><br />
                    <input type="text" name="url[2]" value="<?PHP echo $cuestionario[2]['url']; ?>"><br /><br />
                <?PHP echo $erroresCampos[2]['url']; ?>

                </div>


                <input type="submit" name="enviar" value="Enviar">

            </form>

    <?php
    //EN EL CASO EN EL QUE TODO HAYA IDO BIEN PROCESAMOS EL FORUMULARIO Y MOSTRAMOS LOS DATOS POR PANTALLA
} else {
    ?>
            <div>

    <?php
    for ($i = 0; $i < sizeof($cuestionario); $i++) { //ESTA ESTRUCTURA NOS MUESTRA EL VALOR DE LOS DATOS QUE TIENEN LOS ARRAY
        foreach ($cuestionario[$i] as $clave => $valor) {
            if (is_array($valor)) {
                foreach ($valor as $campo) {
                    echo "$campo </br>";
                }
            } else {
                echo $clave . ":" . $valor . "<br />";
            }
        }
    }

   //$alutraMedia = ($cuestionario[0]['altura'] + $cuestionario[1]['altura'] + $cuestionario[2]['altura']) / 3;
    $alutraMedia = array_sum(array_column($cuestionario, 'altura'))/3;
    echo "Altura media: $alutraMedia<br />";
    //$maxCaballos= max($cuestionario[0]['caballos'],$cuestionario[1]['caballos'],$cuestionario[2]['caballos']);
    $maxCaballos = max(array_column($cuestionario,'caballos'));
    echo "Mayor potencia: $maxCaballos<br />";
    //$minFechaNac= max($cuestionario[0]['fechanac'],$cuestionario[1]['fechanac'],$cuestionario[2]['fechanac']);
    $minFechaNac = max(array_column($cuestionario,'fechanac'));
    echo "La fecha de nacimiento de la persona mas joven es: $minFechaNac<br />";
}
?>
        </div>  
    </body>
</html>