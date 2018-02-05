<main>
<form action="index.php?location=creardpto" id="formulario" method="post">
    
    <?php if(isset($_POST['registrardpto'])){
        $dep=Departamento::comprobarYaExsistenteDep($_POST['codDpto']);
        $desc=validarCadenaAlfanumerica($_POST['descDpto']);
        $vol=validarEntero($_POST['volumenNegocio'],0,100000000000000000);
    } ?>

                <div id="encuesta">
                    <h4>Nuevo departamento</h4>
                    <label for="codDpto">Codigo de departamento: </label><br />
                    <div class="form-group <?php if(isset($_POST['registrardpto'])){if($dep==""){echo "has-success";}else{echo "has-error";}} ?>">
                    <input class="form-control" type="text" name="codDpto" value="<?php if(isset($_POST['registrardpto'])){echo $_POST['codDpto']; }?>"><br />
                    <p id="err"><?php
                    if(isset($_POST['registrardpto'])){echo $valida = Departamento::comprobarYaExsistenteDep($_POST['codDpto']);} ?></p>
                    </div>

                    <label for="descDpto">Descripcion de departamento: </label><br />
                    <div class="form-group <?php if(isset($_POST['registrardpto'])){if($desc==""){echo "has-success";}else{echo "has-error";}} ?>">
                    <input class="form-control" type="text" name="descDpto" value="<?php if(isset($_POST['registrardpto'])){echo $_POST['descDpto']; }?>"><br />
                    <p id="err"><?php
                    if(isset($_POST['registrardpto'])){echo $valida = validarCadenaAlfanumerica($_POST['descDpto']);} ?></p>
                    </div>
                    
                    <label for="volumenNegocio">Volumen de negocio:</label><br />
                    <div class="form-group <?php if(isset($_POST['registrardpto'])){if($vol==""){echo "has-success";}else{echo "has-error";}} ?>"> 
                    <input class="form-control" type="text" name="volumenNegocio" value="<?php if(isset($_POST['registrardpto'])){echo $_POST['volumenNegocio']; }?>"><br />
                    <p id="err"><?php
                    if(isset($_POST['registrardpto'])){echo $valida = validarEntero($_POST['volumenNegocio'],0,100000000000000000);} ?></p>
                    </div>
                    

                 
                    
                    <input class="btn btn-primary" type="submit" name="registrardpto" value="Registrar nuevo departamento"/>
                    <input class="btn btn-warning" type="submit" name="volverlista" value="Cancelar"/>

                </div>      
</form>
</main>
