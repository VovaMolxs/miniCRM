<?php

namespace App\Models\roles;

use Core\Db\Database;
use PDO;
use PDOException;

class Role
{
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        try {
            $result = $this->db->query("SELECT 1 FROM roles LIMIT 1");
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

        try {
            $this->db->exec($roleTableQuery);
            return true;
        } catch (PDOException $exception) {
            return false;
        }
    }

    public function getAllRoles() {
        try {
            $query = "SELECT * FROM roles";
            $stmt = $this->db->query($query);
            $roles = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $roles[] = $row;
            }
            return $roles;
        } catch (PDOException $exception) {
            return false;
        }
    }

    public function getRoleById($id) {
        try {
            $query = "SELECT * FROM roles WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $role = $stmt->fetch(PDO::FETCH_ASSOC);
            return $role ? $role : false;
        } catch (PDOException $exception) {
            return false;
        }
    }

    public function createRole($role_name, $role_description) {
        try {
            $query = "INSERT INTO roles (role_name, role_description) VALUES (?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$role_name, $role_description]);
            return true;
        } catch (PDOException $exception) {
            return false;
        }
    }

    public function updateRole($role_name, $role_description, $id) {
        try {
            $query = "UPDATE roles SET role_name = ?, role_description = ? WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$role_name, $role_description, $id]);
            return true;
        } catch (PDOException $exception) {
            return false;
        }
    }

    public function deleteRole($id) {
        try {
            $query = "DELETE FROM roles WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $exception) {
            return false;
        }
    }
}