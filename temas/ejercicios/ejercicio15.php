<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title></title>
    </head>
    <body>

        <?php
        //Autor: Mario Labra Villar
        //Ultima modificación: 25/10/2017 
        $dias = array(          //array con los dias y el sueldo
            "Lunes" => 10,
            "Martes" => 20,
            "Miercoles" => 30,
            "Jueves" => 40,
            "Viernes" => 50,
            "Sabado" => 60,
            "Domingo" => 70,
        );

        foreach ($dias as $semana => $sueldo) {  //mostramos el dia y el sueldo con foreach

            echo "El sueldo de " . $semana . " es " . $sueldo . "<br>";

            $sueldototal += $sueldo;  // con el acumulador lo sumamos
        };

        echo "Sueldo semanal: " . $sueldototal;
        ?>     




    </body>
</html>