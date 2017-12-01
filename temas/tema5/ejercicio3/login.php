<html>
    <head>
        <meta charset="UTF-8">
        <title>Encuesta</title>
        <link rel="stylesheet" type="text/css" href="estilos.css">
    </head>
    <body>
        <?php
        //Autor: Mario Labra Villar
        //Ultima modificación: 1/12/2017 
        include '../configuracion.php';
        include "LibreriaValidacionFormulariosjc.php";

        define("MIN", 5);       //Constante que indica minimo de valores de campo de texto
        define("MAX", 30);      //Constante que indica maximo de valores de campo de texto
        define("DIMENSION", 3); //Tamaño array
        $error = false;
        $arrayErrores = array(" ", "No ha introducido ningun valor<br />", "El valor introducido no es valido<br />", "Tamaño minimo no valido<br />", "Tamaño maximo no valido<br />", "El registro ya existe<br />","El usuario no existe<br />"); //array en el que se almacenan los diferentes tipos de errores que puede dar dependiendo del valor que devuelva la libreria al validar
        $valida = 0;

        try {
            $conexion = new PDO($datosConexion, $usuario, $contraseña);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $PdoE) {
            //Capturamos la excepcion en caso de que se produzca un error,mostramos el mensaje de error y deshacemos la conexion
            echo($PdoE->getMessage());
            unset($conexion);
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
            header('Location:../indextema5.html');
        }

        if (filter_has_var(INPUT_POST, 'enviar')) { //SI SE PULSA EL BOTON DE ENVIAR SE REALIZARAN LAS VALIDACIONES
            $valida = validarCadenaAlfanumerica($_POST['usuario'], 1, 50);
            $usu = $conexion->query("select usuario from Usuarios where usuario=\"" . $_POST['usuario'] . "\""); 
            $res = $usu->fetchColumn(0); 


            if ($res) { 
                $erroresCampos['usuario'] = $arrayErrores[6]; 
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

            <form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" id="formulario1" method="post">

                <div id="encuesta">
                    <h4>Encuesta</h4>
                    <label for="usuario">Usuario:</label><br />
                    <input type="text" name="usuario" value="<?PHP echo $cuestionario['usuario']; ?>"><br />
                    <p id="err"><?PHP echo $erroresCampos['usuario']; ?></p>

                    <label for="contrasena">Contraseña:</label><br />
                    <input type="password" name="contrasena" value="<?PHP echo $cuestionario['contrasena']; ?>"><br />
                    <p id="err"><?PHP echo $erroresCampos['contrasena']; ?></p>
                    
                    <input type="submit" name="enviar" value="Enviar"/>
                    <input type="submit" name="cancelar" value="Cancelar"/>

                    
            </form>

    <?php
    //EN EL CASO EN EL QUE TODO HAYA IDO BIEN PROCESAMOS EL FORUMULARIO Y MOSTRAMOS LOS DATOS POR PANTALLA
} else {

    $consulta = "select * from Usuarios where usuario=:user and contrasena=:pw";
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
                  header("Location: programa.php");
                }
        
    } catch (PDOException $PdoE) {
        echo $PdoE->getMessage() . "<br>";
        echo "<p>Inserccion erronea<p>";
        echo "<a href='index.php'><button>Volver</button></a>";
        echo $passwd;
    }
    unset($conexion);
}
?>
        <footer>
          
        </footer>
    </body>
</html>
