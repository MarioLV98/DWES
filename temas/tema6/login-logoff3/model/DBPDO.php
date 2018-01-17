<?php

require_once 'config/datosBD.php'; //Añadimos los datos necesarios para la conexion
class DBPDO{
    
    //Esta funcion creará una conexion con la base de datos y ejecutara las consultas y parametros que le pasemos
    public static function ejecutarConsulta($consulta,$parametros){
        
        try{
            $conexion = new PDO(datos,usuario,password);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $consultaPreparada = $conexion->prepare($consulta);
            $consultaPreparada->execute($parametros);
        } catch (PDOException $PDOE){
            $consultaPreparada = null;
           echo "ErrorSQL: " .$PDOE->getMessage();
            unset($conexion);
        }
          
        //Devolvermos la consulta
        return $consultaPreparada;
    }
}

