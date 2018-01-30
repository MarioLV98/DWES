<main>
<form action="index.php?Departamento=<?php echo $_GET['Departamento'] ?>&location=modificardpto" id="formulario" method="post">

                <div id="encuesta">
                  
                  
                    <label for="codDptomod">Codigo de departamento: </label><br />
                    <input type="text" name="codDptomod" value="<?php echo $_GET['Departamento'] ?>" readonly><br />
                  
                  
                    <label for="descDptomod">Descripcion de departamento: </label><br />
                    <input type="text" name="descDptomod" value=""><br />
                    <p id="err"><?php
                    if(isset($_POST['dptomod'])){echo $valida = Validacion::validarCadenaAlfanumerica($_POST['descDptomod']);} ?></p>
                    
                    <label for="volumenNegociomod">Volumen de negocio:</label><br />
                    <input type="text" name="volumenNegociomod" value=""><br />
                    <p id="err"><?php
                    if(isset($_POST['dptomod'])){echo $valida = Validacion::validarEntero($_POST['volumenNegociomod'],0,100);} ?></p>
                    

                 
                    
                    <input type="submit" name="dptomod" value="Registrar nuevo departamento"/>
                    <input type="submit" name="volverlista2" value="Cancelar"/>

                </div>      
</form>
</main>
