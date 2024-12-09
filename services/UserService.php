<?php

require './database/Database.php';
require './models/User.php';

class UserService
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function create(User $user): bool
    {
        try {
            $user->setPassword($this->getHashedPassword($user->getPassword()));
            $conn = $this->db->getConnection();
            $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
            
            $username = $user->getUsername();
            $password = $user->getPassword();
            $role = $user->getRole();
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':role', $role);
            $result = $stmt->execute();

            $conn = null;

            return $result;
        } catch (\Exception $ex) {
            error_log($ex->getMessage());
            return false;
        }
    }

    public function getById(int $id): ?User
    {
        try {
            $conn = $this->db->getConnection();
            $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
            $userData = $stmt->fetch(\PDO::FETCH_ASSOC);

            $conn = null;

            if ($userData) {
                return new User(
                    $userData['id'],
                    $userData['username'],
                    $userData['password'],
                    $userData['role']
                );
            }
            return null;
        } catch (\Exception $ex) {
            error_log($ex->getMessage());
            return null;
        }
    }

    public function update(User $user): bool
    {
        try {                
            if ($user->getPassword() != null) {
                $user->setPassword($this->getHashedPassword($user->getPassword()));
                $sql = "UPDATE users SET username = :username, password = :password, role = :role WHERE id = :id";
            } else {
                $sql = "UPDATE users SET username = :username, role = :role WHERE id = :id";
            }
            $username = $user->getUsername();
            $role = $user->getRole();
            $id = $user->getId();

            $conn = $this->db->getConnection();
            $stmt = $conn->prepare($sql);    
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
    
            if ($user->getPassword() != null) {
                $password = $user->getPassword();
                $stmt->bindParam(':password', $password);
            }
            $result = $stmt->execute();    
            
            $conn = null;
            return $result;
        } catch (\Exception $ex) {
            error_log($ex->getMessage());
            return false;
        }
    }
    

    public function delete(int $id): bool
    {
        try {
            $conn = $this->db->getConnection();
            $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $result = $stmt->execute();

            $conn = null;
            return $result;
        } catch (\Exception $ex) {
            error_log($ex->getMessage());
            return false;
        }
    }

    public function getAll(): array
    {
        try {
            $conn = $this->db->getConnection();
            $stmt = $conn->prepare("SELECT * FROM users");
            $stmt->execute();
            $usersData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $conn = null;

            $users = [];
            foreach ($usersData as $userData) {
                $users[] = new User(
                    $userData['id'],
                    $userData['username'],
                    $userData['password'],
                    $userData['role']
                );
            }
            return $users;
        } catch (\Exception $ex) {
            error_log($ex->getMessage());
            return [];
        }
    }

    public function login(string $username, string $password) : bool {
        try {
            $conn = $this->db->getConnection();
            
            $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $userData = $stmt->fetch(\PDO::FETCH_ASSOC);
            $conn = null;

            if ($userData) {
                if (password_verify($password, $userData['password'])) {
                    $_SESSION['user_id'] = $userData['id'];
                    $_SESSION['username'] = $userData['username'];
                    $_SESSION['role'] = $userData['role'];
                    return true;
                }
            }
            return false;

        } catch (\Exception $ex) {
            error_log($ex->getMessage());
            return false;
        }
    }

    public function logout(): void {
        session_unset();
        session_destroy();
    }

    private function getHashedPassword(?string $password): ?string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
