<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title></title>
    </head>
    <body>

        <?php
        //Autor: Mario Labra Villar
        //Ultima modificación: 25/10/2017 
        $dias = array(  //Declaracion de array
            "Lunes" => 10,
            "Martes" => 20,
            "Miercoles" => 30,
            "Jueves" => 40,
            "Viernes" => 50,
            "Sabado" => 60,
            "Domingo" => 70,
        );

        while (key($dias) !== null) {
            echo key($dias) . ":" . current($dias) . "<br>";  //Lo mostramos
            $totalSueldo += current($dias); //Acumulamos
            next($dias);
        }



        print ("Salario total : $totalSueldo");
        ?>     




    </body>
</html>