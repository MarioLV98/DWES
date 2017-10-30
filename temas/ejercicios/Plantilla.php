<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title></title>
    </head>
    <body>

       
        <?php
        
        include "LibreriaValidacionFormulariosjc.php";
        $nombre = ""; //Variable para el nombre
        $valida=0;  //Variable para saber si hay errores o no
        $arrayRadiob = array( //array para sexo
            'Hombre' => '',
            'Mujer' => ''
        );
        $sexo = ""; //Variable para sexo
        $asignatura = ""; //Variable para asignatura
        $arrayCheckbox = array(  //Array de asignaturas
            'DWES' => '',
            'DWEC' => '',
            'DAW' => '',
            'DIW' => ''
        );
        $fechaNac=""; //Variable para fecha de nacimiento
        $marca="";  //Variable para marca
        $altura=""; //Variable para altura
        $numero_hermanos="";    //Variable numero hermanos
        $arraySelect = array(   //Array para marca
            'Volvo' => '', 
            'Mercedes' => '', 
            'Peugeot' => '', 
            'Ford' => '' 
        ); 
        $error = false; //Variable booleana para errores
        $erroesCampos = array( //Array para los errores en los campos
            'Nombre' => "",
            'Sexo' => "",
            'Asignatura' => "",
            'Fecha' => "",
            'Marca' => "",
            'Altura'=>"",
            'Hermanos'=>""
        );

        
        $arrayErrores = array(" ", "No ha introducido ningun valor<br />", "El valor introducido no es valido<br />", "Tamaño minimo no valido<br />", "Tamaño maximo no valido<br />"); //Declaramos el array de errores

        if (isset($_POST['enviar'])) { //SI SE PULSA ENVIAR SE REALIZARÁ LA VALIDACION DE LOS DATOS

            $valida= validarCadenaAlfabetica($_POST['nombre'],3,30);
            if ($valida!=0) {
                $erroesCampos['Nombre'] = $arrayErrores[$valida];
                $error = true;
            }
            
            

            if (empty($_POST['sexo'])) {
                $erroesCampos['Sexo'] = $arrayErrores[1];
                $error = true;
            } else {
                $sexo = $_POST['sexo'];
                $arrayRadiob[$sexo] = "checked";
            }

            if (empty($_POST['asignatura'])) {
                $erroesCampos['Asignatura'] =$arrayErrores[1];
                $error = true;
            } else {
                $asignatura = $_POST['asignatura'];
                $arrayCheckbox[$asignatura] = "checked";
            }
            
            if (empty($_POST['fechanac'])) {
                $erroesCampos['Fecha'] = $arrayErrores[1];
                $error = true;
            }
            
            if (empty($_POST['marca'])) {
                $erroesCampos['Marca'] = $arrayErrores[1];
                $error = true;
            } else {
                $marca = $_POST['marca'];
                $arraySelect[$marca] = "selected";
            }
            
            $valida= validarReal($_POST['altura'], 1, 5);
            if ($valida!=0) {
                $erroesCampos['Altura'] = $arrayErrores[$valida];
                $error = true;
            }
            
             $valida= validarReal($_POST['hermanos'], 1, 10);
            if ($valida!=0) {
                $erroesCampos['Hermanos'] = $arrayErrores[$valida];
                $error = true;
            } 
        }


        if (!isset($_POST['enviar']) || $error) { //SI NO SE PULSA ENVIAR O LOS DATOS NO SON CORRECTOS NOS MOSTRARA LOS ERRORES EN LOS CAMPOS Y ALMACENARA LOS DATOS CORRECTOS
            ?>

            <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method="post">

                <label for="nombre">Campo de texto:</label><br />
                <input type="text" name="nombre" value="<?php if(isset($_POST['nombre'])){echo $_POST['nombre'];} ?>"></input><br /><br />
            <?PHP echo $erroesCampos['Nombre']; ?>
            
                <label for="sexo">RadioButtom:</label><br />
                <input type="radio" name="sexo" value="Hombre" <?PHP echo $arrayRadiob['Hombre'] ?>>Hombre</input>
                <input type="radio" name="sexo" value="Mujer" <?PHP echo $arrayRadiob['Mujer'] ?>>Mujer</input><br /><br />
             <?PHP echo $erroesCampos['Sexo']; ?>
                <label for="asignatura">Checkbox:</label><br />
                <input type="checkbox" name="asignatura" value="DWES" <?PHP echo $arrayCheckbox['DWES'] ?>>DWES</input>
                <input type="checkbox" name="asignatura" value="DWEC" <?PHP echo $arrayCheckbox['DWEC'] ?>>DWEC</input>
                <input type="checkbox" name="asignatura" value="DAW" <?PHP echo $arrayCheckbox['DAW'] ?>>DAW</input>
                <input type="checkbox" name="asignatura" value="DIW" <?PHP echo $arrayCheckbox['DIW'] ?>>DIW</input><br /><br />
                <?PHP echo $erroesCampos['Asignatura']; ?>
                <label for="fechanac">Fecha:</label><br />
                <input type="date" name="fechanac" value="<?php if(isset($_POST['fechanac'])){echo $_POST['fechanac'];} ?>"></input><br /><br />
                <?PHP echo $erroesCampos['Fecha']; ?><br /><br />
                <label for="marca">Select:</label><br />     
                <select  name="marca"> 
                     <option value="Volvo" <?php echo $arraySelect['Volvo'];?>>Volvo</option> 
                     <option value="Mercedes" <?php echo $arraySelect['Mercedes'];?>>Mercedes</option> 
                     <option value="Peugeot" <?php echo $arraySelect['Peugeot'];?>>Peugeot</option> 
                     <option value="Ford" <?php echo $arraySelect['Ford'];?>>Ford</option> 
                 </select> 
            <br /> 
             <?PHP echo $erroesCampos['Marca']; ?><br /><br />
             
                <label for="altura">Float:</label><br />
                <input type="text" name="altura" value="<?php if(isset($_POST['altura'])){echo $_POST['altura'];} ?>"></input><br /><br />
                 <?PHP echo $erroesCampos['Altura']; ?><br /><br />
                <label for="hermanos">Integer:</label><br />
                <input type="text" name="hermanos" value="<?php if(isset($_POST['hermanos'])){echo $_POST['hermanos'];} ?>"></input><br /><br />
                 <?PHP echo $erroesCampos['Hermanos']; ?><br /><br />
                <input type="submit" name="enviar" value="Enviar"></input>


            </form>


    <?php
} else { //SI TODO ES CORRECTO GUARDARÁ LOS DATOS EN LAS VARIABLES Y MOSTRARÁ LOS DATOS.
    
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fechaNac = $_POST['fechanac'];
    $altura = $_POST['altura'];
    $numero_hermanos = $_POST['hermanos'];

    echo "Nombre:$nombre<br />";
    echo "Apellido:$apellido<br />";
    echo "Sexo: $sexo<br />";
    foreach ($arrayCheckbox as $clave => $valor){
        if(is_array($valor)){
            
            foreach ($valor as $campo){
                
                 echo "Asingaturas :$campo";
                
            }
        }else {
                        echo $clave . ":" . $valor . "<br />";
                    }
       
    }
   
    echo "Fecha nacimiento $fechaNac<br />";
    echo "Altura $altura<br />";
    echo "Numero hermanos $numero_hermanos<br />";
}
?>



    </body>
</html>