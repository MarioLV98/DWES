
<?php

if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER']!= 'mario' || $_SERVER['PHP_AUTH_PW']!= 'paso') {
    header('WWW-Authenticate: Basic Realm="Hola que tal"');
    header('HTTP/1.0 401 Unauthorized');
    echo "Has pulsado cancelar";
} else {
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="estilos.css">
        <title>8pdo</title>
    </head>
    <body>
<?php
   
        echo "<strong>Tu usuario es " . $_SERVER['PHP_AUTH_USER'] . "</strong><br>";
        //Iniciamos o reanudamos la sesion
        session_start();
       //guardamos el usuario en $sesion
        $_SESSION['user']=$_SERVER['PHP_AUTH_USER'];
        echo "<h1>SERVER</h1><br>";
        
        
        if(!empty($_SERVER)){
        foreach ($_SERVER as $clave => $valor) {

            echo $clave . ":" . $valor . "</br>";
        }
        }else{
            echo "SERVER esta vacio";
        }

        echo "<h1>COOCKIE</h1><br>";
        if(!empty($_COOKIE)){
        foreach ($_COOKIE as $claveK => $valorK) {

            echo $claveK . ":" . $valorK . "</br>";
        }
        
        }else{
            echo "COOKIE esta vacio";
        }

        echo "<h1>SESSION</h1><br>";
        if(!empty($_SESSION)){
        foreach ($_SESSION as $claveS => $valorS) {

            echo $claveS . ":" . $valorS . "</br>";
        } 
        
        }else{
            echo "Session esta vacio";
        }

         setcookie("fecha",date("j, n, Y, g:i a"),time()+3600);
    if(!empty($_COOKIE["fecha"])){
        
        echo "La ultima conexion fue: ".$_COOKIE["fecha"];
    }
        
        
        session_destroy();
    }
?>
 </body>
</html>


