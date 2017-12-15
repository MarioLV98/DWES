<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="estilos/estilos.css">
        <title>Seguimiento</title>
    </head>
    <body>
        <main>
            <?php
            //Incluimos el fichero de configuracion
            include "configuracion.php";
            //Mostramos la fecha y hora
            echo 'Fecha actual ' . date('Y-m-d') . "<br>";
            echo 'Hora actual ' . date('H:i:s') . "<br>";

            session_start();
            if (!empty($_SESSION['usuario'])) {
                //Creamos una cookiea para la ultima conexion
                setcookie("fecha_ultima_conexion", date("j, n, Y, g:i a"), time() + 3600);
                //Si se pulsa salir, se cierra la sesion

                try {
                    //Creamos la conexion y sus atributos
                    $conexion = new PDO($datosConexion, $usuario, $contraseña);
                    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //Capturamos la excepcion pdo
                } catch (PDOException $pdoe) {
                    echo $pdoe->getMessage();
                    unset($conexion);
                };

                //Sentencia sql
                $numeropersonas = "select count(distinct dni) as NumeroParticipantes from Encuesta2";
                //Preparamos la consulta
                $sentencia1 = $conexion->prepare($numeropersonas);
                //Ejecutamos la consulta
                try {
                    $sentencia1->execute();
                } catch (PDOException $pdoe1) {
                    echo "Error consulta 1<br>";
                    echo $pdoe1->getMessage();
                    unset($conexion);
                }
                //Guardamos el resultado en una variable
                $resultadopersonas = $sentencia1->fetch(PDO::FETCH_OBJ);

                //Mostramos el resultado
                echo "Numero encuestados:" . $resultadopersonas->NumeroParticipantes . "<br>";

                //Sentencia sql
                $satisfaccionMedia = "select avg(satisfaccion) as Satisfaccion from Encuesta2;";
                //Preparamos la consulta
                $sentencia3 = $conexion->prepare($satisfaccionMedia);
                //Ejecutamos la consulta
                try {
                    $sentencia3->execute();
                } catch (PDOException $pdoe3) {
                    echo "Error consulta 3<br>";
                    echo $pdoe3->getMessage();
                    unset($conexion);
                }
                //Guardamos el resultado en una variable
                $resultadosatisfaccionMedia = $sentencia3->fetch(PDO::FETCH_OBJ);

                echo "Satifaccion media " . $resultadosatisfaccionMedia->Satisfaccion . "<br>";


                //Sentencia sql
                $diasMedios = "select avg(ndias) as Dias from Encuesta2;";
                //Preparamos la consulta
                $sentencia7 = $conexion->prepare($diasMedios);
                //Ejecutamos la consulta
                try {
                    $sentencia7->execute();
                } catch (PDOException $pdoe3) {
                    echo "Error consulta 3<br>";
                    echo $pdoe3->getMessage();
                    unset($conexion);
                }
                //Guardamos el resultado en una variable
                $resultadodiasMedios = $sentencia7->fetch(PDO::FETCH_OBJ);

                echo "Dias medios" . $resultadodiasMedios->Dias . "<br>";

                //Sentencia sql 
                $numeroip = "select ip,count(*) as NumeroEncuestas from Encuesta group by ip";
                //Preparamos la consulta
                $sentencia4 = $conexion->prepare($numeroip);
                //Ejecutamos la consulta
                try {
                    $sentencia4->execute();
                } catch (PDOException $pdoe4) {
                    echo "Error consulta 4<br>";
                    echo $pdoe4->getMessage();
                    unset($conexion);
                }

                //Sentencia sql
                $opinion = "select dni,opiniones,mejor,peor from Encuesta2 where opiniones != ''";
                //Preparamos la consulta
                $sentencia5 = $conexion->prepare($opinion);
                //Ejecutamos la consulta
                try {
                    $sentencia5->execute();
                } catch (PDOException $pdoe5) {
                    echo "Error consulta 5<br>";
                    echo $pdoe5->getMessage();
                    unset($conexion);
                }

                echo "<table>"
                . "<tr>"
                . "<th>dni</th>"
                . "<th>Opiniones</th>"
                . "<th>Mejor</th>"
                . "<th>Peor</th>"
                . "</tr>";
                //Mostramos cada resultado para la tabla
                while ($resultadoopinion = $sentencia5->fetch(PDO::FETCH_OBJ)) {
                    echo "<tr>";
                    echo "<td>$resultadoopinion->dni</td>";
                    echo "<td>$resultadoopinion->opiniones</td>";
                    echo "<td>$resultadoopinion->mejor</td>";
                    echo "<td>$resultadoopinion->peor</td>";
                    echo "</tr>";
                }
                echo "</table><br /><br />";

                echo "<a href='indexencuesta.php'><button>Volver</button></a>";
                unset($conexion);
            } else {

                echo "<script>window.location='indexencuesta.php'</script>";
            }
            ?>

        </main>

        <footer>
            <h3><a href="../tema4/indextema4.html">Mario Labra Villar</a></h3>
        </footer>

    </body>
</html>

