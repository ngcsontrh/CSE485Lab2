<?php

require './services/UserService.php';
class UserController {
    private UserService $service;
    public function __construct()
    {
        $this->service = new UserService();
    }

    public function index() : void {                
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
            header('Location: /User/Login');
        }
        if ($_SESSION['role'] != 1) {
            header('Location: /');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];
            $result = $this->service->delete($id);
            if ($result) {
                header('Location: /User');
            }
            else {
                die("Xoá thất bại");
            }
        }
        $users = $this->service->getAll();
        // dd($users);
        require './views/user/Index.php';
    }

    public function login() : void {
        if (isset($_SESSION['user_id'])) {
            header('Location: /User');
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
        
            $userService = new UserService();
            $isLoginSuccessful = $userService->login($username, $password);
        
            if ($isLoginSuccessful) {
                if ($_SESSION['role'] == 1) {
                    header('Location: /User');
                }
                else {
                    header('Location: /');
                }
            } else {
                die('Tên đăng nhập hoặc mật khẩu không hợp lệ');
            }
        }

        require './views/user/login.php';
    }

    public function register() : void {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? null;
            $password = $_POST['password'] ?? null;
            $user = new User(username: $username, password: $password, role: 0);
            $result = $this->service->create($user);
            if ($result) {
                $this->service->login($user->getUsername(), $password);
                header('Location: /');
            } else {
                die("Đăng ký người dùng thất bại");
            }
        }
        require './views/user/Register.php';
    }

    public function logout() : void {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /User/Login');
        }
        $this->service->logout();
        header('Location: /User/Login');
    }

    public function create() : void {
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
            header('Location: /User/Login');
        }
        if ($_SESSION['role'] != 1) {
            header('Location: /');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? null;
            $password = $_POST['password'] ?? null;
            $role = $_POST['role'];
            $user = new User(username: $username, password: $password, role: $role);
            $result = $this->service->create($user);
            if ($result) {
                header('Location: /User');
            } else {
                die("Tạo mới người dùng thất bại");
            }
        }
        require './views/user/Create.php';
    }

    public function update() : void {
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
            header('Location: /User/Login');
        }
        if ($_SESSION['role'] != 1) {
            header('Location: /');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
            $id = $_GET['id'];
            $user = $this->service->getById($id);
            require './views/user/Edit.php';
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            $user = new User($id, $username, $password, $role);
            $result = $this->service->update($user);
            if ($result) {
                header('Location: /User');
            } else {
                die("Cập nhật người dùng thất bại");
            }
        }
    }
}