<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$datos = array();

for ($i = 0; $i < 365; $i++) {
    $datos[$i] = array(
        'Avila' => '',
        'Burgos' => '',
        'Leon' => '',
        'Palencia' => '',
        'Salamanca' => '',
        'Segovia' => '',
        'Soria' => '',
        'Valladolid' => '',
        'Zamora' => ''
    );

    foreach ($datos[$i] as $valor) {

        $valor = array(
            'Temp' => '',
            'Pres' => ''
        );
        
     
        
    }
}

for($i = 0; $i < 365; $i++){
$datos[$i]['Zamora']['Temp'] = "Sin datos registrados";
$datos[$i]['Zamora']['Pres'] = "Sin datos registrados";
$datos[$i]['Segovia']['Temp'] = "Sin datos registrados";
$datos[$i]['Segovia']['Pres'] = "Sin datos registrados"; 
$datos[$i]['Salamanca']['Temp'] = "Sin datos registrados";
$datos[$i]['Salamanca']['Pres'] = "Sin datos registrados";
$datos[$i]['Valladolid']['Temp'] = "Sin datos registrados";
$datos[$i]['Valladolid']['Pres'] = "Sin datos registrados"; 
$datos[$i]['Soria']['Temp'] = "Sin datos registrados";
$datos[$i]['Soria']['Pres'] = "Sin datos registrados";
$datos[$i]['Avila']['Temp'] = "Sin datos registrados";
$datos[$i]['Avila']['Pres'] = "Sin datos registrados";
$datos[$i]['Burgos']['Temp'] = "Sin datos registrados";
$datos[$i]['Burgos']['Pres'] = "Sin datos registrados";
$datos[$i]['Leon']['Temp'] = "Sin datos registrados";
$datos[$i]['Leon']['Pres'] = "Sin datos registrados";
$datos[$i]['Palencia']['Temp'] = "Sin datos registrados";
$datos[$i]['Palencia']['Pres'] = "Sin datos registrados";

}



$datos[1]['Leon']['Temp'] = 12;
$datos[1]['Leon']['Pres'] = 1050;

foreach($datos as $dias => $dia){
    
    foreach($dia as $clave => $valor){
        
        echo "Dias: ".$dias;
        echo " Provincia: ".$clave;
        echo " Temperatura ".$valor["Temp"];
        echo " Presion ".$valor["Pres"];
        echo " <br /><br />";
    }
    
}

?>