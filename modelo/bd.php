<?php

class BD {

    private $server = "localhost";
    private $user = "root";
    private $password = "";
    private $db = "tienda";
    protected $conn;

    function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->server;dbname=$this->db;charset=UTF8", $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }

    function fetch($sql, $params = []) { // RECUPERAR. Si tiene parámetros se pasan (array) si no le paso nada, será un array vacío.
        try {
            $st = $this->conn->prepare($sql);
            $st->execute($params);
            return $st->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    function execute($sql, $params = []) { // INSERTAR, BORRAR, ACTUALIZAR
        try {
            $st = $this->conn->prepare($sql);
            $st->execute($params);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

}
