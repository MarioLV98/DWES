
        <?php
        //Autor: Mario Labra Villar
        //Ultima modificación: 1/12/2017 
        include '../configuracion.php';
        include "LibreriaValidacionFormulariosjc.php";
        $error = false;
        $arrayErrores = array(" ", "No ha introducido ningun valor<br />", "El valor introducido no es valido<br />", "Tamaño minimo no valido<br />", "Tamaño maximo no valido<br />", "El registro ya existe<br />","El usuario no existe<br />","Contraseña incorrecta<br />","El usuario ya existe<br />"); //array en el que se almacenan los diferentes tipos de errores que puede dar dependiendo del valor que devuelva la libreria al validar
        $valida = 0;
        $correcto=false;
        try {
            $conexion = new PDO($datosConexion, $usuario, $contraseña);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $PdoE) {
            //Capturamos la excepcion en caso de que se produzca un error,mostramos el mensaje de error y deshacemos la conexion
            echo($PdoE->getMessage());
        }
        $cuestionario = array(//En este array se almacenarán los datos
            'usuario' => '',
            'contrasena' => ''
        );
        $erroresCampos = array(//En este array se almacenan los posibles errores que puedan tener cada uno de los campos
             'usuario' => '',
            'contrasena' => ''
        );
        if (isset($_POST['cancelar'])) {
            header('Location:login.php');
        }
        if (filter_has_var(INPUT_POST, 'enviar')) { //SI SE PULSA EL BOTON DE ENVIAR SE REALIZARAN LAS VALIDACIONES
            $valida = validarCadenaAlfanumerica($_POST['usuario'], 1, 50);
            try{
            $usu = $conexion->query("select usuario from Usuarios where usuario=\"" . $_POST['usuario'] . "\""); 
            $res = $usu->fetchColumn(0);
            }catch(PDOException $pdoe){
                 echo $PdoE->getMessage() . "<br>";
                 echo "<p>Error<p>";
            }
            $res2 ="";
            
            if ($res) { 
                $erroresCampos['usuario'] = $arrayErrores[8]; 
                $error = true; 
            }
            
            if ($valida != 0) {
                $erroresCampos['usuario'] = $arrayErrores[$valida];
                $error = true;
            } else {
                $cuestionario['usuario'] = $_POST['usuario'];
            }
            $valida = validarCadenaAlfanumerica($_POST['contrasena'], 1, 20);
            if ($valida != 0) {
                $erroresCampos['contrasena'] = $arrayErrores[$valida];
                $error = true;
            } else {
                $cuestionario['contrasena'] = $_POST['contrasena'];
            }
           
        }
        if (!filter_has_var(INPUT_POST, 'enviar') || $error) {
            ?>

           
    <?php
    //EN EL CASO EN EL QUE TODO HAYA IDO BIEN PASAMOS LOS PARAMETROS AL QUERY E INSERTAMOS LOS DATOS
} else {
    $consulta = "insert into Usuarios (usuario,contrasena) values (:user,:pw))";
    //Preparamos la sentencia
    $sentencia = $conexion->prepare($consulta);

    $passwd= hash('sha256', $cuestionario['contrasena']);
    //Inyectamos los parametros del insert en el query
    $sentencia->bindParam(":user", $cuestionario['usuario']);
    $sentencia->bindParam(":pw", $passwd);
    
    //Ejecutamos la consulta
    try {
        $sentencia->execute();
               if($sentencia->rowCount()!=0){
                  $correcto=true;
                }
        
    } catch (PDOException $PdoE) {
        echo $PdoE->getMessage() . "<br>";
        echo "<p>Inserccion erronea<p>";
        echo "<a href='index.php'><button>Volver</button></a>";
       
    }
    unset($conexion);
    
    if($correcto){
        
        session_start();
        $_SESSION['usuario']=$cuestionario['usuario'];
        header('Location:indexencuesta.php');
    }
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="estilos/estilos.css">
    </head>
    <body>
        
         <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" id="formulario1" method="post">

                <div id="encuesta">
                    <h4>Login</h4>
                    <label for="usuario">Usuario:</label><br />
                    <input type="text" name="usuario" value="<?PHP echo $cuestionario['usuario']; ?>"><br />
                    <p id="err"><?PHP echo $erroresCampos['usuario']; ?></p>

                    <label for="contrasena">Contraseña:</label><br />
                    <input type="password" name="contrasena" value="<?PHP echo $cuestionario['contrasena']; ?>"><br />
                    <p id="err"><?PHP echo $erroresCampos['contrasena']; ?></p>
                    
                    <input type="submit" name="enviar" value="Registro"/>
                    <input type="submit" name="cancelar" value="Cancelar"/>

                    
            </form>

        
        <footer>
          
        </footer>
    </body>
</html>