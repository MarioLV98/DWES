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
            'nombre' => '',
            'apellido' => '',
            'sexo' => '',
            'asignatura' => '',
            'fechaNac'=>'',
            'marca'=>'', 
            'altura'=>'',
            'numero_hermanos'=>'' 
            
        );
        
        $erroresColor = array( //Array de campos
            'nombre' => '',
            'apellido' => '',
            'sexo' => '',
            'asignatura' => '',
            'fechaNac'=>'',
            'marca'=>'', 
            'altura'=>'',
            'numero_hermanos'=>'' 
            
        );
        $arrayRadiob = array( //array para sexo
            'Hombre' => '',
            'Mujer' => ''
        );
        
        $arrayCheckbox = array(  //Array de asignaturas
            'DWES' => '',
            'DWEC' => '',
            'DAW' => '',
            'DIW' => ''
        );
        
        $arraySelect = array(   //Array para marca
            'Volvo' => '', 
            'Mercedes' => '', 
            'Peugeot' => '', 
            'Ford' => '' 
        ); 
        
        $erroesCampos = array( //Array para los errores en los campos
            'nombre' => "",
            'apellido' => "",
            'sexo' => "",
            'asignatura' => "",
            'fecha' => "",
            'marca' => "",
            'altura'=>"",
            'hermanos'=>""
        );
        $error = false; //Variable booleana para errores
        $arrayErrores = array(" ", "No ha introducido ningun valor<br />", "El valor introducido no es valido<br />", "Tamaño minimo no valido<br />", "Tamaño maximo no valido<br />"); //Declaramos el array de errores
        $valida=0;  //Variable para saber si hay errores o no

        
        
            
        //SI SE PULSA ENVIAR SE REALIZARÁ LA VALIDACION DE LOS DATOS Y SE ALMACENARAN LOS DATOS EN LAS VARIABLES
        if (isset($_POST['enviar'])) { 

            $valida= validarCadenaAlfabetica($_POST['nombre'],3,30);
            if ($valida!=0) {
                $erroesCampos['nombre'] = $arrayErrores[$valida];
                $error = true;
                $erroresColor['nombre'] = "error";
            }else{
                $cuestionario['nombre']=$_POST['nombre'];
            }
            
             $valida= validarCadenaAlfabetica($_POST['apellido'],3,30);
            if ($valida!=0) {
                $erroesCampos['apellido'] = $arrayErrores[$valida];
                $error = true;
                $erroresColor['apellido'] = "error";
            }else{
                $cuestionario['apellido']=$_POST['apellido'];
            }

            if (empty($_POST['sexo'])) {
                $erroesCampos['sexo'] = $arrayErrores[1];
                $error = true;
                $erroresColor['sexo'] = "error";
            } else {
                $cuestionario['sexo'] = $_POST['sexo'];
                $arrayRadiob[$cuestionario['seaxo']] = "checked";
            }

            if (empty($_POST['asignatura'])) {
                $erroesCampos['asignatura'] =$arrayErrores[1];
                $error = true;
                $erroresColor['asignatura'] = "error";
            } else {
                $cuestionario['asignatura'] = $_POST['asignatura'];
                foreach($cuestionario['asignatura'] as $valor){
                    $arrayCheckbox[$valor] = 'checked';
                }
              
            }
            
            if (empty($_POST['fechanac'])) {
                $erroesCampos['fechaNac'] = $arrayErrores[1];
                $error = true;
                $erroresColor['fechaNac'] = "error";
            }else{
                $cuestionario['fechaNac']=$_POST['fechanac'];
            }
            
            if (empty($_POST['marca'])) {
                $erroesCampos['marca'] = $arrayErrores[1];
                $error = true;
                 $erroresColor['marca'] = "error";
            } else {
                $cuestionario['marca'] = $_POST['marca'];
                $arraySelect[$cuestionario['marca']] = "selected";
                    
            }
            
            $valida= validarReal($_POST['altura'], 1, 5);
            if ($valida!=0) {
                $erroesCampos['altura'] = $arrayErrores[$valida];
                $error = true;
                 $erroresColor['altura'] = "error";
            }else{
                $cuestionario['altura']=$_POST['altura'];
            }
            
             $valida= validarReal($_POST['hermanos'], 1, 10);
            if ($valida!=0) {
                $erroesCampos['hermanos'] = $arrayErrores[$valida];
                $error = true;
                 $erroresColor['hermanos'] = "erraor";
            } else{
                $cuestionario['numero_hermanos']=$_POST['hermanos'];
            }
        }

            //SI NO SE PULSA ENVIAR O LOS DATOS NO SON CORRECTOS NOS MOSTRARA LOS ERRORES EN LOS CAMPOS Y ALMACENARA LOS DATOS CORRECTOS
        if (!isset($_POST['enviar']) || $error) { //SI NO SE PULSA ENVIAR O LOS DATOS NO SON CORRECTOS NOS MOSTRARA LOS ERRORES EN LOS CAMPOS Y ALMACENARA LOS DATOS CORRECTOS
            ?>

            <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method="post">

                <label for="nombre">Nombre:</label><br />
                <input type="text" name="nombre" value="<?php echo $cuestionario['nombre']; ?>" class="<?php echo $erroresColor['nombre']; ?>"></input><br /><br />
            <?PHP echo $erroesCampos['nombre']; ?>
                <label for="apellido">Apellido:</label><br />
                <input type="text" name="apellido" value="<?php echo $cuestionario['apellido']; ?>" class="<?php echo $erroresColor['apellido']; ?>"></input><br /><br />
            <?PHP echo $erroesCampos['apellido']; ?>
                <input type="radio" name="sexo" value="Hombre" <?PHP  echo $arrayRadiob['Hombre'] ?> class="<?php echo $erroresColor['sexo']; ?>">Hombre</input>
                <input type="radio" name="sexo" value="Mujer" <?PHP  echo $arrayRadiob['Mujer'] ?> class="<?php echo $erroresColor['sexo'];?>">Mujer</input><br /><br />
             <?PHP echo $erroesCampos['sexo']; ?>
                <input type="checkbox" name="asignatura[]" value="DWES" <?PHP echo $arrayCheckbox['DWES'] ?> class="<?php echo $erroresColor['asignatura'];?>">DWES</input>
                <input type="checkbox" name="asignatura[]" value="DWEC" <?PHP echo $arrayCheckbox['DWEC'] ?> class="<?php echo $erroresColor['asignatura'];?>">DWEC</input>
                <input type="checkbox" name="asignatura[]" value="DAW" <?PHP echo $arrayCheckbox['DAW'] ?> class="<?php echo $erroresColor['asignatura'];?>">DAW</input>
                <input type="checkbox" name="asignatura[]" value="DIW" <?PHP echo $arrayCheckbox['DIW'] ?> class="<?php echo $erroresColor['asignatura'];?>">DIW</input><br /><br />
                <?PHP echo $erroesCampos['asignatura']; ?>
                <label for="fechanac">Fecha Nacimeinto:</label><br />
                <input type="date" name="fechaNac" value="<?php echo $cuestionario['fechaNac']  ?>" class="<?php echo $erroresColor['fechaNac'];?>"></input><br /><br />
                <?PHP echo $erroesCampos['fechaNac']; ?><br /><br />
                <label for="marca">Marca:</label><br />     
                <select  name="marca" class="<?php echo $erroresColor['marca'];?>"> 
                     <option value="Volvo" <?php echo $arraySelect['Volvo'];?>>Volvo</option> 
                     <option value="Mercedes" <?php echo $arraySelect['Mercedes'];?>>Mercedes</option> 
                     <option value="Peugeot" <?php echo $arraySelect['Peugeot'];?>>Peugeot</option> 
                     <option value="Ford" <?php echo $arraySelect['Ford'];?>>Ford</option> 
                 </select> 
            <br /> 
             <?PHP echo $erroesCampos['marca']; ?><br /><br />
             
                <label for="altura">Altura:</label><br />
                <input type="text" name="altura" value="<?php echo $cuestionario['altura'];  ?>" class="<?php echo $erroresColor['altura'];?>"></input><br /><br />
                 <?PHP echo $erroesCampos['altura']; ?><br /><br />
                <label for="hermanos">Numero Hermanos:</label><br />
                <input type="text" name="hermanos" value="<?php echo $cuestionario['numero_hermanos']; ?>" class="<?php echo $erroresColor['hermanos'];?>"></input><br /><br />
                 <?PHP echo $erroesCampos['hermanoss']; ?><br /><br />
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
</html>