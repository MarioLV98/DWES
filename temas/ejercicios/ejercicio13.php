<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title></title>
    </head>
    <body>

        <?php
        //Autor: Mario Labra Villar
        //Ultima modificación: 25/10/2017 
        $arch = "contador.txt";
        $f = fopen($arch, "r");
        $cont = fgets($f, 26);
        $cont++;
        fclose($f);
        $f = fopen($arch, "w+");
        fwrite($f, $cont, 26);
        fclose($f);
        echo "El numero de visitas es " . $cont;
        ?>     




    </body>
</html>