<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //Autor: Mario Labra Villar
        //Ultima modificación: 25/10/2017 
        $compañeros[1][7] = "Mario";        //Se declara array bidimensional
        $compañeros[8][8] = "JC";
        $compañeros[15][17] = "Juanjo";
        $compañeros[4][2] = "Marques";
        $compañeros[2][4] = "Guti";

        foreach ($compañeros as $fila => $a) {      // se muestran los inidces y los valores del array

            foreach ($a as $asiento => $asientos) {
                print " En la fila " . $fila . " esta " . $asientos . " en el asiento " . $asiento . "<br>";
            }
        };
        ?>
    </body>
</html>