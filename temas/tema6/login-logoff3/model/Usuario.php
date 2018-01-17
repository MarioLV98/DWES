<?php

require_once 'UsuarioPDO.php';

class Usuario{
    
    private $codUsuario;
    private $descUsuario;
    private $password;
    private $perfil;
    private $ultimaConexion;
    private $contadorAccesos;
    
    function __construct($codUsuario, $descUsuario, $password, $perfil, $ultimaConexion, $contadorAccesos) {
        $this->codUsuario = $codUsuario;
        $this->descUsuario = $descUsuario;
        $this->password = $password;
        $this->perfil = $perfil;
        $this->ultimaConexion = $ultimaConexion;
        $this->contadorAccesos = $contadorAccesos;
    }
    /**
     * Esta funcion sirve para validar el usuario
     * 
     * @param string $codUsuario Codigo o nombre de usuario que introducimos en el formulario
     * @param string $password CContraseña que introducimos en el formulario
     * @return \Usuario Objeto usuario con la informacion del msmo
     */
    
    public static function validarUsuario($codUsuario,$password){
        
        $usuario= null;
        
        $arrayUsuario = UsuarioPDO::validarUsuario($codUsuario, $password);
        print_r($arrayUsuario);
        if($arrayUsuario){
         $usuario= new Usuario($codUsuario,$arrayUsuario['descUsuario'],$password,$arrayUsuario['perfil'],$arrayUsuario['ultimaConexion'],$arrayUsuario['contadorAccesos']);
                 
        }
        
        return $usuario;
        
    }
            
    function getCodUsuario() {
        return $this->codUsuario;
    }

    function getDescUsuario() {
        return $this->descUsuario;
    }

    function getPassword() {
        return $this->password;
    }

    function getPerfil() {
        return $this->perfil;
    }

    function getUltimaConexion() {
        return $this->ultimaConexion;
    }

    function getContadorAccesos() {
        return $this->contadorAccesos;
    }

  


}
