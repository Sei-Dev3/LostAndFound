<?php 
    session_start();

if (!isset($_SESSION["email"])) {
    header("Location: ../auth/login.php");
    exit();
}

require_once __DIR__. '/../vendor/autoload.php';
use App\Models\Item;
$message="";
$itemModel=new Item();

if(isset($_GET["id"])){
    $itemID=$_GET["id"];
    $userID = $_SESSION["UserID"];
    try{
        echo $itemModel->delete($itemID, $userID);
        header("Location: my-reports.php");
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>