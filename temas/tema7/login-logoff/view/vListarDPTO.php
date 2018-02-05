<main>
     <form action="index.php?location=mantenimiento" id="formulario" method="post">
         <input class="btn btn-success" type="submit" name="crardtpo" value="Nuevo departamento">
         <input class="btn btn-info" type="submit" name="volverInicio" value="Volver">
    </form>
    <h4>Mantenimiento Departamentos-Lista departamentos</h4>
    <table class="table table-bordered table-hover">
        
        <tr class="danger">
            <th>Codigo</th>
            <th>Descripcion</th>
            <th>Volumen</th>
            <th>Modificaciones</th>
        </tr>
        <tr>
            <?php
                   
                  for ($i=0;$i<count($departamentos);$i++){ 
                    echo "<tr>"; 
                        echo "<td>". $departamentos[$i]->getCodDepartamento() ."</td>"; 
                        echo "<td>". $departamentos[$i]->getDescDepartamento() ."</td>"; 
                        echo "<td>". $departamentos[$i]->getvolumenNegocio() ."</td>";
                        echo '<td><a href="index.php?Departamento='.$departamentos[$i]->getCodDepartamento().'&Descripcion='.$departamentos[$i]->getDescDepartamento().'&Volumen='.$departamentos[$i]->getvolumenNegocio() .'&location=modificardpto"><i class="material-icons">create</i>
                        <a href="index.php?Departamento='.$departamentos[$i]->getCodDepartamento().'&location=borrardpto"><i class="material-icons">delete</i>'; 
                        
                    echo "</tr>";         
                    }      
            ?>
            
        </tr>
    </table>
    
   
    
</main>

