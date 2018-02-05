
<main>
<form action="index.php?location=modificar" id="formulario" method="post">
    
      <?php
                    if(isset($_POST['modifica'])){
                    $pass = validarCadenaAlfanumerica($_POST['contrasenaregistro']);
                    $desc = validarCadenaAlfabetica($_POST['descripcionmod']);
                    $perf =  validarCadenaAlfabetica($_POST['perfilmod']);
                    }
                ?>

                <div id="encuesta">
                    <h4>Editar usuario</h4>
                    <label for="usuario">Usuario:</label><br />
                    <div class="form-group has-success">
                        <input class="form-control" type="text" name="usuario" value="<?php echo $_SESSION['usuario']->getCodUsuario(); ?>" readonly><br />
                    <p id="err"></p>
                    </div>

                    <label for="contrasena">Contraseña(Se debe cambiar obligatoriamente):</label><br />
                    <div class="form-group <?php if (isset($_POST['modifica'])){if($pass==""){echo "has-success";}else{echo "has-error";}} ?>">
                    <input class="form-control" type="password" name="contrasenaregistro" value="<?php if(isset($_POST['modifica'])){ echo $_POST['contrasenaregistro'];}?>"><br />
                    <p id="err"><?php
                    if(isset($_POST['modifica'])){echo $valida =validarCadenaAlfanumerica($_POST['contrasenaregistro']);} ?></p>
                    </div>
                     <label for="descripcion">Descripcion de usuario:</label><br />
                     <div class="form-group <?php if (isset($_POST['modifica'])){if($desc==""){echo "has-success";}else{echo "has-error";}} ?>">
                    <input class="form-control" type="text" name="descripcionmod" value="<?php if(isset($_POST['modifica'])){ echo $_POST['descripcionmod']; }else{ echo $_SESSION['usuario']->getDescUsuario();} ?>"><br />
                    <p id="err"><?php
                    if(isset($_POST['modifica'])){echo $valida = validarCadenaAlfabetica($_POST['descripcionmod']);} ?></p>
                    </div>
                    
                    <label for="perfil">Perfil de usuario:</label><br />
                    <div class="form-group <?php if (isset($_POST['modifica'])){if($perf==""){echo "has-success";}else{echo "has-error";}} ?>">
                    <input class="form-control" type="text" name="perfilmod" value="<?php if(isset($_POST['modifica'])){ echo $_POST['perfilmod']; }else{ echo $_SESSION['usuario']->getPerfil();}?>"><br />
                    <p id="err"><?php
                    if(isset($_POST['modifica'])){echo $valida = validarCadenaAlfabetica($_POST['perfilmod']);} ?></p>
                    </div>
                 
                    <p>¿Desea modificar?</p>
                    <input class="btn btn-primary" type="submit" name="modifica" value="Modificar"/>
                    <input class="btn btn-warning" type="submit" name="cancelar" value="Cancelar"/>
                    
                </div>      
</form>
</main>    
