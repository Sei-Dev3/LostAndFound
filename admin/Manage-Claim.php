<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: ../auth/admin-login.php");
    exit();
}
require_once __DIR__ . '/../vendor/autoload.php';
use App\Models\Claim;
use App\Models\Queue;
$claimModel = new Claim();
try {
    $claims = $claimModel->getPendingClaims();
    $claimQueue = new Queue();
    foreach ($claims as $claim) {
        $claimQueue->enqueue($claim);
    }
    $nextClaim = $claimQueue->peek();
    $item = $claimQueue->getAll();

} catch (PDOException $e) {
    echo $e->getMessage();
    $item = [];
    $nextClaim = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/manage-item.css">
    <link rel="stylesheet" href="../css/my-report.css">
    <link rel="stylesheet" href="../css/manage-claim.css">
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
</div>
</div>

    <div class="manage-heading">
        <div class="heading-text">
        <h1>Manage Claims</h1>
        <p>View and manage claims requests for lost and found items.</p>
</div>
</div>

<div class="next-claim">
    <h3>Next Claim to Process</h3>

    <?php
    if ($nextClaim != null) {
        echo "Claim ID: " . htmlspecialchars($nextClaim["ClaimID"]);
        echo "<br>";
        echo "Item: " . htmlspecialchars($nextClaim["ItemName"]);
        echo "<br>";
        echo "Claimant: " . htmlspecialchars($nextClaim["fullname"]);
    } else {
        echo "No pending claims.";
    }
    ?>
</div>

        <div class="users-layout-container">
            <div class="users-container1">
               <form method="GET">
               <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" placeholder="Search items..." name="search"
                value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
</div>

            
</form>

            
            <div class="users-filter">
                <form method="GET" action="manage-claim.php">
            <select name="Status" onchange="this.form.submit()">
                <option value="">All Status</option>
                <option value="Pending" <?php if ($status == "Pending") echo "selected"; ?>>Pending</option>
                <option value="Manual Verification" <?php if ($status == "Manual Verification") echo "selected"; ?>>Manual Verification</option>
                <option value="Approved" <?php if ($status == "Approved") echo "selected"; ?>>Approved</option>
                <option value="Rejected" <?php if ($status == "Rejected") echo "selected"; ?>>Rejected</option>
            </select>
</form>
</div>
</div>
            
            <div class="users-container2">
                <div class="table-container">
                <table>
                <tr>
                    <th>Item Photo</th>
                    <th>Item Name</th>
                    <th>Claimant</th>
                    <th>Claim Date</th>
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
                    <td><?php if(!empty($i["PhotoClaim"])){?>
                <img src="../pictures/<?= htmlspecialchars($i["PhotoClaim"]) ?>"
                         alt="Item Photo" width="60">
                <?php } else { ?>
                    No Image
                <?php } ?></td>
                    <td><?php echo $i["ItemName"]?>
                </td>
                <td><?php echo $i["fullname"]?></td>
                <td>
                <?php echo $i["ClaimDate"]?>
</td>
                    
                    <td><?php echo $i["Status"]?></td>
                    <td>
                       <a href="viewmanageclaim.php?id=<?php echo $i["ClaimID"]; ?>" class="view-btn-claim">
    View
</a>
</td>
                </tr>
                 <?php }}?>
            </table>
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