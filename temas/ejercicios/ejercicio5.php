<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //Autor: Mario Labra Villar
        //Ultima modificación: 25/10/2017 
        //uso de timeStamp
        $fecha = new DateTime();
        echo $fecha->format('U = Y-m-d H:i:s') . "\n";

        $fecha->setTimestamp(1171502725);
        echo $fecha->format('U = Y-m-d H:i:s') . "\n";
        ?>
    </body>
</html>