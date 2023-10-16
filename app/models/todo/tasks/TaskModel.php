<?php

namespace App\Models\todo\tasks;

use App\Contracts\Model;
use Core\Db\Database;
use PDO;
use PDOException;

class TaskModel implements Model
{
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        try {
            $result = $this->db->query("SELECT 1 FROM todo_tasks LIMIT 1");
        } catch (PDOException $exception) {
            $this->createTable();
        }
    }

    public function createTable() {
        $todoTasksTableQuery = "CREATE TABLE IF NOT EXISTS `todo_tasks` (
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `user_id` INTEGER NOT NULL,
            `title` VARCHAR(255) NOT NULL,
            `description` TEXT,
            `category_id` INT NOT NULL,
            `status` ENUM('new', 'in_progress', 'completed', 'on_hold', 'cancelled') NOT NULL,
            `priority` ENUM('low', 'medium', 'high', 'urgent'),
            `assigned_to` INT,    
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            `finish_at` DATETIME,
            `completed_at` DATETIME,
            `remider_at` DATETIME,
            FOREIGN KEY (user_id)  REFERENCES users(id) ON DELETE CASCADE,
            FOREIGN KEY (category_id)  REFERENCES todo_category(id) ON DELETE RESTRICT,
            FOREIGN KEY (assigned_to)  REFERENCES users(id) ON DELETE SET NULL
        )";

        try {
            $this->db->exec($todoTasksTableQuery);
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function getAllTasks() {
        try {
            $stmt = $this->db->query("SELECT * FROM todo_tasks");
            $todo_tasks = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $todo_tasks[] = $row;
            }
            return $todo_tasks;

        } catch (PDOException $exception) {
            return false;
        }
    }

    public function createTask(array $data) {
        try {

            $query = "INSERT INTO todo_tasks (user_id, title, category_id, status, priority, finish_at) VALUES (?,?,?,?,?,?)";
            $stmt = $this->db->prepare($query);

            $stmt->execute([$data['user_id'], $data['title'], $data['category_id'], $data['status'], $data['priority'], $data['finish_at']]);

            return true;
        } catch (PDOException $exception) {
            return false;
        }
    }

    public function getTaskId($id) {
        try {
            $query = "SELECT * FROM todo_tasks WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $task = $stmt->fetch(PDO::FETCH_ASSOC);
            return $task ? $task : false;

        } catch (PDOException $exception) {
            return false;
        }
    }

    public function updateTask() {

    }

    public function deleteTask($id) {
        try {
            $query = "DELETE FROM todo_tasks WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;

        } catch (PDOException $exception) {
            return false;
        }
    }


}