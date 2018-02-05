<?php
if (isset($_POST['registrar'])) {
    $usuario = Usuario::comprobarYaExistente($_POST['usuario']);
    $contaseña = validarCadenaAlfanumerica($_POST['contrasena']);
    $descripcion = validarCadenaAlfabetica($_POST['descripcion']);
    $perfil = validarCadenaAlfabetica($_POST['perfil']);
}
?>
<main>
    <form action="index.php?location=registro" id="formulario" method="post">

        <div id="encuesta">
            <h4>Registrar nuevo usuario</h4>
            <label for="usuario">Usuario:</label><br />
            <div class="form-group <?php if (isset($_POST['registrar'])){if($usuario==""){echo "has-success";}else{echo "has-error";}} ?>">
                <input class="form-control" type="text" name="usuario" value="<?php if (isset($_POST['registrar'])) {
    echo $_POST['usuario'];
} ?>"><br />
            <p id="err"><?php if (isset($_POST['registrar'])) {
    echo $valida = Usuario::comprobarYaExistente($_POST['usuario']);
} ?></p>
            </div>

            <label for="contrasena">Contraseña:</label><br />
            <div class="form-group <?php if (isset($_POST['registrar'])){if($contaseña==""){echo "has-success";}else{echo "has-error";}}?>">
                <input class="form-control" type="password" name="contrasena" value="<?php if (isset($_POST['registrar'])) {
                    echo $_POST['contrasena'];
                } ?>"><br />
            <p id="err"><?php if (isset($_POST['registrar'])) {
                    echo $valida = validarCadenaAlfanumerica($_POST['contrasena']);
                } ?></p>
            </div>

            <label for="descripcion">Descripcion de usuario:</label><br />
            <div class="form-group <?php if (isset($_POST['registrar'])){if($descripcion==""){echo "has-success";}else{echo "has-error";}}?>">
            <input class="form-control" type="text" name="descripcion" value="<?php if (isset($_POST['registrar'])) {
                    echo $_POST['descripcion'];
                } ?>"><br />
            <p id="err"><?php if (isset($_POST['registrar'])) {
                    echo $valida = validarCadenaAlfabetica($_POST['descripcion']);
                } ?></p>
            </div>

            <label for="perfil">Perfil de usuario:</label><br />
            <div class="form-group <?php if (isset($_POST['registrar'])){if($perfil==""){echo "has-success";}else{echo "has-error";}}?>">
            <input class="form-control" type="text" name="perfil" value="<?php if (isset($_POST['registrar'])) {
                    echo $_POST['perfil'];
                } ?>"><br />
            <p id="err"><?php if (isset($_POST['registrar'])) {
                    echo $valida = validarCadenaAlfabetica($_POST['perfil']);
                } ?></p>
            </div>


            <input class="btn btn-primary" type="submit" name="registrar" value="Registrar"/>
            <input class="btn btn-warning" type="submit" name="cancelar" value="Cancelar"/>

        </div>      
    </form>
</main>    
