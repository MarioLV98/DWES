<?php
/**
 * UsuarioBD
 */
/**
 * Interfaz usuario DB
 */
interface UsuarioBD{
    /**
     * Inteface validar usuario
     * 
     * Interface para llmar a la validacion de usuario
     * Ultima revision 19/01/2018
     * 
     * @author Mario Labra Villar
     * @param string $codUsuario  Codigo de usuario
     * @param string $password    Contraseña
     */
public static function validarUsuario($codUsuario,$password);
}