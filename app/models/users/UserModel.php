<?php
namespace App\Models\users;

use App\Contracts\Model;
use Core\Db\Database;
use PDO;
use PDOException;

class UserModel implements Model
{
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        try {
            $result = $this->db->query("SELECT 1 FROM users LIMIT 1");
        } catch (PDOException $exception) {
            $this->createTable();
        }
    }

    public function createTable() {
        $roleTableQuery = "CREATE TABLE IF NOT EXISTS `roles` (
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `role_name` VARCHAR(255) NOT NULL,
            `role_description` TEXT
        )";
        $userTableQuery = "CREATE TABLE IF NOT EXISTS `users` ( 
            `id` INT(11) NOT NULL AUTO_INCREMENT, 
            `username` VARCHAR(255) NOT NULL, 
            `email` VARCHAR(255) NOT NULL,
            `email_verification` TINYINT(1) NOT NULL DEFAULT 0,
            `password` VARCHAR(255) NOT NULL,
            `is_admin` TINYINT(1) NOT NULL DEFAULT 0,
            `role` INT(11) NOT NULL DEFAULT 1,
            `is_active` TINYINT(1) NOT NULL DEFAULT 1,
            `last_login` TIMESTAMP NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            FOREIGN KEY (`role`) REFERENCES `roles` (`id`)
        )";

        try {
            $this->db->exec($roleTableQuery);
            $this->db->exec($userTableQuery);
            return true;
        } catch (PDOException $exception) {
            return false;
        }
    }

    public function getAll() {
        try {
            $stmt = $this->db->query("SELECT * FROM users");
            $users = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $users[] = $row;
            }
        } catch (PDOException $exception) {
            return false;
        }

        return $users;
    }

    public function create($data) {
        $username = $data['username'];
        $password = $data['password'];
        $email = $data['email'];
        $role = $data['role'];
        $created_at = date('Y-m-d H:i:s');

        $query = "INSERT INTO users (username, email, password, role, created_at) VALUE (?,?,?,?,?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT), $role, $created_at]);
            return true;
        } catch (PDOException $exception) {
            return false;
        }

    }

    public function delete($id) {
        $query = "DELETE FROM users WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $exception) {
            return false;
        }

    }

    public function update($data) {
        $id = $data['id'];
        $login = $data['username'];
        $email = $data['email'];
        $role = $data['role'];
        $is_active = isset($data['is_active']) ? 1 : 0;

        $query = "UPDATE users SET username = ?, email = ?, role = ?, is_active = ? WHERE id = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$login, $email, $role, $is_active, $id]);
            return true;
        } catch (PDOException $exception) {
            return false;
        }
    }

    public function read($id) {
        try {
            $query = 'SELECT * FROM users WHERE id = ?';
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user ? $user : false;
        } catch (PDOException $exception) {
            return false;
        }
    }

}