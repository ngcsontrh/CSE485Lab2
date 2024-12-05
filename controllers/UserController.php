<?php

require '../configs/config.php';

class UserController {

    function Index() {
        $db = new Database();
        $conn = $db->GetConnection();
        $sql = "select * from users";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();
    
        require '../views/user/Index.php';
    }

    function Register() {
        
    }
}