<?php 
    session_start();
if (!isset($_SESSION["email"])) {
    header("Location: ../auth/loguot.php");
    exit();
}

require_once __DIR__. '/../vendor/autoload.php';
use App\Models\Item;
$userID=$_SESSION["UserID"];
$itemModel= new Item();
$categoryID = $_GET["category"] ?? "";
$search = trim($_GET["search"] ?? "");
try {
   if ($search !== "") {
        $item = $itemModel->search($search, $userID);
    } 
    else if ($categoryID === "") {
    $item = $itemModel->getAll();
} else {
    $item = $itemModel->getAllCategory($categoryID);
}
    $totalLost = $itemModel->countlost();
    $totalFound = $itemModel->countfound();

} catch (PDOException $e) {
    echo $e->getMessage();
    $item = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/manage-item.css">
    <link rel="stylesheet" href="../css/student-dashboard.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
>
</head>
<body>
    <div class="layout">
        <?php include 'C:/xampp/htdocs/LostAndFound/include/admin-navbar.php'; ?>
        <main class="dashboard-content">
            <div class="topbar1">
                <button class="menu-btn" onclick="showSidebar()" type="button">
                    <i class="fa-solid fa-bars"></i>
                </button>
        <div class="topbar-action">
            <button type="button" class="notification">
                    <i class="fa-solid fa-bell"></i>
                    <!-- <span class="notification-badge">3</span> -->
                    </button>
                <button type="button" class="circle-profile">
</button>
</div>
</div>
    <div class="manage-heading">
        <div class="heading-text">
        <h1>Manage Items</h1>
        <p>View, edit, and manage all found and lost items.</p>
</div>
<a href="claim.php">+ Add item</a>
</div>
        <div class="layout-container">
            <div class="container1">
                <form method="GET">
               <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" placeholder="Search items..." name="search"
                value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
</div>
</form>
            <form method="GET" action="manage-item.php">
            <select name="category" onchange="this.form.submit()">
                <option value="">All Categories</option>
                <option value="1" <?php if ($categoryID == "1") echo "selected"; ?>>Bags</option>
                <option value="2" <?php if ($categoryID == "2") echo "selected"; ?>>Electronics</option>
                <option value="3" <?php if ($categoryID == "3") echo "selected"; ?>>Wallets</option>
                <option value="4" <?php if ($categoryID == "4") echo "selected"; ?>>Keys</option>
                <option value="5" <?php if ($categoryID == "5") echo "selected"; ?>>Clothing</option>
            </select>
            
</form>
</div>
            <div class="container2">
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
                    <td><?php echo $i["ItemStatus"]?></td>
                   <td>
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