<?php 
namespace App\Models;
use App\Database;

class Authentication{
    private $conn;
    public function __construct(){
        $database = new Database();
        $this->conn=$database->connection();
    }
    public function signup($fullname, $email, $password, $confirmpassword){
        if($password !== $confirmpassword){
        return "Password does not match";
    }
        $hashPass=password_hash($password, PASSWORD_DEFAULT);
        $sql="INSERT INTO user(fullname, email, password_hash) VALUES(?,?,?)";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute([
            $fullname,
            $email,
            $hashPass
        ]);
        return "Account created successfully!";

        }

    public function login($email, $password){
        $sql="SELECT * FROM user WHERE email=?";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute([$email]);
        $user=$stmt->fetch();

        if($user && password_verify($password,$user["password_hash"])){
            return $user;
        }else{
            return false;
        }
    }
}


?>