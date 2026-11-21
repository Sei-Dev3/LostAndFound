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
            $sql="SELECT item.*, 
            item.Status AS ItemStatus,
                   category.CategoryName,
                   location.LocationName
            FROM item
            INNER JOIN category
            ON item.CategoryID = category.CategoryID
            INNER JOIN location
            ON item.LocationID = location.LocationID";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $item=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $item;
        }
        public function insert($iname, $category, $location, $datelost, $description, $fileName, $userID){
            $sql="INSERT INTO item(ItemName, CategoryID, LocationID, DateLost, Description, Photo, UserID,ReportType,Status)
                  VALUES(?,?,?,?,?,?,?,'Lost','Lost')";
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
            $sql="SELECT * 
            FROM item
            INNER JOIN category
            ON item.CategoryID = Category.CategoryID
            INNER JOIN location
            ON item.locationID = location.LocationID
            WHERE item.ItemID=?";     
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(["$id"]);
            $item=$stmt->fetch(PDO::FETCH_ASSOC);   
            return $item;
        }

        public function countlost(){
            $sql= "SELECT COUNT(*) AS total FROM item
            WHERE ReportType = 'Lost'";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function myreport($userID){
            $sql="SELECT *
            FROM item
            INNER JOIN category ON item.CategoryID = category.CategoryID
            INNER JOIN location ON item.LocationID = location.LocationID
            WHERE item.UserID = :userID
            AND item.ReportType = 'Lost'
            ORDER BY ItemID DESC";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([':userID' => $userID]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function personalcountreport($userID){
            $sql= "SELECT COUNT(*) AS total FROM item
            WHERE ReportType = 'Lost'
            AND UserID = :userID";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([':userID' => $userID]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function founditem($iname, $category, $location, $datefound, $description, $fileName, $userID){
            $sql="INSERT INTO item(ItemName, CategoryID, LocationID, DateFound, Description, Photo, UserID, ReportType,Status)
                  VALUES(?,?,?,?,?,?,?,'Found','Available')";
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
            $sql= "SELECT COUNT(*) AS total FROM item
            WHERE ReportType = 'Found'";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function updatereport($iname, $category, $location, $datelost, $description, $fileName, $userID, $itemID) {
            $sql = "UPDATE item
            SET ItemName=?, CategoryID=?, LocationID=?,
            DateLost=?, Description=?, Photo=?
            WHERE UserID=? AND ItemID=? AND ReportType='Lost'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                $iname,
                $category,
                $location,
                $datelost,
                $description,
                $fileName,
                $userID,
                $itemID
            ]);

    return $stmt->rowCount();
}

        public function updatefound($iname, $category, $location, $datefound, $description, $fileName, $userID, $itemID) {
            $sql = "UPDATE item
            SET ItemName=?, CategoryID=?, LocationID=?,
            DateFound=?, Description=?, Photo=?
            WHERE UserID=? AND ItemID=? AND ReportType='Found'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                $iname,
                $category,
                $location,
                $datefound,
                $description,
                $fileName,
                $userID,
                $itemID
            ]);

    return $stmt->rowCount();
}


        public function delete($itemID, $userID){
            $sql="DELETE FROM item WHERE ItemID=? AND UserID = ?
            AND ReportType = 'Lost'";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([$itemID, $userID]);
             return "Deleted Successfully";
        
        }

        public function search($search){
            $sql="SELECT *
            FROM item
            INNER JOIN category
            ON item.CategoryID = category.CategoryID
            INNER JOIN location
            ON item.LocationID = location.LocationID
            WHERE item.ItemName LIKE ?
            ORDER BY item.ItemID DESC";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(["%$search%"]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function updatestatus($itemID, $status){
            $sql="UPDATE item SET Status=? WHERE itemID=?";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([
                $status,
                $itemID
            ]);
            return "Updated Successfully";
        }
       
    }