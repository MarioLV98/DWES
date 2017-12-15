<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="estilos.css">
        <title>Seguimiento</title>
    </head>
    <body>
        <main>
        <?php
        //Incluimos el fichero de configuracion
        include "configuracion.php";
        //Mostramos la fecha y hora
        echo 'Fecha actual '.date('Y-m-d')."<br>";
        echo 'Hora actual '.date('H:i:s')."<br>";
        
        try{
            //Creamos la conexion y sus atributos
            $conexion= new PDO($datosConexion,$usuario,$contraseña);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //Capturamos la excepcion pdo
        } catch (PDOException $pdoe){
            echo $pdoe->getMessage();
            unset($conexion);
        };
        
        //Sentencia sql
        $numeropersonas= "select count(distinct dni) as NumeroParticipantes from Encuesta";
        //Preparamos la consulta
        $sentencia1=$conexion->prepare($numeropersonas);
        //Ejecutamos la consulta
        try{
        $sentencia1->execute();
        }catch(PDOException $pdoe1){
            echo "Error consulta 1<br>";
            echo $pdoe1->getMessage();
            unset($conexion); 
        }
        //Guardamos el resultado en una variable
        $resultadopersonas=$sentencia1->fetch(PDO::FETCH_OBJ);
        
        //Mostramos el resultado
        echo "Numero alumnos:" .$resultadopersonas->NumeroParticipantes."<br>";
        
        //Sentencia sql
        $edadmedia= "select avg(timestampdiff(YEAR,fechanac,curdate())) as EdadMedia from Encuesta;";
        //Preparamos la consulta
        $sentencia2=$conexion->prepare($edadmedia);
        //Ejecutamos la consulta
        try{
        $sentencia2->execute();
        }catch(PDOException $pdoe2){
             echo "Error consulta 2<br>";
            echo $pdoe2->getMessage();
            unset($conexion); 
        }
        //Guardamos el resultado en una variable
        $resultadoedadmedia=$sentencia2->fetch(PDO::FETCH_OBJ);
        
        echo "Edad Media:" .$resultadoedadmedia->EdadMedia."<br>";
        
        //Sentencia sql
        $satisfaccionMedia= "select avg(satisfaccion) as Satisfaccion from Encuesta;";
        //Preparamos la consulta
        $sentencia3=$conexion->prepare($satisfaccionMedia);
        //Ejecutamos la consulta
        try{
        $sentencia3->execute();
        }catch(PDOException $pdoe3){
             echo "Error consulta 3<br>";
            echo $pdoe3->getMessage();
            unset($conexion); 
        }
        //Guardamos el resultado en una variable
        $resultadosatisfaccionMedia=$sentencia3->fetch(PDO::FETCH_OBJ);
        
        $mediaMaterial=(int) round($resultadosatisfaccionMedia->Satisfaccion);
        
        switch ($mediaMaterial){
            case 1:
                $material="Malos";
                break;
            case 2:
                $material="Muy mejorables";
                break;
            
            case 3:
                $material="Regulares";
                break;
            case 4:
                $material="Buenos";
                break;
            
             case 5:
                $material="Muy buenos";
                break;
        }
         echo "Satisfacción media:" .$material."<br>";
         
        //Sentencia sql 
        $numeroip = "select ip,count(*) as NumeroEncuestas from Encuesta group by ip";
        //Preparamos la consulta
        $sentencia4 = $conexion->prepare($numeroip);
        //Ejecutamos la consulta
        try{
        $sentencia4->execute();
        }catch(PDOException $pdoe4){
             echo "Error consulta 4<br>";
            echo $pdoe4->getMessage();
            unset($conexion); 
        }
        
        //Sentencia sql
        $opinion = "select nombreyapellidos,opiniones from Encuesta where opiniones != ''";
        //Preparamos la consulta
        $sentencia5 = $conexion->prepare($opinion);
        //Ejecutamos la consulta
        try{
        $sentencia5->execute();
        }catch(PDOException $pdoe5){
             echo "Error consulta 5<br>";
            echo $pdoe5->getMessage();
            unset($conexion); 
        }
        
         echo "<table>"
        . "<tr>"
                 . "<th>IP</th>"
                 . "<th>Numero encuestas</th>"
        . "</tr>";
         //Mostramos cada resultado para la tabla
            while ($resultadonumeroip = $sentencia4->fetch(PDO::FETCH_OBJ)) {
                echo "<tr>";
                echo "<td>$resultadonumeroip->ip</td>";
                echo "<td>$resultadonumeroip->NumeroEncuestas</td>";
                echo "</tr>";
            }
            echo "</table><br /><br />";
            
            echo "<table>"
            . "<tr>"
                    . "<th>Alumno</th>"
                    . "<th>Opiniones</th>"
                    . "</tr>";
             //Mostramos cada resultado para la tabla
            while ($resultadoopinion = $sentencia5->fetch(PDO::FETCH_OBJ)) {
                echo "<tr>";
                echo "<td>$resultadoopinion->nombreyapellidos</td>";
                echo "<td>$resultadoopinion->opiniones</td>";
                echo "</tr>";
            }
            echo "</table><br /><br />";
            
             echo "<a href='index.php'><button>Volver</button></a>"; 
             unset($conexion);
            ?>

        </main>
        
        <footer>
            <h3><a href="../tema4/indextema4.html">Mario Labra Villar</a></h3>
        </footer>
            
    </body>
</html>

