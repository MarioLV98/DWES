<main>
<form action="index.php?location=creardpto" id="formulario" method="post">

                <div id="encuesta">
                    
                    <label for="codDpto">Codigo de departamento: </label><br />
                    <input type="text" name="codDpto" value=""><br />
                    <p id="err"><?php
                    if(isset($_POST['registrardpto'])){echo $valida = Validacion::comprobarYaExistenteDep($_POST['codDpto']);} ?></p>

                    <label for="descDpto">Descripcion de departamento: </label><br />
                    <input type="text" name="descDpto" value=""><br />
                    <p id="err"><?php
                    if(isset($_POST['registrardpto'])){echo $valida = Validacion::validarCadenaAlfanumerica($_POST['descDpto']);} ?></p>
                    
                    <label for="volumenNegocio">Volumen de negocio:</label><br />
                    <input type="text" name="volumenNegocio" value=""><br />
                    <p id="err"><?php
                    if(isset($_POST['registrardpto'])){echo $valida = Validacion::validarEntero($_POST['volumenNegocio'],0,100);} ?></p>
                    

                 
                    
                    <input type="submit" name="registrardpto" value="Registrar nuevo departamento"/>
                    <input type="submit" name="volverlista" value="Cancelar"/>

                </div>      
</form>
</main>
