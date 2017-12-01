<?php

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic Realm="Hola que tal"');
    header('HTTP/1.0 401 Unauthorized');
    echo "Has pulsado cancelar";
    exit;
} else {
    
    include 'configuracion.php';
        $user=$_SERVER['PHP_AUTH_USER'];
        $pw=hash('sha256',$_SERVER['PHP_AUTH_PW']); 
        $correcto=false;
        try{
            $conexion= new PDO($datosConexion,$usuario,$contraseña);
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql ="select * from Usuarios where usuario=:user and contrasena=:contrasena";
            $consulta=$conexion->prepare($sql);
            $consulta->bindParam(':user',$user);
            $consulta->bindParam(':contrasena',$pw);
            $consulta->execute();
                if($consulta->rowCount()!=0){
                    $correcto=true;
                }
        }catch(PDOException $pdoe){
            echo $pdoe->getMessage();
            header('WWW-Authenticate: Basic Realm="Hola que tal"');
            header('HTTP/1.0 401 Unauthorized');
            echo "Has pulsado cancelar";
        }
        
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="estilos.css">
        <title>8pdo</title>
    </head>
    <body>
<?php

        
        if($correcto){
        echo "<strong>Tu usuario es " . $_SERVER['PHP_AUTH_USER'] . "</strong><br>";
        session_start();
        setcookie("fecha",date("j, n, Y, g:i a"),time()+3600);
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

    if(!empty($_COOKIE["fecha"])){
        
        echo "La ultima conexion fue: ".$_COOKIE["fecha"];
    }
        
        
        session_destroy();
    }
}
?>
 </body>
</html>


