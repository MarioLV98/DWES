<?php

class ManejoBD{
    private $tabla ,$db ,$conectar;
    
    public function __construct() {
        $this->conectar= new Conectar();
        $this->db= $this->conectar->conexion();
    }
    
    public function getConectar() {
        return $this->conectar;
    }
    
    public function db() {
        return $this->db;
    }
    
    public function getAll() {
        
        $query= $this->db->query("select * from $this->tabla");
        
        while ($res = $query->fetch(PDO::FETCH_OBJ)){
            echo $res->usuario;
        }
        
        return  $res;
    }
    
    public function comprarUsuarioOk($usuario,$passwd){
        
        echo $usuario;
        echo $passwd;
        
        $consulta="select * from usuarios where usuario='$usuario' and contrasena='sha2($passwd,256)'";  
      $query=$this->db->query("select * from Usuarios where usuario='$usuario' and contrasena=sha2('$passwd',256)");
     
        echo "Numero lineas: ".$query->rowCount();
        
        if($query->rowCount()!=0){
           echo "La autenticacion es correcta";
        }
      
             
    }
}
