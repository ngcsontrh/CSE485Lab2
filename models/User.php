<?php

require './database/Database.php';

class User {
    public $id;
    public $username;
    public $password;
    public $role;

    public function __construct($id = null, $username = null, $password = null, $role = null) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }

    function Create() {
        try {
            $db = new Database();
            $conn = $db->GetConnection();
            $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':password', $this->password);
            $stmt->bindParam(':role', $this->role);

            if ($stmt->execute()) {
                $conn = null;
                return true;
            } else {
                $conn = null;
                return false;
            }
        } catch (Exception $ex) {
            $conn = null;
            error_log($ex->getMessage());
            return false;
        }
    }

    function Get($id) {
        try {
            $db = new Database();
            $conn = $db->GetConnection();
            $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $conn = null;

            if ($user) {
                $this->id = $user['id'];
                $this->username = $user['username'];
                $this->password = $user['password'];
                $this->role = $user['role'];
                return $user;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            $conn = null;
            error_log($ex->getMessage());
            return null;
        }
    }

    function Update() {
        try {
            $db = new Database();
            $conn = $db->GetConnection();
            $stmt = $conn->prepare("UPDATE users SET username = :username, password = :password, role = :role WHERE id = :id");
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':password', $this->password);
            $stmt->bindParam(':role', $this->role);
            $stmt->bindParam(':id', $this->id);

            if ($stmt->execute()) {
                $conn = null;
            } else {
                $conn = null;
            }
        } catch (Exception $ex) {
            $conn = null;
            error_log($ex->getMessage());
        }
    }

    function Delete($id) {
        try {
            $db = new Database();
            $conn = $db->GetConnection();
            $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                $conn = null;
                return true;
            } else {
                $conn = null;
                return false;
            }
        } catch (Exception $ex) {
            $conn = null;
            error_log($ex->getMessage());
            return false;
        }
    }

    function GetAll() {
        try {
            $db = new Database();
            $conn = $db->GetConnection();
            $stmt = $conn->prepare("SELECT * FROM users");
            $stmt->execute();

            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return $users;
        } catch (Exception $ex) {
            $conn = null;
            error_log($ex->getMessage());
            return [];
        }
    }
}
