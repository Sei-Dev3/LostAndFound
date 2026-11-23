<?php 
    session_start();

if (!isset($_SESSION["email"])) {
     header("Location: ../auth/admin-login.php");
    exit();
}

require_once __DIR__. '/../vendor/autoload.php';
use App\Models\User;
$message="";
$itemModel=new User();

if(isset($_GET["id"])){
    $userID = (int) $_GET["id"];
    try{
        echo $itemModel->delete($userID);
        header("Location: manage-users.php");
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>