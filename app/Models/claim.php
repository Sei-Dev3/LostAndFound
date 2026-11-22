<?php
    namespace App\Models;
    use App\Database;
    use PDO;
    class Claim{
        private $conn;

        public function __construct(){
            $database=new Database();
            $this->conn=$database->connection();
        }
        public function claimitem($description, $fileName, $userID, $itemID){
            $sql="INSERT INTO claim(ClaimDetails, PhotoClaim, UserID, ItemID)
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
            $sql="SELECT claim.*,
            claim.Status AS ClaimStatus,
                   item.ItemName,
                   item.Photo,
                   item.ReportType,
                   user.fullname, 
                   item.DateFound,
                   item.DateLost
            FROM claim
            INNER JOIN item
            ON claim.ItemID = item.ItemID
            INNER JOIN user
            ON claim.UserID = user.UserID";
            
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $item=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $item;
        }

    public function ViewClaimById($id){
        $sql = "SELECT claim.*, user.fullname AS ClaimantName
            FROM claim
            INNER JOIN user ON claim.UserID = user.UserID
            WHERE claim.ClaimID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
        
        public function myclaim($userID){
            $sql="SELECT claim.*, 
            claim.Status AS ClaimStatus,
                   item.ItemName,
                   item.Photo,
                   item.ReportType,
                   category.CategoryName
            FROM claim
            INNER JOIN item
            ON claim.ItemID = item.ItemID
            INNER JOIN category
            ON item.CategoryID = category.CategoryID
            WHERE claim.UserID = :userID
            ORDER BY ClaimID DESC";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([':userID' => $userID]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function hasClaimed($itemID, $userID) {
            $sql = "SELECT COUNT(*) 
            FROM claim 
            WHERE ItemID = ? AND UserID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$itemID, $userID]);
            return $stmt->fetchColumn() > 0;
}

        public function updateclaim($description, $fileName, $userID, $claimID){
            $sql="UPDATE claim SET ClaimDetails=?, PhotoClaim=? WHERE UserID=? AND ClaimID=?";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([
                $description,
                $fileName,
                $userID,
                $claimID
            ]);
            return "Updated Successfully";
        }

        public function deleteclaim($claimID){
            $sql="DELETE FROM claim WHERE ClaimID=?";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([$claimID]);
             return "Deleted Successfully";
        
        }

        public function updatestatus($claimID, $status){
            $sql="UPDATE claim SET Status=?, ClaimDate = ? 
            WHERE ClaimID=?";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([
                $status,
                date("Y-m-d H:i:s"),
                $claimID
            ]);
            return "Updated Successfully";
        }

        public function getByStatus($userID, $status){
            $sql="SELECT claim.*,
                   claim.Status AS ClaimStatus,
                   item.ItemName,
                   item.ReportType,
                   user.fullname,
                   category.CategoryName
            FROM claim
            INNER JOIN item
            ON claim.ItemID = item.ItemID
            INNER JOIN category
            ON item.CategoryID = category.CategoryID
            INNER JOIN `user`
                ON claim.UserID = `user`.UserID
            WHERE claim.UserID = ?
            AND claim.Status = ?
            ORDER BY claim.ClaimID DESC";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([$userID, $status]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function search($search, $userID){
            $sql="SELECT claim.*,
                    claim.Status AS ClaimStatus,
                    item.ItemName,
                    item.Photo,
                    item.ReportType,
                    user.fullname,
                    category.CategoryName
            FROM claim
            INNER JOIN user
                ON claim.UserID = user.UserID
            INNER JOIN item
            ON claim.ItemID = item.ItemID
            INNER JOIN category
            ON item.CategoryID = category.CategoryID
            WHERE item.ItemName LIKE ?
            AND claim.UserID = ?
            ORDER BY claim.ItemID DESC";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(["%$search%", $userID]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function personalcountreportclaim($userID = null){
            $sql= "SELECT COUNT(*) AS total FROM claim";
           if ($userID !== null) {
                $sql .= " WHERE UserID = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$userID]);
            } else {
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
            }
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function countpending($userID = null){
            $sql= "SELECT COUNT(*) AS total FROM claim
            WHERE Status = 'Pending'";
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
        public function countapprove($userID = null){
            $sql= "SELECT COUNT(*) AS total FROM claim
            WHERE Status = 'Approved'";
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

        public function countVerification($userID){
            $sql= "SELECT COUNT(*) AS total FROM claim
            WHERE Status = 'Manual Verification'
            AND UserID = :userID";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([':userID' => $userID]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function getbyrecentclaim($status){
            $sql="SELECT * FROM claim
            WHERE claim.Status = ?
            ORDER BY claim.ClaimID DESC
            LIMIT 1";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([$status]);
            return $stmt->fetch(PDO::FETCH_ASSOC);

        }
    }