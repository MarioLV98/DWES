<?php

include 'configuracion.php';
try{
  //Realizamos la conexion con la BD  usando los datos de configuracion.php   
 $conexion = new PDO($datosConexion,$usuario,$contraseña);
  //Creamos los atributos para lanzar excepcion en caso de error
 $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $departamentos= array();
 $num=0;
 
 //Cargamos los datos en el array
 $departamentos[0]["CodDepartamento"]="m10";
 $departamentos[0]["DescDepartamento"]="C1";
 $departamentos[0]["FechaBaja"]="2017-1-1";
 $departamentos[1]["CodDepartamento"]="m11";
 $departamentos[1]["DescDepartamento"]="C2";
 $departamentos[1]["FechaBaja"]="2017-1-1";
 $departamentos[2]["CodDepartamento"]="m12";
 $departamentos[2]["DescDepartamento"]="C3";
 $departamentos[2]["FechaBaja"]="2017-1-1";
 
  //consulta sql
 $sql="Insert into Departamento (CodDepartamento,DescDepartamento,FechaBaja) values (:CodDepartamento,:DescDepartamento,:FechaBaja)";
 
 
 for($i=0;$i<3;$i++){
     //Preparamos la consulta
     $orden=$conexion->prepare($sql);
     //Pasamos los datos a la consulta para que se inserten
     $orden->bindParam(":CodDepartamento", $departamentos[$i]["CodDepartamento"]);
     $orden->bindParam(":DescDepartamento", $departamentos[$i]["DescDepartamento"]);
     $orden->bindParam(":FechaBaja", $departamentos[$i]["FechaBaja"]);
     $orden->execute();
     
     //Extraemos el numero de filas afectadas
     $num+= $orden->rowCount();
 }
 
 //Si es igual a 3 es correcto
 if($num=3){
     echo "Insertado con exito";
 }else{
     echo "Error al insertar";
 }     
    //Cuando hayamos terminado cerramos la conexion
     unset($conexion);
     //Capturamos la excepcion
}catch(PDOException $PDOE){
    echo $PDOE->getMessage();
    //En caso de error se cierra la conexion
    unset($conexion);
}

