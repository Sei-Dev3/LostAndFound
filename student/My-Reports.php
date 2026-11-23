<?php 
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: ../auth/login.php");
    exit();
}

require_once __DIR__. '/../vendor/autoload.php';
use App\Models\Item;

$itemModel=new Item();
$userID=$_SESSION["UserID"];
 $search = trim($_GET["search"] ?? "");

$item = [];
try{
    if ($search !== "") {
        $item = $itemModel->search($search, $userID);
    } else {
        $item = $itemModel->myreport($userID);
    }
    $totalLost=$itemModel->personalcountreport($userID);
    $totalReturn=$itemModel->countreturn($userID);
    $totalUnresolved=$itemModel->countstatuslost($userID);
}catch(PDOException $e){
    echo $e->getMessage();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                <form method="GET">
               <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" placeholder="Search items..." name="search"
                value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
</div>
</form>
        <div class="topbar-action">
            <button type="button" class="notification">
                    <i class="fa-solid fa-bell"></i>
                    <!-- <span class="notification-badge">3</span> -->
                    </button>
                <button type="button" class="circle-profile">
</button>
</div>
</div>
    <div class="title-heading">
        <h1>My Reports</h1>
        <p>View and manage the reports you have submitted</p>
</div>

        <div class="card">
            <div class="card-container">
                <i class="fa-solid fa-file-lines"></i>
                <p>Total Reports</p>
                <h3><?php echo $totalLost["total"]?></h3>
                <p>All your submitted reports</p>
</div>
            <div class="card-container">
                <i class="fa-solid fa-check-circle"></i>
                <p>Unresolved Items</p>
                <h3><?php echo $totalUnresolved["total"]?></h3>
                <p>Items not yet returned</p>
            </div>
            <div class="card-container">
                <i class="fa-solid fa-clock"></i>
                <p>Returned Items</p>
                <h3><?php echo $totalReturn["total"]?></h3>
                <p>Item succcessfully returned</p>
            </div>
        </div>
        <div class="report">
    <div class="submitted-report">
            <div class="report-headings">
            <h3>Your Submitted Reports</h3>
            <!-- <a href="report-item.php" class="new-report-btn">+ New Report</a> -->
</div>
            <div class="table-container">
            <table>
                <tr>
                    <th>Photo</th>
                    <th>Item Details</th>
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
                    <td colspan="7">
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
                    <td data-label="Item Name"><?php echo $i["ItemName"]?>
                    <br>
                    <small>
                    <?php echo (substr($i["Description"], 0, 40)) ?>...
                    </small>
                </td>
                    <td data-label="Category"><?php echo $i["CategoryName"]?></td>
        
                    <td data-label="Location"><?php echo $i["LocationName"]?></td>
                    <td data-label="Date Reported">
    <?php
    if ($i["ReportType"] == "Lost") {
        echo $i["DateLost"];
    } else {
        echo $i["DateFound"];
    }
    ?>
</td>
                    <td data-label="Status"><?php echo $i["Status"]?></td>
                    <td data-label="Action">
    <div class="action-dropdown">
        <button type="button" class="action-btn">
            <i class="fa-solid fa-ellipsis-vertical"></i>
        </button>

        <div class="dropdown-menu">
            <a href="viewbyid.php?id=<?php echo $i['ItemID']; ?>">
                <i class="fa-solid fa-eye"></i> View
            </a>

            <a href="delete-item.php?id=<?php echo $i['ItemID']; ?>"
               onclick="return confirm('Are you sure you want to delete this item?')"
               class="delete-option">
                <i class="fa-solid fa-trash"></i> Delete
            </a>

        </div>
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