<?php
namespace App\Models;

use App\Database;
use PDO;

class Category {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connection();
    }

    public function getAll() {
        $sql = "SELECT * FROM category ORDER BY CategoryID ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCategory($categoryName) {
        $sql = "INSERT INTO category (CategoryName) VALUES (?)";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([$categoryName]);
    }

    public function getById($id) {
        $sql = "SELECT * FROM category WHERE CategoryID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateCategory($id, $categoryName) {
        $sql = "UPDATE category SET CategoryName = ? WHERE CategoryID = ?";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([$categoryName, $id]);
    }

    public function deleteCategory($id) {
        $sql = "DELETE FROM category WHERE CategoryID = ?";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([$id]);
    }
}