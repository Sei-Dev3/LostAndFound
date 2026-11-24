<?php
namespace App\Models;

use App\Database;
use PDO;

class Location {

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connection();
    }

    public function getAll() {
        $sql = "SELECT * FROM location ORDER BY LocationID ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addLocation($locationName) {
        $sql = "INSERT INTO location (LocationName) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$locationName]);
    }

    public function getById($locationID) {
        $sql = "SELECT * FROM location WHERE LocationID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$locationID]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateLocation($locationID, $locationName) {
        $sql = "UPDATE location SET LocationName = ? WHERE LocationID = ?";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $locationName,
            $locationID
        ]);
    }

    public function deleteLocation($locationID) {
        $sql = "DELETE FROM location WHERE LocationID = ?";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([$locationID]);
    }
}
?>