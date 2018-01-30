
<main>
<form action="index.php?location=registro" id="formulario" method="post">

                <div id="encuesta">
                    
                    <label for="usuario">Usuario:</label><br />
                    <input type="text" name="usuario" value=""><br />
                    <p id="err"><?php
                    if(isset($_POST['registrar'])){echo $valida = Validacion::comprobarYaExistente($_POST['usuario']);} ?></p>

                    <label for="contrasena">Contraseña:</label><br />
                    <input type="password" name="contrasena" value=""><br />
                    <p id="err"><?php
                    if(isset($_POST['registrar'])){echo $valida = Validacion::validarCadenaAlfanumerica($_POST['contrasena']);} ?></p>
                 
                    
                    <input type="submit" name="registrar" value="Registrar"/>
                    <input type="submit" name="cancelar" value="Cancelar"/>

                </div>      
</form>
</main>    
