
<main>
<form action="index.php?location=modificar" id="formulario" method="post">

                <div id="encuesta">
                    
                    <label for="usuario">Usuario:</label><br />
                    <input type="text" name="usuario" value="<?php echo $_SESSION['usuario']->getCodUsuario(); ?>" readonly><br />
                    <p id="err"></p>

                    <label for="contrasena">Contraseña:</label><br />
                    <input type="password" name="contrasenaregistro" value=""><br />
                    <p id="err"><?php
                    if(isset($_POST['modifica'])){echo $valida = Validacion::validarCadenaAlfanumerica($_POST['contrasenaregistro']);} ?></p>
                 
                    <p>¿Desea modificar?</p>
                    <input type="submit" name="modifica" value="Modificar"/>
                    <input type="submit" name="cancelar" value="Cancelar"/>

                </div>      
</form>
</main>    
