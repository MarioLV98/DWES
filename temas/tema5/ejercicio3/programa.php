<?php

session_start();

if(!empty($_SESSION['usuario'])){

if(isset($_POST['salir'])){
    session_destroy();
    header('Location:login.php');
}

if(isset($_POST['detalle'])){
    header('Location:detalle.php');
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


?>

<form id="formulario" name="salir" action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input type="submit" name="salir" value="Salir"/>
    <input type="submit" name="detalle" value="Detalle"/>
    
</form>
