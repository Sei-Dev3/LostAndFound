<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: ../auth/admin-login.php");
    exit();
}

require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\Item;

$itemModel = new Item();

if (!isset($_GET["id"]) || !ctype_digit($_GET["id"])) {
    exit("Invalid Item ID.");
}
$id = $_GET["id"];
$item = $itemModel->binarySearchItem($id);
if ($item === null) {
    exit("Item not found.");
}
?>
<h2>Binary Search Result</h2>

<p>Item ID: <?php echo htmlspecialchars($item["ItemID"]); ?></p>
<p>Item Name: <?php echo htmlspecialchars($item["ItemName"]); ?></p>
<p>Description: <?php echo htmlspecialchars($item["Description"]); ?></p>

<a href="manage-item.php">Back to Manage Items</a>