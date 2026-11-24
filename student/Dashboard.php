<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: ../auth/login.php");
    exit();
}

require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\Item;
use App\Models\Category;

$categoryModel = new Category();
$userID = $_SESSION["UserID"];
$itemModel = new Item();
$categoryID = $_GET["category"] ?? "";
$search = trim($_GET["search"] ?? "");
$sortBy = $_GET["sort"] ?? "ItemID";
$order = $_GET["order"] ?? "DESC";
try {
    $categories = $categoryModel->getAll();
    $items = $itemModel->insertionSortItems($sortBy, $order);

    if ($categoryID !== "") {
        $filteredItems = [];
        foreach ($items as $i) {
            if ($i["CategoryID"] == $categoryID) {
                $filteredItems[] = $i;
            }
        }
        $items = $filteredItems;
    }
    if ($search !== "") {
        $item = $itemModel->linearSearch($items, $search);
    } else {
        $item = $items;
    }
    $totalLost = $itemModel->countlost();
    $totalFound = $itemModel->countfound();
    $totalReturn = $itemModel->countreturn();
    $totalAvailable = $itemModel->countavailable();
} catch (PDOException $e) {
    echo $e->getMessage();
    $item = [];
    $categories = [];
    $totalLost = ["total" => 0];
    $totalFound = ["total" => 0];
    $totalReturn = ["total" => 0];
    $totalAvailable = ["total" => 0];
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/student-dashboard.css">
    <!-- http://localhost/LostAndFound/student/dashboard.php -->
</head>
<body>
    
   <div class="layout">
        <?php include 'C:/xampp/htdocs/LostAndFound/include/student-navbar.php'; ?>
        <main class="dashboard-content">
            <div class="topbar">
                <button class="menu-btn" onclick="showSidebar()" type="button">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <form method="GET">
            <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" placeholder="Search items..." name="search"
                value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
</div>
</form>
        <div class="topbar-action">

</div>
</div>
        <div class="dashboard-grid">
            <div class="dashboard-top">
            <div class = "box-container">
        <div class = "box">
            <h1> Welcome to Lost & Found</h1>
            <p>Report lost items or check if your beongings have been found</p>
        </div>
    </div>
        <div class="container-layout">
            <div class="container">
                <i class="fa-solid fa-box"></i>
                <p>Total Lost Items</p>
                <h3><?php echo $totalLost["total"];?></h3>
            </div>
            <div class="container">
                <i class="fa-solid fa-bag-shopping"></i>
                <p>Total Found Items</p>
                <h3><?php echo $totalFound["total"];?></h3>
            </div>
            <div class="container">
                <i class="fa-solid fa-check-circle"></i>
                <p>Returned Items</p>
                <h3><?php echo $totalReturn["total"];?></h3>
            </div>
            <div class="container">
                <i class="fa-solid fa-clock"></i>
                <p>Available Items</p>
                <h3><?php echo $totalAvailable["total"];?></h3>
            </div>
        </div>
</div>
        <div class="category">
                <h3>Filter by Category</h3>

                <?php foreach ($categories as $category) { ?>
                    <a href="dashboard.php?category=<?php echo $category['CategoryID']; ?>"
                    class="category-btn">


                        <?php echo htmlspecialchars($category['CategoryName']); ?>

                    </a>
                <?php } ?>
</div>
        <div class="recent-listing">
            <div class="recent-header">
            <h3>Recent Listings</h3>
            <form method="GET" action="dashboard.php">

    <input type="hidden" name="search"
        value="<?php echo htmlspecialchars($search); ?>">

    <input type="hidden" name="category"
        value="<?php echo htmlspecialchars($categoryID); ?>">

    <select name="sort" onchange="this.form.submit()">
        <option value="ItemID"
            <?php if ($sortBy == "ItemID") { echo "selected"; } ?>>
            Item ID
        </option>

        <option value="ItemName"
            <?php if ($sortBy == "ItemName") { echo "selected"; } ?>>
            Item Name
        </option>

        <option value="DateLost"
            <?php if ($sortBy == "DateLost") { echo "selected"; } ?>>
            Date Lost
        </option>

        <option value="DateFound"
            <?php if ($sortBy == "DateFound") { echo "selected"; } ?>>
            Date Found
        </option>
    </select>

    <select name="order" onchange="this.form.submit()">
        <option value="ASC"
            <?php if ($order == "ASC") { echo "selected"; } ?>>
            Ascending
        </option>

        <option value="DESC"
            <?php if ($order == "DESC") { echo "selected"; } ?>>
            Descending
        </option>
    </select>

</form>
</div>
            <div class="table-container">
    <table>
                <tr>
                    <th>Photo</th>
                    <th>Item Details</th>
                    <th>Report Type</th>
                    <th>Category</th>
                    <th>Location</th>
                    <th>Date Reported</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                <?php 
                if(empty($item)){
                ?>
                <tr>
                    <td colspan="8">
                <div class="empty-state">
                <i class="fa-regular fa-folder-open"></i>
                <h3>No Items Yet</h3>
                <p>There are no lost or found items to display.</p>
</div>
</td>
</tr>
                <?php }else{
                        foreach($item as $i){
                ?>
                <tr>
                    <td data-label="Photo"><?php if(!empty($i["Photo"])){?>
                <img src="../pictures/<?= htmlspecialchars($i["Photo"]) ?>"
                         alt="Item Photo" width="60">
                <?php } else { ?>
                    No Image
                <?php } ?></td>
                    <td data-label="Item Details">
                        <div class="item-details">
                        <?php echo $i["ItemName"]?>
                    <br>
                    <small>
                    <?php echo (substr($i["Description"], 0, 40)) ?>...
                    </small>
</div>
                </td>
                <td data-label="Report Type">
                <?php if ($i["ReportType"] === "Found") { ?>
                <p>Found</p>
                    <?php } else { ?>
                     <p>Lost</p>
    
                     <?php } ?>
</td>
                    <td data-label="Category"><?php echo $i["CategoryName"]?></td>
                    <td data-label="Location"><?php echo htmlspecialchars($i["LocationName"]); ?></td>
                    <td data-label="Report Date"><?php if ($i["ReportType"] === "Found"){
                        echo $i["DateFound"];
                    }else{
                        echo $i["DateLost"];
                    }?>
                </td>
                    <td data-label="Status">
    <?php echo htmlspecialchars($i["ItemStatus"]); ?>
</td>
                    <td data-label="Actions">
                        <div class="action-buttons">
                        <a href="viewbyId.php?id=<?php echo $i["ItemID"]?>" class="view-btn">View</a>
                        <?php if($i["ReportType"]==="Found"){?>
                        <a href="submit-claim.php?id=<?php echo $i["ItemID"]?>" class="claim" >Claim</a></td>
                        <?php }?>
</div>
                    </td>
                </tr>
                 <?php }}?>
            </table>
</div>
            </div>
</div>
           
                    
      </div>
        </main>
    </div>
    <script>
const searchInput = document.querySelector('input[name="search"]');

searchInput.addEventListener('input', function() {
    if (this.value.trim() === "") {
        window.location.href = window.location.pathname;
    }
});
</script>
</body>
</html>