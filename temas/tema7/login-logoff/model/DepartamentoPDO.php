<?php
/**
 * Fichero DepartamentoPDO.php
 * 
 * Creacion departamentos
 * 
 * @package modelo
 */



/**
 * Clase departamento PDO
 */

class DepartamentoPDO{
    
    /**
     * Listar departamentos
     * 
     * @author Mario Labra Villar
     * Ultima revision 19/01/2018
     * 
     * @return type array con los departamentos
     */
    
    public static function listarDepartamentos(){
        $consulta="Select * from Departamentos";
        $arrayDPTO=[];
        $resultado= DBPDO::ejecutarConsulta($consulta,[]);
        $DPTO=[]; 
        $i=0;
        if($resultado->rowCount()>0){
            
            while($objeto =$resultado->fetchObject()){
                $arrayDPTO['codDepartamento'] = $objeto->codDepartamento;
                $arrayDPTO['descDepartamento'] = $objeto->descDepartamento;
               $arrayDPTO['volumenNegocio'] = $objeto->volumenNegocio;
               $DPTO[$i]=$arrayDPTO;
               $i++;
            }
            
        }
        
        return $DPTO;
    }
    
    /**
     * Crear departamento
     * 
     * @author Mario Labra Villar
     * Ultima revision 19/01/2018
     * 
     * Pasa los datos del departamento,ejecuta la consulta y crea el departamento
     * 
     * @param  $codDepartamento codio de departamento
     * @param  $descDepartamento   descripcion de departamento
     * @param  $volumenNegocio  volumen de negocio
     * @return boolean $inserccionOk confirma que la inserccion ha sido correcta
     */
    
    public static function crearDepartamento($codDepartamento,$descDepartamento,$volumenNegocio){
        
        $inseccionOK=false;
        $consulta = "insert into Departamentos values ('$codDepartamento','$descDepartamento','$volumenNegocio')";
        $resultado = DBPDO::ejecutarConsulta($consulta, [$codDepartamento,$descDepartamento,$volumenNegocio]);
        if($resultado->rowCount()!=0){
            $inseccionOK=true;
        }
        
        return $inseccionOK;
    }
     /**
     * Modificar departamento
     * 
     * @author Mario Labra Villar
     * Ultima revision 19/01/2018
     * 
     * Pasa los datos del departamento,ejecuta la consulta y modifica el departamento
     * 
     * @param $codDepartamento codio de departamento
     * @param $descDepartamento   descripcion de departamento
     * @param $volumenNegocio  volumen de negocio
     * @return boolean $modificacionOk ccomprueba que la modificacion ha sido correcta
     */
    public static function modificarDepartamento($codDepartamento,$descDepartamento,$volumenNegocio){
        
         $modificiacionOk=false;
        $consulta = "update Departamentos set descDepartamento='$descDepartamento',volumenNegocio='$volumenNegocio' where codDepartamento='$codDepartamento'";
        $resultado = DBPDO::ejecutarConsulta($consulta, [$codDepartamento,$descDepartamento,$volumenNegocio]);
        if($resultado->rowCount()!=0){
            $modificiacionOk=true;
        }
        
        return $modificiacionOk;
    }
    
    /**
     * Borrar departamento
     * 
     * @author Mario Labra Villar
     * Ultima revision 19/01/2018
     * 
     * Pasa los datos del departamento,ejecuta la consulta y borra el departamento
     * 
     * @param $codDepartamento codio de departamento
     * @return boolean $borradoOk ccomprueba que se ha borrado correctamente
     */
    
        public static function borrarDepartamento($codDepartamento){
        
         $borradoOk=false;
        $consulta = "delete from Departamentos where codDepartamento='$codDepartamento'";
        $resultado = DBPDO::ejecutarConsulta($consulta, [$codDepartamento]);
        if($resultado->rowCount()!=0){
            $borradoOk=true;
        }
        
        return $borradoOk;
    }
    
    /**
     * Funcion para comprobar que un departamento ya existe
     * 
     * Ultima revision 30/01/2018
     * Se crea la consulta y se le añaden los parametros que la clase DBPDO va a ejecutar
     * 
     * @param $valor codigo del usuario
     * @return string con el resultado de la validacion
     */
    public static function comprobarYaExistenteDep($valor){
     $valida = "";
     
     if(empty($valor)){
         $valida="No ha introducido ningun valor";
     }else{
         
         $consulta = "select * from Departamentos where codDepartamento ='$valor'";
         $resultado = DBPDO::ejecutarConsulta($consulta, [$valor]);
         if($resultado->rowCount()==1){
       
         $valida="El departamento ya existe";
         
        } 
     }
    
     return $valida;
} 
}