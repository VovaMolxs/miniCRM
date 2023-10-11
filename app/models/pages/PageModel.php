<?php

namespace App\Models\pages;

use App\Contracts\Model;
use Core\Db\Database;
use PDO;
use PDOException;

class PageModel implements Model
{
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        try {
            $result = $this->db->query("SELECT 1 FROM `pages` LIMIT 1");
        } catch (PDOException $exception) {
            $this->createTable();
        }
    }


    public function createTable()
    {
        $roleTableQuery = "CREATE TABLE IF NOT EXISTS `pages` (
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `title` VARCHAR(255) NOT NULL,
            `slug` VARCHAR(255) NOT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
        try {
            $this->db->exec($roleTableQuery);
            return true;
        } catch (PDOException $exception) {
            return false;
        }
    }

    public function getAllPages() {
        try {
            $query = "SELECT * FROM pages";
            $stmt = $this->db->query($query);
            $pages = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $pages[] = $row;
            }
            return $pages;
        } catch (PDOException $exception) {
            return false;
        }
    }

    public function getPageById($id) {
        try {
            $query = "SELECT * FROM pages WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $page = $stmt->fetch(PDO::FETCH_ASSOC);
            return $page ? $page : false;
        } catch (PDOException $exception) {
            return false;
        }
    }

    public function createPage($page_title, $page_slug) {
        try {
            $query = "INSERT INTO pages (title, slug) VALUES (?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$page_title, $page_slug]);
            return true;
        } catch (PDOException $exception) {
            return false;
        }
    }

    public function updatePage($page_title, $page_slug, $id) {
        try {
            $query = "UPDATE pages SET title = ?, slug = ? WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$page_title, $page_slug, $id]);
            return true;
        } catch (PDOException $exception) {
            return false;
        }
    }

    public function deletePage($id) {
        try {
            $query = "DELETE FROM pages WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $exception) {
            return false;
        }
    }

}