<main>
    
   <form action="index.php?location=inicio" method="post">
    <button class="btn btn-primary" type="submit" name="salir" value="salir">Cerrar sesion</button>
    <button class="btn btn-warning" type="submit" name="modificar" value="modificar">Editar usuario</button>
    <button class="btn btn-danger" type="submit" name="borrar" value="borrar">Borrar usuario</button>
    <button class="btn btn-default" type="submit" name="dpto" value="dpto">Mantenimiento departamentos</button>
    <button class="btn btn-default" type="submit" name="encuesta" value="encuesta">Encuesta</button>
    <button class="btn btn-default" type="submit" name="soap" value="soap">WS SOAP</button>
    <button class="btn btn-default" type="submit" name="reset" value="reset">WS RESET</button>
</form>
<?php
    
     echo "<h1>Bienvenido ",$_SESSION['usuario']->getcodUsuario(),"</h1><br>"; 
     echo "<h4>Tu contraseña cifrada:".$_SESSION['usuario']->getPassword()."</h4>";
      echo "<h4>Numero de accesos: ".$_SESSION['usuario']->getContadorAccesos()."</h4>";
      echo "<h4>Fecha ultima conexion: ".$_SESSION['usuario']->getUltimaConexion()."</h4>";
      echo "<h4>Descripcion: ".$_SESSION['usuario']->getDescUsuario()."</h4>";
      echo "<h4>Perfil: ".$_SESSION['usuario']->getPerfil()."</h4>";
?>
    

</main>