<?php
namespace App\Models;

use Core\Db\Database;
use PDO;
use PDOException;

class User
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
        $query = "CREATE TABLE IF NOT EXISTS `users` ( 
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
            `login` VARCHAR(255) NOT NULL, 
            `password` VARCHAR(255) NOT NULL, 
            `is_admin` TINYINT(1) NOT NULL DEFAULT 0, 
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

        try {
            $this->db->exec($query);
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
        $login = $data['login'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $admin = ($data['admin'] == 1) ? 1 : 0;
        $created_at = date('Y-m-d H:i:s');

        $query = "INSERT INTO users (login, password, is_admin, created_at) VALUE (?,?,?,?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$login, $password, $admin, $created_at]);
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
        $login = $data['login'];
        $admin = ($data['admin'] == 1) ? 1 : 0;

        $query = "UPDATE users SET login = ?, is_admin = ? WHERE id = ?";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$login, $admin, $id]);
            return true;
        } catch (PDOException $exception) {
            return false;
        }
    }

    public function read($id) {
        $query = 'SELECT * FROM users WHERE id = ?';

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $exception) {
            return false;
        }
    }

}