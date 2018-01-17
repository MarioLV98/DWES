<!doctype html>
<html>
    <head>
        <title>Login-Logoff</title>
    </head>
    <body>
        <header>
            <h3>Login-Logoff</h3>
        </header>
        <?php
            $layout= "vIncicio.php";
            
            if(isset($_GET['location'])&&isset($vistas[$_GET['location']])){
                $layout=$vistas[$_GET['location']];
            }
            
            include $layout;
        ?>
    </body>
    
</html>
