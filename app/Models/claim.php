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
                   user.fullname 
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
            $sql="UPDATE claim SET Status=? WHERE ClaimID=?";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([
                $status,
                $claimID
            ]);
            return "Updated Successfully";
        }
    }