
<main>
<form action="index.php?location=borrar" id="formulario" method="post">

                <div id="encuesta">
                    
                    <label for="usuario">Usuario:</label><br />
                    <input type="text" name="usuarioborrar" value="<?php echo $_SESSION['usuario']->getCodUsuario(); ?>" readonly><br />
                    <p id="err"></p>

                    
                 
                    <p>¿Desea Borrar?</p>
                    <input type="submit" name="borra" value="Borrar"/>
                    <input type="submit" name="cancelar" value="Cancelar"/>

                </div>      
</form>
</main>    
