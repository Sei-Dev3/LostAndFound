<?php
session_start();

if (!isset($_SESSION["email"])) {
   header("Location: ../auth/admin-login.php");
    exit();
}

require_once __DIR__ . '/../vendor/autoload.php';
use App\Models\Item;

$itemModel = new Item();
if (!isset($_GET["id"])) {
    exit("No Item ID provided.");
}
$id = $_GET["id"];
try {
    if (isset($_POST["up"])) {
        header("Location: viewbyid.php?id=" . urlencode($id));
        exit();
    }
    $item = $itemModel->ViewById($id);
    if (!$item) {
        exit("Item not found.");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lost Item Report</title>


    
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/update.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

<div class="layout">
    <main class="dashboard-content">

        <div class="edit-header">
            <a href="manage-item.php?id=<?php echo urlencode((string)$id); ?>" class="back-btn">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>
            <h1>Edit Lost and Found Item Report</h1>
            <p>Update your item information and the Status of the Item.</p>
        </div>
        <div class="edit-container">
            <form action="updatefound.php" method="POST" enctype="multipart/form-data">
                <div class="edit-grid">

                    <div class="edit-fields">
                        <input type="hidden" name="ItemID"
                        value="<?php echo htmlspecialchars((string)$item["ItemID"]); ?>">
                        <label>Item Name</label>
                        <input type="text" name="ItemName"
                        value="<?php echo htmlspecialchars($item["ItemName"]); ?>" required>

                        <label>Category</label>
                        <select name="category" id="category">
                            <option value="" disabled selected>Select Category</option>
                            <option value="1" <?php echo ($item["CategoryID"] == 1) ? "selected" : ""; ?>>Bags</option>
                            <option value="2" <?php echo ($item["CategoryID"] == 2) ? "selected" : ""; ?>>Electronics</option>
                            <option value="3" <?php echo ($item["CategoryID"] == 3) ? "selected" : ""; ?>>Wallets</option>
                            <option value="4" <?php echo ($item["CategoryID"] == 4) ? "selected" : ""; ?>>Keys</option>
                            <option value="5" <?php echo ($item["CategoryID"] == 5) ? "selected" : ""; ?>>Clothing</option>
                        </select>

                        <label>Location</label>
                        <select name="location" id="location">
                            <option value="" disabled selected>Select Location</option>
                            <option value="1" <?php echo ($item["LocationID"] == 1) ? "selected" : ""; ?>>Library</option>
                            <option value="2" <?php echo ($item["LocationID"] == 2) ? "selected" : ""; ?>>Canteen</option>
                            <option value="3" <?php echo ($item["LocationID"] == 3) ? "selected" : ""; ?>>Office</option>   
                        </select>

                        <label>Date:</label>

                        <p>
                        <?php
                        if ($item['ReportType'] == 'Lost') {
                            echo !empty($item['DateLost'])
                            ? date('F d, Y h:i A', strtotime($item['DateLost']))
                            : 'No date available';
                        }else {
                            echo !empty($item['DateFound'])
                            ? date('F d, Y h:i A', strtotime($item['DateFound']))
                        : 'No date available';
    }
    ?>
</p>
                        <label>Description</label>
                        <textarea name="description" rows="5" required><?php
                            echo htmlspecialchars($item["Description"]);
                        ?></textarea>
                        <label for="status">Select Status</label>
        <select name="status" id="status" required>
            <option value="Lost" <?php echo ($item["Status"] == "Lost") ? "selected" : ""; ?>>
                Lost
            </option>
            <option value="Available" <?php echo ($item["Status"] == "Available") ? "selected" : ""; ?>>
                Available
            </option>
            <option value="Claimed" <?php echo ($item["Status"] == "Claimed") ? "selected" : ""; ?>>
                Claimed
            </option>
            <option value="Returned" <?php echo ($item["Status"] == "Returned") ? "selected" : ""; ?>>
                Returned
            </option>
        </select>
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
                    <a href="manage-item.php?id=<?php echo urlencode((string)$id); ?>"
                       class="cancel-btn">Cancel</a>
                    <input type="submit" name="up" value="Save_status">
                </div>
            </form>
        </div>
    </main>
</div>
</body>
</html>