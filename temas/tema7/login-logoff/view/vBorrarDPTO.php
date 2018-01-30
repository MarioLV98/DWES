<main>
<form action="index.php?Departamento=<?php echo $_GET['Departamento'] ?>&location=borrardpto" id="formulario" method="post">

                <div id="encuesta">
                  
                  
                    <label for="codDptomod">Codigo de departamento: </label><br />
                    <input type="text" name="codDptoborr" value="<?php echo $_GET['Departamento'] ?>" readonly><br />
                  
                    <p>Desea borrar el departamento?</p>
             
                    <input type="submit" name="dptoborr" value="Borrar departamento"/>
                    <input type="submit" name="volverlista3" value="Cancelar"/>

                </div>      
</form>
</main>
