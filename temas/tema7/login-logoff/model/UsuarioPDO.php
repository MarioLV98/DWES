<?php
/**
 * UsuarioPDO
 */

include 'DBPDO.php';
include 'UsuarioBD.php';

/**
 * Usuario PDO
 */

class UsuarioPDO implements UsuarioBD{
    
    
    //Esta funcion es la que se encarga de comprobar que el usuario introducido es correcto
    /**
     * Funcion Validar usuario
     * 
     * Ultima revision 19/01/2018
     * Se crea la consulta y se le añaden los parametros que la clase DBPDO va a ejecutar
     * 
     * @author Mario Labra Villar
     * @param string $codUsuario Codigo de usuario
     * @param string $password  Contraseña
     * @return array $arrayUsuario Array con los datos del usuario
     */
    public static function validarUsuario($codUsuario, $password) {
        
        $arrayUsuario=[];
        $consulta="select * from Usuarios where codUsuario='$codUsuario' AND password='$password'";
        $resultado= DBPDO::ejecutarConsulta($consulta, [$codUsuario,$password]);
        
        //Comprueba que el usuario existe
        if($resultado->rowCount()){
           $usuario= $resultado->fetchObject();
           $arrayUsuario['descUsuario'] = $usuario->descUsuario;
           $arrayUsuario['perfil'] = $usuario->perfil;
           $arrayUsuario['ultimaConexion'] = $usuario->ultimaConexion;
           $arrayUsuario['contadorAccesos'] = $usuario->contadorAccesos;
            
        }
        
        //Devuelve el array con los datos del usuario
        return $arrayUsuario;
        
    }
    
    /**
     * Funcion registrar usuario
     * 
     * Ultima revision 19/01/2018
     * Se crea la consulta y se le añaden los parametros que la clase DBPDO va a ejecutar
     * 
     * @param type $codUsuario codigo de usuario
     * @param type $password    contraseña
     * @return boolean  $registroOk combrueba si es correcto o no
     */
    public static function registrarUsuario($codUsuario, $password, $desc, $perf) {
        
        $registroOk=true;
        $consulta="insert into Usuarios values ('$codUsuario','$desc','$password','$perf','2000-1-1','0')";
        $resultado= DBPDO::ejecutarConsulta($consulta, [$codUsuario,$password]);
        
        //Comprueba que el usuario existe
        if($resultado->rowCount()!=1){
           
            $registroOk=false;
        }
        
        //Devuelve el array con los datos del usuario
        return $registroOk;
        
    }
    /**
     * Funcion modificar usuario
     * 
     * Ultima revision 30/01/2018
     * Se crea la consulta y se le añaden los parametros que la clase DBPDO va a ejecutar
     * 
     * @param type $codUsuario codigo de usuario
     * @param type $password    contraseña
     * @param type $desc    descripcion de usuario
     * @param type $perf    perfil de usuario
     * @return boolean $modificacionOk comprueba si es correcto o no
     */
    public static function modificarUsuario($codUsuario,$password,$desc ,$perf){
        
        $modificacionOk=true;
        $consulta="update Usuarios set password='$password',descUsuario='$desc',perfil='$perf' where codUsuario='$codUsuario'";
        $resultado= DBPDO::ejecutarConsulta($consulta, [$codUsuario,$password,$desc,$perf]);
        
        if($resultado->rowCount()!=1){
            $modificacionOk=false;
        }
        
        return $modificacionOk;
    }
    
    /**
     * Funcion borrar usuario
     * 
     * Ultima revision 30/01/2018
     * Se crea la consulta y se le añaden los parametros que la clase DBPDO va a ejecutar
     * 
     * @param type $codUsuario codigo de usuario
     * @return boolean $borradoOk comprueba si se ha borrado o no
     */
    
    public static function borrarUsuario($codUsuario){
        
        $borradoOk=true;
        $consulta="delete from Usuarios where codUsuario='$codUsuario'";
        $resultado= DBPDO::ejecutarConsulta($consulta, [$codUsuario]);
        
        if($resultado->rowCount()!=1){
            $borradoOk=false;
        }
        
        return $borradoOk;
    }
    /**
     * Funcion para actualizar accesos
     * 
     * Ultima revision 30/01/2018
     * Se crea la consulta y se le añaden los parametros que la clase DBPDO va a ejecutar
     * Sirve para contar el numero de visitas de cada usuario
     * 
     * @param type $codUsuario codigo de usuario que le pasamos
     */
    public static function actualizarAccesos($codUsuario){
        
        
        $consulta="update Usuarios set contadorAccesos=contadorAccesos+1 where codUsuario='$codUsuario'";
        DBPDO::ejecutarConsulta($consulta, [$codUsuario]);
        
    }
    /**
     * Funcion para actualizar la fecha de acceso
     * 
     * Ultima revision 30/01/2018
     * Se crea la consulta y se le añaden los parametros que la clase DBPDO va a ejecutar
     * Sirve para saber la fecha de la ultima conexion
     * 
     * @param type $codUsuario codigo de usuario que le pasamos
     */
     public static function actualizarFechaAcceso($codUsuario){
        $consulta = "update Usuarios set ultimaConexion =NOW() where codUsuario='$codUsuario'";
        DBPDO::ejecutarConsulta($consulta, [$codUsuario]);
    }

    

}
