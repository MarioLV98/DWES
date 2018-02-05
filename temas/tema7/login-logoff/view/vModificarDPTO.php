<main>
<form action="index.php?Departamento=<?php echo $_GET['Departamento'] ?>&Descripcion=<?php $_GET['Descripcion'] ?>&Volumen=<?php $_GET['Volumen'] ?>&location=modificardpto" id="formulario" method="post">
            <?php
                if(isset($_POST['dptomod'])){
                    $desc=validarCadenaAlfanumerica($_POST['descDptomod']);
                    $vol=validarEntero($_POST['volumenNegociomod'],0,1000000000000);
                }
            ?>
                <div id="encuesta">
                  
                    <h4>Editar departamento</h4>
                    
                    <label for="codDptomod">Codigo de departamento: </label><br />
                    <div class="form-group has-success">
                        <input class="form-control" type="text" name="codDptomod" value="<?php echo $_GET['Departamento'] ?>" readonly><br />
                    </div>
                  
                    <label for="descDptomod">Descripcion de departamento: </label><br />
                    <div class="form-group  <?php if(isset($_POST['dptomod'])){if($desc==""){echo "has-success";}else{echo "has-error";}} ?>">
                    <input class="form-control" type="text" name="descDptomod" value="<?php if(isset($_POST['dptomod'])){ echo $_POST['descDptomod'];}else{ echo $_GET['Descripcion'];} ?>"><br />
                    <p id="err"><?php
                    if(isset($_POST['dptomod'])){echo $valida = validarCadenaAlfanumerica($_POST['descDptomod']);} ?></p>
                    </div>
                    
                    <label for="volumenNegociomod">Volumen de negocio:</label><br />
                    <div class="form-group  <?php if(isset($_POST['dptomod'])){if($vol==""){echo "has-success";}else{echo "has-error";}} ?>">
                        <input class="form-control" type="text" name="volumenNegociomod" value="<?php if(isset($_POST['dptomod'])){ echo $_POST['volumenNegociomod'];}else{ echo $_GET['Volumen'];} ?>"><br />
                    <p id="err"><?php
                    if(isset($_POST['dptomod'])){echo $valida = validarEntero($_POST['volumenNegociomod'],0,1000000000000);} ?></p>
                    </div>
                    

                 
                    
                    <input class="btn btn-primary" type="submit" name="dptomod" value="Modificar departamento"/>
                    <input class="btn btn-warning" type="submit" name="volverlista2" value="Cancelar"/>

                </div>      
</form>
</main>
