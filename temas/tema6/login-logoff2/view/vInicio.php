<?php
    echo "Bienvenido ".$_SESSION['usuario'];
?>
<form action="index.php?location=inicio" method="post">
    <button type="submit" name="salir" value="salir">Salir</button>
</form>
