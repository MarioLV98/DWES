<?php


    $conexion = new mysqli("192.168.20.19","DAW206","paso","DAW206_DBdepartamentos");
    
    if($conexion->connect_errno){
        echo 'Error en la conexion';
        echo "Codigo de error ".$conexion->connect_errno;
    }else{
        
        $bien=true;
        
        $c1="insert into Departamento values('EJ5-6','Ejemplo1','2017-1-1')";
        $c2="insert into Departamento values('EJ5-7','Ejemplo2','2017-1-1')";
        $c3="insert into Departamento values('EJ5-8','Ejemplo3','2017-1-1')";
        
        if(!$conexion->query($c1)){
            $bien=false;
        }
        
         if(!$conexion->query($c2)){
            $bien=false;
        }
        
         if(!$conexion->query($c3)){
            $bien=false;
        }
        
        if($bien){
            $conexion->commit();
            echo "Inserccion realizada con exito";
        }else{
            $conexion->rollback();
            echo "Error";
        }
       $conexion->close(); 
    }

