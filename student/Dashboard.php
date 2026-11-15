<?php 
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: ../auth/loguot.php");
    exit();
}

require_once __DIR__. '/../vendor/autoload.php';
use App\Models\Item;
$userID=$_SESSION["UserID"];
$itemModel=new Item();
try{
    $item=$itemModel->getAll();
    $totalLost=$itemModel->countlost();
    $totalFound=$itemModel->countfound();
}catch(PDOException $e){
    echo $e->getMessage();
    $item=[];
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
            <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" placeholder="Search items...">
</div>
        <div class="topbar-action">
            <button type="button" class="notification">
                    <i class="fa-solid fa-bell"></i>
                    <!-- <span class="notification-badge">3</span> -->
                    </button>
                <button type="button" class="circle-profile">
</button>
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
                <p>+1 this week</p>
            </div>
            <div class="container">
                <i class="fa-solid fa-bag-shopping"></i>
                <p>Total Found Items</p>
                <h3><?php echo $totalFound["total"];?></h3>
                <p>+3 this week</p>
            </div>
            <div class="container">
                <i class="fa-solid fa-check-circle"></i>
                <p>Returned Items</p>
                <h3>18</h3>
                <p>+4 this week</p>
            </div>
            <div class="container">
                <i class="fa-solid fa-clock"></i>
                <p>Pending Claims</p>
                <h3>10</h3>
                <p>+5 this week</p>
            </div>
        </div>
        <div class="recent-listing">
            <div class="recent-header">
            <h3>Recent Listings</h3>
            <a href="view.php">View All →</a>
</div>
            <div class="btn">
            <button type="button" class="lost-item-btn">
                Lost Items
</button>
            <button type="button" class="found-item-btn">
                Found Items
            </button>
</div>
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
                    <td colspan="6">
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
                    <td><?php if(!empty($i["Photo"])){?>
                <img src="../pictures/<?= htmlspecialchars($i["Photo"]) ?>"
                         alt="Item Photo" width="60">
                <?php } else { ?>
                    No Image
                <?php } ?></td>
                    <td><?php echo $i["ItemName"]?>
                    <br>
                    <small>
                    <?php echo (substr($i["Description"], 0, 40)) ?>...
                    </small>
                </td>
                <td>
                <?php if ($i["ReportType"] === "Found") { ?>
                <p>Found</p>
                    <?php } else { ?>
                     <p>Lost</p>
    
                     <?php } ?>
</td>
                    <td><?php echo $i["CategoryName"]?></td>
                    <td><?php echo htmlspecialchars($i["LocationName"]); ?></td>
                    <td><?php if ($i["ReportType"] === "Found"){
                        echo $i["DateFound"];
                    }else{
                        echo $i["DateLost"];
                    }?>
                </td>
                    <td><?php echo $i["Status"]?></td>
                    <td>
                        <a href="viewbyId.php?id=<?php echo $i["ItemID"]?>" class="view-btn">View</a>
                        <?php if($i["ReportType"]==="Found"){?>
                        <a href="submit-claim.php?id=<?php echo $i["ItemID"]?>" class="claim" >Claim</a></td>
                        <?php }?>
                    </td>
                </tr>
                 <?php }}?>
            </table>

            </div>
</div>
           
                    <div class="category">
                        <h3>Filter by Category</h3>
                        <button type="button" class="category-btn">
                            <i class="fa-solid fa-bag-shopping"></i>
                            Bags
                        </button>
                        <button type="button" class="category-btn">
                            <i class="fa-solid fa-mobile-screen"></i>
                            Electronics
                        </button>
                        <button type="button" class="category-btn">
                            <i class="fa-solid fa-wallet"></i>
                            Wallets
                        </button>
                        <button type="button" class="category-btn">
                            <i class="fa-solid fa-key"></i>
                            Keys
                        </button>
                        <button type="button" class="category-btn">
                            <i class="fa-solid fa-shirt"></i>
                            Clothing
                        </button>
                </div>
      </div>
        </main>
    </div>
</body>
</html>