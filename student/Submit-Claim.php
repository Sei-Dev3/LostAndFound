<?php 
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: ../auth/login.php");
    exit();
}

require_once __DIR__. '/../vendor/autoload.php';
use App\Models\Claim;
use App\Models\Item;
$message ="";
$claimModel=new Claim();
$itemModel=new Item();
if(isset($_POST["sub"]) && (isset($_GET["id"]))){
    $id=$_GET["id"];
    $description=$_POST["description"];

$fileNameNew = NULL;
if (isset($_FILES["item_photo"])) {
    if ($_FILES["item_photo"]["error"]=== UPLOAD_ERR_NO_FILE) {
    $fileNameNew = NULL;

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
    try {
        $userID=$_SESSION["UserID"];
        if ($claimModel->hasClaimed($id, $userID)) {
            $message = "You have already submitted a claim for this item.";
        }else{
        $result = $claimModel->claimitem(
            $description,
            $fileNameNew,
            $userID,
            $id
        );
        
        header("Location: dashboard.php?uploadsuccess");
        exit();
        }
    } catch (PDOException $e) {
        $message = "Database error: " . $e->getMessage();
    }
}
}
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    try {
        $item = $itemModel->ViewById($id);
    } catch (PDOException $e) {
         $e->getMessage();
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/my-claim.css">
    <link rel="stylesheet" href="../css/manage-item.css">
    <link rel="stylesheet" href="../css/student-dashboard.css">
    <link rel="stylesheet" href="../css/style.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
>
</head>
<body>
    <div class="layout">
        <main class="dashboard-content">
            <div class="topbar1">
        <div class="topbar-action">
            <button type="button" class="notification">
                    <i class="fa-solid fa-bell"></i>
                    <!-- <span class="notification-badge">3</span> -->
                    </button>
                <button type="button" class="circle-profile">
</button>
</div>
</div>
        <div class="view-item">
        <a href="dashboard.php" class="view">← Back</a>
</div>
    
<form method="POST" enctype="multipart/form-data">
        <div class="fillout">
            <div class="item-details-container">
                <div class="navbar-title">
                    <h2>Item Details</h2>
                    </div>
                    <div class="info-layout">
                    <div class="photo">
                        <?php
                             if(!empty($item["Photo"])){?>
                             <img src="../pictures/<?php echo htmlspecialchars($item["Photo"]) ?>"
                                    alt="Item Photo" width="60">
                            <?php } else { ?>
                             <h1>No image</h1>
                        <?php } ?>
                    </div>
                    <div class="item-info">
                    <p>Item Name:<?php echo $item["ItemName"]?> </p>
                    <p>Category: <?php echo $item["CategoryName"]?></p>
                    <p>Location Found: <?php echo $item["LocationName"]?></p>
                    <p>Date Found: <?php echo $item["DateFound"]?></p>
</div>
</div>
            </div>
        <div class="fillout-container">
        <div class="inputs">
                <div class="navbar-claim">
                    <h2>Claim Form</h2>
                </div>
        <div class="column">
                <div class="label-input">
                <label>Description</label>
                <textarea
                    name="description"
                    id="description"
                    placeholder="Provide a detailed description of the item."
                    row="4"></textarea>
                    <?php if ($message !== ""): ?>
                    <p class="error-message">
                        <?= htmlspecialchars($message) ?>
                    </p>
                <?php endif; ?>
                </div>
        </div>
            <div class="label-input photo-field">
                <div class="labels">
                <label>Item Photo <span class="required">(optional)</span></label>
</div>
                <label for="item-photo" class="upload-container">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <p>Click to upload or drag and drop</p>
                    <span>PNG, JPG or JPEG (Max 5MB)</span>
                    <input type="file"
                        id="item-photo"
                        name="item_photo"
                        accept=".jpg,.jpeg,.png,.jfif"
                        hidden>
                        <p id="file-name">No image selected</p>
                </label>
                <?php if ($message !== ""): ?>
                <p class="error-message">
                <?= htmlspecialchars($message) ?>
                </p>
                <?php endif; ?>
                </div>

                <hr class="devider">
                <div class="submit-cancel-btn">
                    <button type="button" class="cancel">
                        Cancel</button>
                <input type="Submit" value="Submit" name="sub" class="submit">    
                </div>
            </div>
        </div>
        </form>
</main>
</div>
<script>
    const photoInput = document.getElementById("item-photo");
    const fileName = document.getElementById("file-name");

    photoInput.addEventListener("change", function () {
    fileName.textContent = this.files.length > 0
        ? this.files[0].name
        : "No image selected";
});
</script> 
</body>
</html>