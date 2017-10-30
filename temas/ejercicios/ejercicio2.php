<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //herdoc.
        $str = <<<EOD
Ejemplo de una cadena <br>
expandida en varias líneas <br>
empleando la sintaxis heredoc. <br>
EOD;
        echo $str;
        ?>
    </body>
</html>