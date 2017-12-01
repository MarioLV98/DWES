<?php



echo "<h1>SERVER</h1><br>";
foreach ($_SERVER as $clave=>$valor){
    
   echo $clave.":".$valor."</br>"; 
    
}

echo "<h1>COOCKIE</h1><br>";
foreach ($_COOKIE as $claveK=>$valoK){
    
   echo $claveK.":".$valorK."</br>"; 
    
}

echo "<h1>SESSION</h1><br>";
foreach ($_SESSION as $claveS=>$valorS){
    
   echo $claveS.":".$valorS."</br>"; 
    
}


echo phpinfo();
