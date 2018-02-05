<!doctype html>
<html>
    <head>
        <title>Login-Logoff</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="webroot/estilos.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        <header>
            <div class="container">
                <h1> Web de Mario</h1>
            </div>
            
              
           
        </header>
        <?php
        //Intoducimos un valor en el layout
        $layout = "vInicio.php";

        //Si se ha definido algo en el $_GET se le añade la nueva ruta
        if (isset($_GET['location']) && isset($vistas[$_GET['location']])) {
            $layout = $vistas[$_GET['location']];
        }

        include $layout;
        ?>

        <footer >
            
            <a href="https://github.com/MarioLV98/dwes.git">GitHub</a>
            <a  href="http://daw-usgit.sauces.local/MLV-1718/dwes">GitLab</a>
            <form action="index.php?location=codigo" id="formulario" method="post">
                    <input class="btn pull-right btn-info" type="submit" name="codigo" value="Ver Codigo"> 
            </form>
            <p><a class="btn pull-right btn-success" href="doc/index.html">PHPDoc</a></p>
            <h4>Powered by <a href="../indextema6.html">Mario Labra</a></h4>
           
        </footer>

    </body>

</html>
