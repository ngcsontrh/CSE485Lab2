<?php

class Database {
    private $host = "mysql_app";
    private $dbname = "lab2";
    private $username = "root";
    private $password = "Bruhzzz.";

    function getConnection() {
        try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Kết nối thất bại: " . $e->getMessage());
        }
        return $conn;
    }
}