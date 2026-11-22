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
if(isset($_POST["up"])){
    $itemID = $_POST["ItemID"];
    $userID = $_SESSION["UserID"];
    $iname=$_POST["ItemName"];
    $category=$_POST["category"];
    $location=$_POST["location"];
    $datelost=$_POST["datelost"];
    $description=$_POST["description"];
    try {
    $item = $itemModel->ViewById($itemID);

    if (!$item) {
        exit("Item not found.");
    }

    if ($item["UserID"] != $userID || $item["ReportType"] !== "Lost") {
        exit("You are not authorized to update this item.");
    }

$fileNameNew = NULL;
if (isset($_FILES["item_photo"])) {
    if ($_FILES["item_photo"]["error"] === UPLOAD_ERR_NO_FILE) {
    $fileNameNew = $item["Photo"];

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
    }else {
    $fileNameNew = NULL;
}
if ($message === "") {
        
        $result = $itemModel->updatereport(
            $iname,
            $category,
            $location,
            $datelost,
            $description,
            $fileNameNew,
            $userID,
            $itemID
        );
    
        header("Location: my-reports.php?uploadsuccess");
        exit();
    }
    } catch (PDOException $e) {
        $message = "Database error: " . $e->getMessage();
    
}
}
?> 