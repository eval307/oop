<?php

class Database {

    private $conn;

    function __construct() {
        $this->conn = new mysqli("localhost", "root", "123", "belajar_oop");
    }
    function getKoneksi() {
        return $this->conn;
    }

    function __destruct() {
        $this->conn->close();
    }

}
