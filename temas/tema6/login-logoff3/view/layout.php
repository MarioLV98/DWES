<!doctype html>
<html>
    <head>
        <title>Login-Logoff</title>
        <link rel="stylesheet" type="text/css" href="webroot/estilos.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        <header>
            <h3>Login-Logoff</h3>
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
         <footer>
             <a href="https://github.com/MarioLV98/dwes.git"><img id="repositorio1" src="webroot/github.PNG"/></a>
             <a  href="http://daw-usgit.sauces.local/MLV-1718/dwes"> <img  id="repositorio2" src="webroot/gitlab.PNG"/></a>
            <h4>Powered by <a href="">Mario Labra</a></h4>
        </footer>
    </body>

</html>
