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
            ON item.LocationID = location.LocationID
            ORDER BY ItemID DESC";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $item=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $item;
        }
           // ==================================
        // HASH TABLE IMPLEMENTATION
        // ==================================

        // Store item records using ItemID as the key
        public function getItemsHashTable(){
            $items = $this->getAll();
            $hashTable = [];
            foreach ($items as $item) {
                $hashTable[$item['ItemID']] = $item;
            }
            return $hashTable;
        }
        public function findItemHashTable($itemID){
            $hashTable = $this->getItemsHashTable();
            if (isset($hashTable[$itemID])) {
                return $hashTable[$itemID];
            }
            return null;
        }

        // ==================================
        // END OF HASH TABLE IMPLEMENTATION
        // ==================================


    // ==================================
    // BINARY SEARCH IMPLEMENTATION
    // ==================================

    public function binarySearchItem($itemID) {
        $items = $this->getAll();
        $low = 0;
        $high = count($items) - 1;

        $targetID = (int)$itemID;
        while ($low <= $high) {
            $mid = (int)(($low + $high) / 2);
            $currentID = (int)$items[$mid]['ItemID'];
            if ($currentID === $targetID) {
                return $items[$mid];
            }
            if ($targetID > $currentID) {
                $high = $mid - 1;
            } else {
                $low = $mid + 1;
            }
        }
        return null;
    }

    // ==================================
    // END OF BINARY SEARCH IMPLEMENTATION
    // ==================================


// ==================================
// INSERTION SORT IMPLEMENTATION
// ==================================

public function insertionSortItems($sortBy = 'ItemID', $order = 'DESC') {
    $items = $this->getAll();
    $allowedFields = ['ItemID', 'ItemName', 'DateLost', 'DateFound'];

    if (!in_array($sortBy, $allowedFields, true)) {
        $sortBy = 'ItemID';
    }
    $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';

    for ($i = 1; $i < count($items); $i++) {
        $key = $items[$i];
        $j = $i - 1;
        while ($j >= 0) {
            $currentValue = $items[$j][$sortBy] ?? '';
            $keyValue = $key[$sortBy] ?? '';
            if (is_numeric($currentValue) && is_numeric($keyValue)) {
                $comparison = $currentValue <=> $keyValue;
            } else {
                $comparison = strcasecmp(
                    (string)$currentValue,
                    (string)$keyValue
                );
            }
            $shouldShift = ($order === 'ASC')
                ? ($comparison > 0)
                : ($comparison < 0);

            if (!$shouldShift) {
                break;
            }
            $items[$j + 1] = $items[$j];
            $j--;
        }
        $items[$j + 1] = $key;
    }
    return $items;
}

// ==================================
// END OF INSERTION SORT IMPLEMENTATION
// ==================================


        public function insert($iname, $category, $location, $description, $fileName, $userID){
            $datelost = date("Y-m-d H:i:s");
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
            $stmt->execute([$id]);
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
        public function countfound(){
            $sql= "SELECT COUNT(*) AS total FROM item
            WHERE ReportType = 'Found'";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function countreturn($userID = null){
            $sql= "SELECT COUNT(*) AS total FROM item
            WHERE Status = 'Returned'";
            if ($userID !== null) {
                $sql .= " AND UserID = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$userID]);
            } else {
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
            }
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function countavailable(){
            $sql= "SELECT COUNT(*) AS total FROM item
            WHERE Status = 'Available'";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function countstatuslost($userID){
            $sql= "SELECT COUNT(*) AS total FROM item
            WHERE Status = 'Lost'
            AND UserID = ?";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([$userID]);
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
        public function personalcountfound($userID){
            $sql= "SELECT COUNT(*) AS total FROM item
            WHERE ReportType = 'Found'
            AND UserID = :userID";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([':userID' => $userID]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function founditem($iname, $category, $location, $description, $fileName, $userID){
            $datefound = date("Y-m-d H:i:s");
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

        public function deleteAdmin($itemID){
            $sql = "DELETE FROM item WHERE ItemID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$itemID]);
            return "Deleted Successfully";
}

        public function search($search, $userID){
            $sql="SELECT item.*,
                    item.Status AS ItemStatus,
                    category.CategoryName,
                    location.LocationName
            FROM item
            INNER JOIN category
            ON item.CategoryID = category.CategoryID
            INNER JOIN location
            ON item.LocationID = location.LocationID
            WHERE item.ItemName LIKE ?
            AND item.UserID = ?
            ORDER BY item.ItemID DESC";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(["%$search%", $userID]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function searchPublic($search){
            $sql = "SELECT item.*,
                    item.Status AS ItemStatus,
                    category.CategoryName,
                    location.LocationName
            FROM item
            INNER JOIN category ON item.CategoryID = category.CategoryID
            INNER JOIN location ON item.LocationID = location.LocationID
             WHERE item.ItemName LIKE ?
            ORDER BY item.ItemID DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["%$search%"]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function linearSearch($items, $search) {
            $results = [];
            foreach ($items as $item) {
                if (stripos($item["ItemName"], $search) !== false) {
                    $results[] = $item;
                }
            }
            return $results;
        }

        public function updatestatus($itemID, $status){
            $sql = "UPDATE item
            SET Status = ?
            WHERE ItemID = ?
            AND ReportType IN ('Lost', 'Found')";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([
                $status,
                $itemID
            ]);
            return "Updated Successfully";
        }

        public function getAllCategory($categoryID){
            $sql="SELECT item.*,
                   item.Status AS ItemStatus,
                   category.CategoryName,
                   location.LocationName
            FROM item
            INNER JOIN category
            ON item.CategoryID = category.CategoryID
            INNER JOIN location
            ON item.LocationID = location.LocationID
            WHERE item.CategoryID = ?
            ORDER BY item.ItemID DESC";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([$categoryID]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getByStatus($status){
            $sql="SELECT item.*,
                   item.Status AS ItemStatus,
                   category.CategoryName,
                   location.LocationName
            FROM item
             INNER JOIN category
                ON item.CategoryID = category.CategoryID
            INNER JOIN location
                ON item.LocationID = location.LocationID
            WHERE item.Status = ?
            ORDER BY item.ItemID DESC";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([$status]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
       
        public function getbyrecentitem($reportType){
            $sql="SELECT * FROM item
            WHERE item.ReportType = ?
            ORDER BY item.ItemID DESC
            LIMIT 1";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([$reportType]);
            return $stmt->fetch(PDO::FETCH_ASSOC);

        }
    }