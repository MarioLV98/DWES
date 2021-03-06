<?php
/**
 * Fichero Rest.php
 * 
 * Uso de rest
 * 
 * @package modelo
 */

/**
 * Clase rest
 */

class Rest{
    
    /**
     * Funcion usoRest
     * 
     *  Ultima revision 01/02/2018 
     * @author Mario Labra Villar
     * 
     * @param  $location coordenadas
     * @param  $time timestamp
     * @return  archivo json
     */
 
    public static function usoRest($location,$time){
        
        $resultado= file_get_contents("https://maps.googleapis.com/maps/api/timezone/json?location=$location&timestamp=$time&key=AIzaSyCHIGjtc1dnBgRRRNqdI93AXU4_fjdmTJc");
        
        return json_decode($resultado);
    }
    
}
