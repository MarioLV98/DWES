<?php
    
     echo "<h1>Bienvenido ",$_SESSION['usuario']->getcodUsuario(),"</h1><br>"; 
    print_r($_SESSION);
?>
<form action="index.php?location=inicio" method="post">
    <button type="submit" name="salir" value="salir">Salir</button>
</form>
