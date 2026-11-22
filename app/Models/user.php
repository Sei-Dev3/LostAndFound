<?php
    namespace App\Models;
    use App\Database;
    use PDO;
    class User{
        private $conn;

        public function __construct(){
            $database=new Database();
            $this->conn=$database->connection();
        }

        public function getAllUsers(){
            $sql="SELECT * 
            FROM user";   
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $item=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $item;
        }

        public function ViewUserById($userID){
            $sql="SELECT * FROM user WHERE UserID = ?";     
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(["$userID"]);
            $user=$stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        }

        public function getByRoles($user){
            $sql="SELECT *   
            FROM user
            WHERE user.role = ?
            ORDER BY user.UserID DESC";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([$user]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function countuser(){
            $sql= "SELECT COUNT(*) AS total FROM user";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }