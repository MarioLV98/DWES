<?php

require_once 'config/datosBD.php';
class DBPDO{
    
    public static function ejecutarConsulta($consulta,$parametros){
        
        try{
            $conexion = new PDO(datos,usuario,password);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $consultaPreparada = $conexion->prepare($consulta);
            $consultaPreparada->execute($parametros);
        } catch (PDOException $PDOE){
            $consultaPreparada = null;
            $PDOE->getMessage();
            unset($conexion);
        }
            
        return $consultaPreparada;
    }
}

