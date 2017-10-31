<html> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
        <link rel="stylesheet" type="text/css" href="../estilosEjer.css"> 
    </head> 
    <body> 
        <
        
            <?php 
                $ip="192.168.20.19"; 
                $usuario="DAW206"; 
                $contraseña="paso"; 
                $bd="DAW206_DBdepartamentos"; 
                 
                $mysqli = new mysqli($ip, $usuario, $contraseña, $bd); 
                if ($mysqli->connect_errno) { 
                echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; 
                } 
                echo $mysqli->host_info . "<br>"; 
            ?> 
            
    </body> 
</html>