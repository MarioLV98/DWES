<?php
/**
 * Fichero DBPDO.php
 * 
 * Ejecucion consultas
 * 
 * @package modelo
 */

require_once 'config/datosBD.php'; //Añadimos los datos necesarios para la conexion

/**
 * Clase DBPDO
 */

class DBPDO{
    
    //Esta funcion creará una conexion con la base de datos y ejecutara las consultas y parametros que le pasemos
    /**
     * EjecutarConsulta
     * 
     * Ultima revision 22/1/2018
     * Conecta con la base de datos y ejecuta las consultas
     * 
     * @author Mario Labra Villar
     * @param string $consulta consulta sql
     * @param string $parametros parametros
     * @return $consultaPreparada se devuelve la consulta
     */
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

?>



