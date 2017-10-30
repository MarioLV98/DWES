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

        do {
            if (key(current($compañeros)) < 16) {       // se muestran los inidces y los valores del array

                echo "Fila: " . key($compañeros) . " Asiento: " . key(current($compañeros)) . " Nombre " . current(current($compañeros)) . "<br>";
            }
        } while (next($compañeros));
        ?>
    </body>
</html>