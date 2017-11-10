<?php
    
    
    $conexion = new mysqli("192.168.20.19","DAW206","paso","DAW206_DBdepartamentos");
    
    
    if($conexion->connect_errno){
        echo "Impoisble conectar <br/>";
        echo "Error: " .$conexion->connect_errno;
    }
    else{
        
        $orden = "SELECT * FROM Departamento";
      
        $sql=$conexion->prepare($orden);
        $sql->execute();
        $res=$sql->get_result();
        $departamentos=$res->fetch_all(MYSQLI_ASSOC);
        $numRegistros = $res->num_rows;
        echo "Numero de registros $numRegistros<br/>";
        
        for($i = 0; $i < count($departamentos);$i++){
            foreach($departamentos[$i] as $indice =>$valor){
                echo ("$indice:$valor<br/>");
                }
                echo("<br />");
        }
        
    }
    $conexion->close();
?>
