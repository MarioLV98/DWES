<?php

include 'DBPDO.php';
require_once 'UsuarioBD.php';

class UsuarioPDO implements UsuarioBD{
    
    
    
    public static function validarUsuario($codUsuario, $password) {
        
        $arrayUsuario=[];
        $consulta="select * from Usuarios where usuario='$codUsuario' AND contrasena='$password'";
        $resultado= DBPDO::ejecutarConsulta($consulta, [$codUsuario,$password]);
       
        if($resultado->rowCount()){
           $usuario= $resultado->fetchObject();
           $arrayUsuario['descUsuario'] = $usuario->descUsuario;
           $arrayUsuario['perfil'] = $usuario->perfil;
           $arrayUsuario['ultimaConexion'] = $usuario->ultimaConexion;
           $arrayUsuario['contadorAccesos'] = $usuario->contadorAccesos;
            
        }
        
        return $arrayUsuario;
        
    }

}
