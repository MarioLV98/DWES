<?php

if (!isset($_SESSION['usuario'])) {//Si no hay usuario en la sesion nos redirige al login
    header("Location:index.php?location=login");
} else {//Si no se ejecuta el codigo

    if (isset($_POST['volvIni'])) {//Si pulsamos volver volvemos a inicio
        header("Location:index.php?location=inicio");
    } else {//Si no carga la vista
        include 'view/layout.php';
    }
    //Url de soap
    $conversorUnidades = new SoapClient("http://www.webservicex.net/ConvertComputer.asmx?WSDL");
    //Si se han introducido estos datos
    if (isset($_POST['resultado']) || isset($_POST['unidad']) || isset($_POST['fromUnit']) || isset($_POST['toUnit'])) {
        //Rellenamos el array que le vamos a pasar a soap
        $array= Soap::usoSoap($_POST['unidad'], $_POST['fromUnit'], $_POST['toUnit']);
        
        //Ejecutamos las funciones propias de soap
        $resultado = $conversorUnidades->ChangeComputerUnit($array);
        $resultadosoap = $resultado->ChangeComputerUnitResult;
        //Cargamos el resultado en la sesion
        $_SESSION['resultadosoap'] = $resultadosoap;
    }
}
