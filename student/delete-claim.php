<?php 
    session_start();

if (!isset($_SESSION["email"])) {
    header("Location: ../auth/login.php");
    exit();
}

require_once __DIR__. '/../vendor/autoload.php';
use App\Models\Claim;
$message="";
$claimModel=new Claim();

if(isset($_GET["id"])){
    $claimID=$_GET["id"];
    try{
        echo $claimModel->deleteclaim($claimID);
        header("Location: my-claim.php");
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>