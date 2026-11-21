<?php 
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: ../student/my-reports.php");
    exit();
}

require_once __DIR__. '/../vendor/autoload.php';
use App\Models\Item;

$itemModel=new Item();

if(isset($_GET["id"])){
    $id=$_GET["id"];
try{
    $item = $itemModel->ViewById($id);
    
    

}catch(PDOException $e){
    echo $e->getMessage();
}
}else {
    echo "No item ID provided.";
}
?>  



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lost Item Report</title>


    <link rel="stylesheet" href="../css/update.css">
    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

<div class="layout">
    <main class="dashboard-content">

        <div class="edit-header">
            <a href="my-reports.php?id=<?php echo urlencode((string)$id); ?>" class="back-btn">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>

            <h1>Edit Lost Item Report</h1>
            <p>Update your item information below.</p>
        </div>

        <div class="edit-container">

            <form action="updateitem.php" method="POST" enctype="multipart/form-data">

                <div class="edit-grid">

                    <div class="edit-fields">
                        <input type="hidden" name="ItemID"
                        value="<?php echo htmlspecialchars((string)$item["ItemID"]); ?>">
                        <label>Item Name</label>
                        <input type="text" name="ItemName"
                        value="<?php echo htmlspecialchars($item["ItemName"]); ?>" required>

                        <label>Category</label>
                        <select name="category" id="category">
                            <option value="" disabled>Select Category</option>
                            <option value="1" <?php echo ($item["CategoryID"] == 1) ? "selected" : ""; ?>>Bags</option>
                            <option value="2" <?php echo ($item["CategoryID"] == 2) ? "selected" : ""; ?>>Electronics</option>
                            <option value="3" <?php echo ($item["CategoryID"] == 3) ? "selected" : ""; ?>>Wallets</option>
                            <option value="4" <?php echo ($item["CategoryID"] == 4) ? "selected" : ""; ?>>Keys</option>
                            <option value="5" <?php echo ($item["CategoryID"] == 5) ? "selected" : ""; ?>>Clothing</option>
                        </select>

                        <label>Location</label>
                        <select name="location" id="location">
                            <option value="" disabled>Select Location</option>
                            <option value="1" <?php echo ($item["LocationID"] == 1) ? "selected" : ""; ?>>Library</option>
                            <option value="2" <?php echo ($item["LocationID"] == 2) ? "selected" : ""; ?>>Canteen</option>
                            <option value="3" <?php echo ($item["LocationID"] == 3) ? "selected" : ""; ?>>Office</option>   
                        </select>

                        <label>Date Lost</label>
                <input type="date" name="datelost" value="<?php echo ($item["DateLost"])?>">

                        <label>Description</label>
                        <textarea name="description" rows="5" required><?php
                            echo htmlspecialchars($item["Description"]);
                        ?></textarea>

                    </div>


                    <div class="edit-photo">
                        <label>Current Photo</label>

                        <?php if (!empty($item["Photo"])) { ?>
                            <img src="../pictures/<?php echo htmlspecialchars($item["Photo"]); ?>"
                                 alt="Current Item Photo">
                        <?php } else { ?>
                            <p>No image uploaded.</p>
                        <?php } ?>

                        <label for="Photo">Change Photo</label>
                        <input type="file" name="item_photo" id="Photo" accept="image/*">

                        <p class="photo-note">
                            Leave this empty if you want to keep the current photo.
                        </p>

                    </div>

                </div>

                <div class="edit-actions">
                    <a href="view.php?id=<?php echo urlencode((string)$id); ?>"
                       class="cancel-btn">Cancel</a>

                    <input type="submit" name="up" value="Save Changes">
                </div>

            </form>

        </div>

    </main>
</div>

</body>
</html>