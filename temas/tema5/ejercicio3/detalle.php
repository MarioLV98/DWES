<?php

session_start();

if(!empty($_SESSION['usuario'])){
    

if(isset($_POST['salir'])){
    session_destroy();
    header('Location:login.php');
}

echo "<h1>SERVER</h1><br>";
foreach ($_SERVER as $clave=>$valor){
    
   echo $clave.":".$valor."</br>"; 
    
}

echo "<h1>COOCKIE</h1><br>";
foreach ($_COOKIE as $claveK=>$valorK){
    
   echo $claveK.":".$valorK."</br>"; 
    
}

echo "<h1>SESSION</h1><br>";
foreach ($_SESSION as $claveS=>$valorS){
    
   echo $claveS.":".$valorS."</br>"; 
    
}

}else{
    header('Location:login.php');
}


echo "<button><a href='programa.php'>Volver</a></button>"

?>

