<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title></title>
    </head>
    <body>

        <?php
        //Autor: Mario Labra Villar
        //Ultima modificación: 25/10/2017 
        echo " print_r: ";
        print_r($GLOBALS);      //Mostrar las variables globales con print_r

        echo "foreach:";
        foreach ($_SERVER as $var => $val) {  //Mostrar las variables globales con indice -> valor mediante el bucle foreach
            echo "$var = $val<br/>";
        }
        ?>     




    </body>
</html>