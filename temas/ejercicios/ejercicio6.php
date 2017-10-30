<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title></title>
    </head>
    <body>

        <?php 
        //Autor: Mario Labra Villar
        //Ultima modificación: 25/10/2017 
        $fech = date('d-m-Y'); //variable con la fecha
        $masunmes = strtotime('+60 day', strtotime($fech)); //usamos strototime para sumarle 60 dias a esafecha
        $masunmes = date('d-m-Y', $masunmes); //mostramos el resultado de la fecha sumada

        echo $masunmes;
        ?> 

    </body>
</html>