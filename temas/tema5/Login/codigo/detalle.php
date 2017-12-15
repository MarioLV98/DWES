<?php
//Reanudamos la sesion
session_start();
//Si no hay usuario nos redirige al login
if(!empty($_SESSION['usuario'])){
    

if(isset($_POST['salir'])){
    session_destroy();
    header('Location:login.php');
}

echo "<h1>Bienvenido ".$_SESSION['usuario']."</h1>";
echo "<h1>SERVER</h1><br>";
//Mostramos $_SERVER[]
foreach ($_SERVER as $clave=>$valor){
    
   echo $clave.":".$valor."</br>"; 
    
}

echo "<h1>COOCKIE</h1><br>";
//Mostramos $_COOKIE[]
foreach ($_COOKIE as $claveK=>$valorK){
    
   echo $claveK.":".$valorK."</br>"; 
    
}

echo "<h1>SESSION</h1><br>";
//Mostramos $_SESSION[]
foreach ($_SESSION as $claveS=>$valorS){
    
   echo $claveS.":".$valorS."</br>"; 
    
}
//Si la fecha de ultima conexion esta vacia nos dice que no hay, si contiene un valor la muestra
if(empty($_COOKIE['fecha_ultima_conexion'])){
    
    echo "No hay fecha definida";
}else{
    
    echo "La ultima conexion fue".$_COOKIE['fecha_ultima_conexion'];
}

}else{
    header('Location:login.php');
}

 //Si se pulsa volver nos lleva programa.php
echo "<button><a href='programa.php'>Volver</a></button>"

?>

