<?php 
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: ../auth/login.php");
    exit();
}

require_once __DIR__. '/../vendor/autoload.php';
use App\Models\Item;
use App\Models\Category;
use App\Models\Location;
$message ="";
$itemModel=new Item();
$categoryModel = new Category();
$locationModel = new Location();
$categories = $categoryModel->getAll();
$location = $locationModel->getAll();
if(isset($_POST["sub"])){
    $iname =$_POST["itemname"];
    $category=$_POST["category"];
    $location=$_POST["location"];
    $datelost=$_POST["datelost"];
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
        echo $userID;
        $result = $itemModel->insert(
            $iname,
            $category,
            $location,
            $description,
            $fileNameNew,
            $userID
        );
        
        header("Location: dashboard.php?uploadsuccess");
        exit();
    } catch (PDOException $e) {
        $message = "Database error: " . $e->getMessage();
    }
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/report-item.css">
    <link rel="stylesheet" href="../css/student-dashboard.css">
    <link rel="stylesheet" href="../css/my-report.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
>
</head>
<body>
    <div class="layout">
        <?php include 'C:/xampp/htdocs/LostAndFound/include/student-navbar.php'; ?>
        <main class="dashboard-content">
            <div class="topbar">
                <button class="menu-btn" onclick="showSidebar()" type="button">
                    <i class="fa-solid fa-bars"></i>
                </button>
        <div class="topbar-action">
</div>
</div>
    <div class="title-heading">
        <h1>Report Lost Items</h1>
        <p>Submit a report for an item you've lost.</p>
</div>
<form method="POST" enctype="multipart/form-data">
        <div class="fillout">
        <div class="fillout-container">
        <div class="inputs">
            <div class="column">
                <div class="label-input">
                <label>Item Name</label>
                <input type="text" name="itemname" placeholder="e.g Black wallet, iphone 13, Backpack">
                </div>
                <div class="label-input">
    <label>Category</label>

    <select name="category" id="category" required>
        <option value="" disabled selected>Select Category</option>

        <?php foreach ($categories as $category) { ?>
            <option value="<?php echo $category['CategoryID']; ?>">
                <?php echo htmlspecialchars($category['CategoryName']); ?>
            </option>
        <?php } ?>

    </select>
</div>
            </div>
            <div class="column">
                <div class="label-input">
                <label>Location</label>
                    <select name="location" id="location" required>
                        <option value="" disabled selected>Select Location</option>
                        <?php foreach ($location as $loc) { ?>
                            <option value="<?php echo $loc['LocationID']; ?>">
                                <?php echo htmlspecialchars($loc['LocationName']); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="label-input">
                <label>Date Lost</label>
                <input type="date" name="datelost">
                </div>
        </div>
        <div class="column">
                <div class="label-input">
                <label>Description</label>
                <textarea
                    name="description"
                    id="description"
                    placeholder="Provide a detailed description of the item."
                    row="4"></textarea>
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
</form>
                <hr class="devider">
                <div class="submit-cancel-btn">
                
                <input type="Submit" value="Submit" name="sub" class="submit">    
                </div>
            </div>
        </div>
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