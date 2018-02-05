<main>
<form action="index.php?Departamento=<?php echo $_GET['Departamento'] ?>&location=borrardpto" id="formulario" method="post">

                <div id="encuesta">
                  <h4>Borrar departamento</h4>
                  
                    <label for="codDptomod">Codigo de departamento: </label><br />
                    <div class="form-group has-success">
                        <input class="form-control" type="text" name="codDptoborr" value="<?php echo $_GET['Departamento'] ?>" readonly><br />
                    </div>
                    <p>Desea borrar el departamento?</p>
             
                    <input class="btn btn-danger" type="submit" name="dptoborr" value="Borrar departamento"/>
                    <input class="btn btn-warning" type="submit" name="volverlista3" value="Cancelar"/>

                </div>      
</form>
</main>
