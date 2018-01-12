<?php

class Conectar {

    private $user, $password, $datos;

    public function __construct() {

        $db = include 'basededatos.php';
        $this->user = $db["user"];
        $this->password = $db["password"];
        $this->datos = $db["datos"];
    }

    public function conexion() {



        try {
            echo $this->user;
            echo $this->password;
            echo $this->datos;
            $con = new PDO($this->datos, $this->user, $this->password);

            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $PDOE) {

            die('Connection failed: ' . $PDOE->getMessage());
            unset($con);
        }

        return $con;
    }

}
