<?php


include 'DBPDO.php';
include 'UsuarioBD.php';

class UsuarioPDO implements UsuarioBD{
    
    
    //Esta funcion es la que se encarga de comprobar que el usuario introducido es correcto
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

    

}
