<?php
/*
 * Fichero departamento.php
 */
require_once 'DepartamentoPDO.php';

/*
 * Clase Departamento
 */

class Departamento {
    protected $codDepartamento;
    protected $descDepartamento;
    protected $volumenNegocio;
    /**
     * Constructor
     * 
     * @author Mario Labra Villar
     * Ultima revision 30/01/2018
     *
     * @param type $codDepartamento codigo de departamento
     * @param type $descDepartamento    descripcion de departamento
     * @param type $volumenNegocio  volumen de negocio
     */
    function __construct($codDepartamento, $descDepartamento, $volumenNegocio) {
        $this->codDepartamento = $codDepartamento;
        $this->descDepartamento = $descDepartamento;
        $this->volumenNegocio = $volumenNegocio;
    }
    
    /**
     * getCodDepartamento
     * 
     * author Mario Labra Villar
     * Ultima revision 30/01/2018
     * 
     * Devuelve el codigo del departamento
     * @return type boolean
     */
    
    function getCodDepartamento() {
        return $this->codDepartamento;
    }

    function getDescDepartamento() {
        return $this->descDepartamento;
    }

    function getVolumenNegocio() {
        return $this->volumenNegocio;
    }

    public static function listarDepartamentos(){
      $departamentos=null;
        $departamento= DepartamentoPDO::listarDepartamentos();
        print_r($departamento);
        echo count($departamento);
        if(!empty($departamento)){
            
            for($i=0;$i<count($departamento);$i++){
                $departamentos[$i] = new Departamento($departamento[$i]['codDepartamento'],$departamento[$i]['descDepartamento'],$departamento[$i]['volumenNegocio']);
            }
            
        }
        return $departamentos;
    }
    
    public static function crearDepartamento($codDepartamento,$descDepartamento,$volumenNegocio){
        
        return DepartamentoPDO::crearDepartamento($codDepartamento, $descDepartamento, $volumenNegocio);
    }
    
    public static function modificarDepartamento($codDepartamento,$descDepartamento,$volumenNegocio){
        return DepartamentoPDO::modificarDepartamento($codDepartamento, $descDepartamento, $volumenNegocio);
    }
    
    public static function borrarDepartamento($codDepartamento){
        
        return DepartamentoPDO::borrarDepartamento($codDepartamento);
    }

}
