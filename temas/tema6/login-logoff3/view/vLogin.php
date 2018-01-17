
<form action="index.php?location=login" id="formulario" method="post">

                <div id="encuesta">
                    
                    <label for="usuario">Usuario:</label><br />
                    <input type="text" name="usuario" value=""><br />
                    <p id="err"></p>

                    <label for="contrasena">Contraseña:</label><br />
                    <input type="password" name="contrasena" value=""><br />
                    <p id="err"></p>
                    <?php 
                        if($errores['errorPassword']);
                        echo $errores['errorPassword'];
                    ?>
                    
                    <input type="submit" name="enviar" value="Iniciar sesion"/>
                    <input type="submit" name="cancelar" value="Cancelar"/>

                </div>      
</form>
