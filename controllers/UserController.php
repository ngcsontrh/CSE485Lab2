<?php

require './models/User.php';
class UserController {

    function Index() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];
            $user = new User(id:$id);
            $user->Delete($id);
            header('Location: /User');
        }
        $table = new User();
        $users = $table->GetAll();
        require './views/user/Index.php';
    }

    function Create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $user = new User(username: $username, password: password_hash($password, PASSWORD_DEFAULT), role: 0);
            $user->Create();
            header('Location: /User');
        }
        require './views/user/Create.php';
    }

    function Update() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
            $id = $_GET['id'];
            $user = new User();
            $user->Get($id);
            require './views/user/Update.php';
        }
        else {
            die('No');
        }
    }
}