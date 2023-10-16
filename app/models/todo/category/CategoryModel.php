<?php

namespace App\Models\todo\category;

use App\Contracts\Model;
use Core\Db\Database;
use PDO;
use PDOException;

class CategoryModel implements Model
{
    private $db;
    private $user_id;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        $this->user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        try {
            $result = $this->db->query("SELECT 1 FROM todo_category LIMIT 1");
        } catch (PDOException $exception) {
            $this->createTable();
        }
    }

    public function createTable() {
        $todoCategoryTableQuery = "CREATE TABLE IF NOT EXISTS `todo_category` (
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `title` VARCHAR(255) NOT NULL,
            `description` TEXT,
            `usability` TINYINT DEFAULT 1,
            `user` INT NOT NULL,
            FOREIGN KEY (user)  REFERENCES users(id) ON DELETE CASCADE
        )";

        try {
            $this->db->exec($todoCategoryTableQuery);
            return true;
        } catch (PDOException $exception) {
            return false;
        }
    }

    public function getAllCategory() {
        try {
            $query = "SELECT * FROM todo_category WHERE user = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$this->user_id]);
            $todo_category = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $todo_category[] = $row;
            }
            return $todo_category;
        } catch (PDOException $exception) {
            return false;
        }
    }
    //внутри создания tasks
    public function getAllCategoryWithUsability() {
        try {
            $query = "SELECT * FROM todo_category WHERE user = ? AND usability = 1";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$this->user_id]);
            $todo_category = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $todo_category[] = $row;
            }
            return $todo_category;
        } catch (PDOException $exception) {
            return false;
        }
    }

    public function createCategory($title, $description, $user_id) {
        try {
            $query = "INSERT INTO todo_category (title, description, user) VALUES (?,?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $description, $user_id]);
            return true;
        } catch (PDOException $exception) {
            return false;
        }
    }



    public function getCategoryId() {
        try {
            $query = "SELECT * FROM todo_category WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$this->user_id]);
            $category = $stmt->fetch(PDO::FETCH_ASSOC);
            return $category ? $category : false;
        } catch (PDOException $exception) {
            return false;
        }
    }

    public function updateCategory($title, $description, $usability, $id) {

        try {
            $query = "UPDATE todo_category SET title = ?, description = ?, usability = ? WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $description, $usability, $id]);
            return true;
        } catch (PDOException $exception) {
            return false;
        }
    }

    public function deleteCategory($id) {
        try {
            $query = "DELETE FROM todo_category WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $exception) {
            return false;
        }
    }
}