
<main>
<form action="index.php?location=registro" id="formulario" method="post">

                <div id="encuesta">
                    
                    <label for="usuario">Usuario:</label><br />
                    <input type="text" name="usuario" value="<?php if(isset($_POST['registrar'])){echo $_POST['usuario'];} ?>"><br />
                    <p id="err"><?php
                    if(isset($_POST['registrar'])){echo $valida = Validacion::comprobarYaExistente($_POST['usuario']);} ?></p>

                    <label for="contrasena">Contraseña:</label><br />
                    <input type="password" name="contrasena" value="<?php if(isset($_POST['registrar'])){echo $_POST['contrasena'];} ?>"><br />
                    <p id="err"><?php
                    if(isset($_POST['registrar'])){echo $valida = Validacion::validarCadenaAlfanumerica($_POST['contrasena']);} ?></p>
                    
                    <label for="descripcion">Descripcion de usuario:</label><br />
                    <input type="text" name="descripcion" value="<?php if(isset($_POST['registrar'])){echo $_POST['descripcion'];} ?>"><br />
                    <p id="err"><?php
                    if(isset($_POST['registrar'])){echo $valida = Validacion::validarCadenaAlfabetica($_POST['descripcion']);} ?></p>
                    
                    <label for="perfil">Perfil de usuario:</label><br />
                    <input type="text" name="perfil" value="<?php if(isset($_POST['registrar'])){echo $_POST['perfil'];} ?>"><br />
                    <p id="err"><?php
                    if(isset($_POST['registrar'])){echo $valida = Validacion::validarCadenaAlfabetica($_POST['perfil']);} ?></p>
                 
                    
                    <input type="submit" name="registrar" value="Registrar"/>
                    <input type="submit" name="cancelar" value="Cancelar"/>

                </div>      
</form>
</main>    
