<main>
    <form action="index.php?location=wsrest" method="post">
        <label for="localizacion">Coordenadas</label>
        <input type="text" name="localizacion" placeholder="-33.86,151.20"><br>
        <label for="hora">Fecha</label>
        <input type="date" name="hora">
        <br>
       
        
        <input type="submit" name="buscar" value="Buscar">
        <input type="submit" name="volver" value="Volver">
    </form>  
    
    <?php 
        
        if(isset($_SESSION['busquedareset'])){
                    print_r($_SESSION['busquedareset']);
                    
                    foreach ($_SESSION['busquedareset'] as $datos=>$dato){
                        
                        echo $dato;
                        
                    }
        }
        
     ?>
    
    
</main>
