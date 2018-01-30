<main>
<?php
    
     echo "<h1>Bienvenido ",$_SESSION['usuario']->getcodUsuario(),"</h1><br>"; 
     echo "<h4>Tu contraseña cifrada:".$_SESSION['usuario']->getPassword()."</h4>"
?>
    
<form action="index.php?location=inicio" method="post">
    <button type="submit" name="salir" value="salir">Salir</button>
    <button type="submit" name="modificar" value="modificar">Modificar</button>
    <button type="submit" name="borrar" value="borrar">Borrar</button>
</form>
</main>