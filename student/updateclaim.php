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
if(isset($_POST["up"])){
    $claimID = $_POST["ClaimID"];
    $userID = $_SESSION["UserID"];
    $description=$_POST["description"];
    try {
        $item = $claimModel->ViewClaimById($claimID);

        if (!$item) {
            exit("Item not found.");
        }

$fileNameNew = $item["PhotoClaim"];
if (isset($_FILES["item_photo"])) {
    if ($_FILES["item_photo"]["error"] === UPLOAD_ERR_NO_FILE) {
    $fileNameNew = $item["PhotoClaim"];

    }elseif ($_FILES["item_photo"]["error"] === UPLOAD_ERR_OK) {

    $fileName=$_FILES["item_photo"]["name"];
    $fileTmpName=$_FILES["item_photo"]["tmp_name"];
    $fileSize=$_FILES["item_photo"]["size"];

    $fileExt =  explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'jfif');

    if (!in_array($fileActualExt, $allowed)) {
        $message = "You cannot upload this file type!";

    } elseif ($fileSize > 5000000) {
        $message = "Your file is too big!";

    } else {
        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
        $fileDestination = __DIR__ . '/../pictures/' . $fileNameNew;

        if (!move_uploaded_file($fileTmpName, $fileDestination)) {
            $message = "Failed to upload the photo!";
        }
    }
    } else {
        $message = "There was an error uploading the photo!";
    }
    }
if ($message === "") {
        
        $item = $claimModel->updateclaim(
            $description,
            $fileNameNew,
            $userID,
            $claimID
        );
        
        header("Location: my-claim.php?uploadsuccess");
        exit();
    }
    } catch (PDOException $e) {
        $message = "Database error: " . $e->getMessage();
    
}
}
?> 