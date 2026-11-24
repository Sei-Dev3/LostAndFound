<?php 
    session_start();

if (!isset($_SESSION["email"])) {
     header("Location: ../auth/admin-login.php");
    exit();
}

require_once __DIR__. '/../vendor/autoload.php';
use App\Models\Claim;
$claimModel = new Claim();
if(isset($_GET["id"])){
    $itemID=$_GET["id"];
    try{
        echo $claimModel->deleteclaim($itemID);
        header("Location: Dashboard.php");
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>