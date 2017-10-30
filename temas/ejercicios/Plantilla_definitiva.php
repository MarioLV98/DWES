<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" type="text/css" href="estilos23.css">
        <title></title>
    </head>
    <body>

       
        <?php
        //Autor: Mario Labra Villar
        //Ultima modificación: 25/10/2017 
        include "LibreriaValidacionFormulariosjc.php";
       
        $cuestionario = array( //Array de campos
            'texto' => '',
            'radiob' => '',
            'checkbox' => '',
            'fecha'=>'',
            'select'=>'', 
            'float'=>'',
            'entero'=>'' 
            
        );
        
        $erroresColor = array( //Array de campos
            'texto' => '',
            'radiob' => '',
            'checkbox' => '',
            'fecha'=>'',
            'select'=>'', 
            'float'=>'',
            'entero'=>'' 
            
        );
        $arrayRadiob = array( //array para sexo
            'Opcion1' => '',
            'Opcion2' => ''
        );
        
        $arrayCheckbox = array(  //Array de asignaturas
            '1' => '',
            '2' => '',
            '3' => '',
            '4' => ''
        );
        
        $arraySelect = array(   //Array para marca
            'a' => '', 
            'b' => '', 
            'c' => '', 
            'd' => '' 
        ); 
        
        $erroesCampos = array( //Array para los errores en los campos
            'texto' => '',
            'radiob' => '',
            'checkbox' => '',
            'fecha'=>'',
            'select'=>'', 
            'float'=>'',
            'entero'=>'' 
        );
        $error = false; //Variable booleana para errores
        $arrayErrores = array(" ", "No ha introducido ningun valor<br />", "El valor introducido no es valido<br />", "Tamaño minimo no valido<br />", "Tamaño maximo no valido<br />"); //Declaramos el array de errores
        $valida=0;  //Variable para saber si hay errores o no

        
        
            
        //SI SE PULSA ENVIAR SE REALIZARÁ LA VALIDACION DE LOS DATOS Y SE ALMACENARAN LOS DATOS EN LAS VARIABLES
        if (isset($_POST['enviar'])) { 

            $valida= validarCadenaAlfabetica($_POST['texto'],3,30);
            if ($valida!=0) {
                $erroesCampos['texto'] = $arrayErrores[$valida];
                $error = true;
                $erroresColor['texto'] = "error";
            }else{
                $cuestionario['texto']=$_POST['texto'];
            }
            
            

            if (empty($_POST['radiob'])) {
                $erroesCampos['radiob'] = $arrayErrores[1];
                $errora = true;
                $erroresColor['radiob'] = "error";
            } else {
                $cuestionario['radiob'] = $_POST['radiob'];
                $arrayRadiob[$cuestionario['radiob']] = "checked";
            }

            if (empty($_POST['checkbox'])) {
                $erroesCampos['checkbox'] =$arrayErrores[1];
                $error = true;
                $erroresColor['checkbox'] = "error";
            } else {
                $cuestionario['checkbox'] = $_POST['checkbox'];
                foreach($cuestionario['checkbox'] as $valor){
                    $arrayCheckbox[$valor] = 'checked';
                }
              
            }
            
            if (empty($_POST['fecha'])) {
                $erroesCampos['fecha'] = $arrayErrores[1];
                $error = true;
                $erroresColor['fecha'] = "error";
            }else{
                $cuestionario['fecha']=$_POST['fecha'];
            }
            
            if (empty($_POST['select'])) {
                $erroesCampos['select'] = $arrayErrores[1];
                $error = true;
                 $erroresColor['select'] = "error";
            } else {
                $cuestionario['select'] = $_POST['select'];
                $arraySelect[$cuestionario['select']] = "selected";
                    
            }
            
            $valida= validarReal($_POST['float'], 1, 5);
            if ($valida!=0) {
                $erroesCampos['float'] = $arrayErrores[$valida];
                $error = true;
                 $erroresColor['float'] = "error";
            }else{
                $cuestionario['float']=$_POST['float'];
            }
            
             $valida= validarReal($_POST['entero'], 1, 10);
            if ($valida!=0) {
                $erroesCampos['entero'] = $arrayErrores[$valida];
                $error = true;
                 $erroresColor['entero'] = "error";
            } else{
                $cuestionario['entero']=$_POST['entero'];
            }
        }

            //SI NO SE PULSA ENVIAR O LOS DATOS NO SON CORRECTOS NOS MOSTRARA LOS ERRORES EN LOS CAMPOS Y ALMACENARA LOS DATOS CORRECTOS
        if (!isset($_POST['enviar']) || $error) { //SI NO SE PULSA ENVIAR O LOS DATOS NO SON CORRECTOS NOS MOSTRARA LOS ERRORES EN LOS CAMPOS Y ALMACENARA LOS DATOS CORRECTOS
            ?>

            <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method="post">

                <label for="texto">Texto:</label><br />
                <input type="text" name="texto" value="<?php echo $cuestionario['texto']; ?>" class="<?php echo $erroresColor['texto']; ?>"></input><br /><br />
            <?PHP echo $erroesCampos['texto']; ?>
                
                <input type="radio" name="radiob" value="Opcion1" <?PHP  echo $arrayRadiob['Opcion1'] ?> class="<?php echo $erroresColor['radiob']; ?>">Opcion1</input>
                <input type="radio" name="radiob" value="Opcion2" <?PHP  echo $arrayRadiob['Opcion2'] ?> class="<?php echo $erroresColor['radiob'];?>">Opcion2</input><br /><br />
             <?PHP echo $erroesCampos['radiob']; ?>
                <input type="checkbox" name="checkbox[]" value="DWES" <?PHP echo $arrayCheckbox['1'] ?> class="<?php echo $erroresColor['checkbox'];?>">1</input>
                <input type="checkbox" name="checkbox[]" value="DWEC" <?PHP echo $arrayCheckbox['2'] ?> class="<?php echo $erroresColor['checkbox'];?>">2</input>
                <input type="checkbox" name="checkbox[]" value="DAW" <?PHP echo $arrayCheckbox['3'] ?> class="<?php echo $erroresColor['checkbox'];?>">3</input>
                <input type="checkbox" name="checkbox[]" value="DIW" <?PHP echo $arrayCheckbox['4'] ?> class="<?php echo $erroresColor['checkbox'];?>">4</input><br /><br />
                <?PHP echo $erroesCampos['checkbox']; ?>
                <label for="fecha">Fecha:</label><br />
                <input type="date" name="fecha" value="<?php echo $cuestionario['fecha']  ?>" class="<?php echo $erroresColor['fecha'];?>"></input><br /><br />
                <?PHP echo $erroesCampos['fecha']; ?><br /><br />
                <label for="select">Select:</label><br />     
                <select  name="select" class="<?php echo $erroresColor['select'];?>"> 
                     <option value="a" <?php echo $arraySelect['a'];?>>a</option> 
                     <option value="b" <?php echo $arraySelect['b'];?>>b</option> 
                     <option value="c" <?php echo $arraySelect['c'];?>>c</option> 
                     <option value="d" <?php echo $arraySelect['d'];?>>d</option> 
                 </select> 
            <br /> 
             <?PHP echo $erroesCampos['select']; ?><br /><br />
             
                <label for="float">Float:</label><br />
                <input type="text" name="float" value="<?php echo $cuestionario['float'];  ?>" class="<?php echo $erroresColor['float'];?>"></input><br /><br />
                 <?PHP echo $erroesCampos['float']; ?><br /><br />
                <label for="entero">Entero:</label><br />
                <input type="text" name="entero" value="<?php echo $cuestionario['entero']; ?>" class="<?php echo $erroresColor['entero'];?>"></input><br /><br />
                 <?PHP echo $erroesCampos['entero']; ?><br /><br />
                <input type="submit" name="enviar" value="Enviar"></input>


            </form>


    <?php
    //EN EL CASO EN EL QUE TODO HAYA IDO BIEN PROCESAMOS EL FORUMULARIO Y MOSTRAMOS LOS DATOS POR PANTALLA
} else { 
    

  
    foreach($cuestionario as $indice => $respuesta){
        if(is_array($respuesta)){
            echo($indice.":"."<br />");
            
            foreach($respuesta as $valor ){
                echo $valor."<br />";
            }
        }
        else{
            echo $indice.":".$respuesta."<br />";;
        }
    }

   /* echo "Nombre:".$cuestionario['nombre']."<br />";
    echo "Apellido:".$cuestionario['apellido']."<br />";
    echo "Sexo:".$cuestionario['sexo']."<br />";
   
       
    foreach ($arrayAsignaturas as $asig => $as){
        
         echo "Asignaturas:$as --> $asig. <br />";
        
    }
    echo "Fecha nacimiento:".$cuestionario['fechaNac']."<br />";
    echo "Altura:".$cuestionario['altura']."<br />";
    echo "Numero hermanos:".$cuestionario['numero_hermanos']."<br />";*/
}
?>



    </body>
</htm

