<main>
    <form action="index.php?location=wssoap" method="post">
        <label for="unidad">Unidad</label>
        <input type="number" name="unidad">
        <br>
         <label for="fromUnit">Unidad origen</label>
        <select name="fromUnit">
            <option value="Bit">Bit</option>
            <option value="Byte">Byte</option>
            <option value="Kilobyte">Kilobyte</option>
            <option value="Megabyte">Megabyte</option>
            <option value="Gigabyte">Gigabyte</option>
            <option value="Terabyte">Terabyte</option>
            <option value="Petabyte">Petabyte</option>
        </select>
         <br>
        <label for="toUnit">Unidad destino</label>
         <select name="toUnit">
            <option value="Bit">Bit</option>
            <option value="Byte">Byte</option>
            <option value="Kilobyte">Kilobyte</option>
            <option value="Megabyte">Megabyte</option>
            <option value="Gigabyte">Gigabyte</option>
            <option value="Terabyte">Terabyte</option>
            <option value="Petabyte">Petabyte</option>
        </select>
        
        <input type="submit" name="resultado" value="Obtener resultado">
        <input type="submit" name="volvIni" value="Volver">
    </form>  
    
    <?php if(isset($_SESSION['resultadosoap'])){
        
          echo "<table class='table table-bordered'>";
                    echo "<thead class='thead-inverse'>";
                    echo "<tr>";
                    echo "<th>Unidad</th>";
                    echo "<th>UnidadOrigen</th>";
                    echo "<th>UnidadDestino</th>";
                    echo "<th>Conversion</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tr>";
                    echo "<td>";
                    echo $_POST['unidad'];
                    echo "</td>";
                    echo "<td>";
                    echo $_POST['fromUnit'];
                    echo "</td>";
                     echo "<td>";
                    echo $_POST['toUnit'];
                    echo "</td>";
                    echo "<td>";
                    print_r($_SESSION['resultadosoap']);
                    echo "</td>";
                    echo "</tr>";
                    echo "</table>";
        
    } ?>
    
    
</main>
