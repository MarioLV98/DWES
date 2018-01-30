<?php include 'model/validacion.php'; ?>
<main>
<form action="index.php?location=login" id="formulario" method="post">

                <div id="encuesta">
                    
                    <label for="usuario">Usuario:</label><br />
                    <input type="text" name="usuario" value=""><br />
                    <p id="err"><?php if(isset($_POST['enviar'])){echo $valida = Validacion::comprobarUsuario($_POST['usuario']);} ?></p>

                    <label for="contrasena">Contraseña:</label><br />
                    <input type="password" name="contrasena" value=""><br />
                    <p id="err"><?php
                    if(isset($_POST['enviar'])){echo $valida = Validacion::comprobarPassword($_POST['usuario'],$_POST['contrasena']);}?></p>
                    <?php 
                        if($errores['errorPassword']);
                        echo $errores['errorPassword'];
                    ?>
                    
                    <input type="submit" name="enviar" value="Iniciar sesion"/>
                    
                    <p>No tienes cuenta? <input type="submit" name="registro" value="Registrate"/></p>
                   

                </div> 
    </form>

    <div id="imagenes">
        <img src="webroot/almacenamiento.PNG">
        <img src="webroot/arbolnavegacion.PNG">
        <img src="webroot/diagramadeclases.PNG"> 
    </div>
</main>
