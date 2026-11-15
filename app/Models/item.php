<?php
    namespace App\Models;
    use App\Database;
    use PDO;
    class Item{
        private $conn;

        public function __construct(){
            $database=new Database();
            $this->conn=$database->connection();
        }
        public function getAll(){
            $sql="SELECT * 
            FROM items
            INNER JOIN category
            ON items.CategoryID = category.CategoryID
            INNER JOIN locations
            ON items.LocationID = locations.LocationID";
            
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $item=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $item;
        }
        public function insert($iname, $category, $location, $datelost, $description, $fileName, $userID){
            $sql="INSERT INTO items(ItemName, CategoryID, LocationID, DateLost, Description, Photo, UserID,ReportType)
                  VALUES(?,?,?,?,?,?,'Lost')";
                  $stmt=$this->conn->prepare($sql);
                  $stmt->execute([
                    $iname,
                    $category,
                    $location,
                    $datelost,
                    $description,
                    $fileName,
                    $userID
                  ]);
                  return "Item addded successfully";
        }
        public function ViewById($id){
            $sql="SELECT * FROM items
            INNER JOIN category
            ON items.CategoryID = Category.CategoryID
            INNER JOIN locations
            ON items.locationID = locations.LocationID
            WHERE items.ItemID=?";     
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(["$id"]);
            $item=$stmt->fetch(PDO::FETCH_ASSOC);
            return $item;
        }

        public function countlost(){
            $sql= "SELECT COUNT(*) AS total FROM items
            WHERE ReportType = 'Lost'";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function myreport($userID){
            $sql="SELECT * FROM items
            INNER JOIN category
            ON items.CategoryID = Category.CategoryID
            WHERE UserID = :userID
            ORDER BY ItemID DESC";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([':userID' => $userID]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function personalcountreport($userID){
            $sql= "SELECT COUNT(*) AS total FROM items
            WHERE ReportType = 'Lost'
            AND UserID = :userID";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([':userID' => $userID]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function founditem($iname, $category, $location, $datefound, $description, $fileName, $userID){
            $sql="INSERT INTO items(ItemName, CategoryID, LocationID, DateFound, Description, Photo, UserID, ReportType)
                  VALUES(?,?,?,?,?,?,?,'Found')";
                  $stmt=$this->conn->prepare($sql);
                  $stmt->execute([
                    $iname,
                    $category,
                    $location,
                    $datefound,
                    $description,
                    $fileName,
                    $userID
                  ]);
                  return "Item addded successfully";
        }
        public function countfound(){
            $sql= "SELECT COUNT(*) AS total FROM items
            WHERE ReportType = 'Found'";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function getAllUsers(){
            $sql="SELECT * 
            FROM users";
            
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $item=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $item;
        }
        public function claimitem($description, $fileName, $userID, $itemID){
            $sql="INSERT INTO claims(ClaimDetails, Photo, UserID, ItemID)
                  VALUES(?,?,?,?)";
                  $stmt=$this->conn->prepare($sql);
                  $stmt->execute([
                    $description,
                    $fileName,
                    $userID,
                    $itemID
                  ]);
                  return "Item addded successfully";
        }
        public function getAllclaim(){
            $sql="SELECT * 
            FROM claims
            INNER JOIN items
            ON claims.ItemID = items.ItemID
            INNER JOIN users
            ON claims.UserID = users.UserID";
            
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $item=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $item;
        }
        public function myclaim($userID){
            $sql="SELECT * FROM claims
            INNER JOIN items
            ON claims.ItemID = items.ItemID
            INNER JOIN category
            ON items.CategoryID = category.CategoryID
            WHERE claims.UserID = :userID
            ORDER BY ClaimID DESC";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([':userID' => $userID]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }