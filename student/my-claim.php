<?php 
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: ../auth/login.php");
    exit();
}

require_once __DIR__. '/../vendor/autoload.php';
use App\Models\Claim;
use App\Models\Item;

$claimModel=new Claim();
$itemModel= new Item();
$userID=$_SESSION["UserID"];
$status = $_GET["Status"] ?? "";
$search = trim($_GET["search"] ?? "");
try {
    if ($search !== "") {
        $item = $claimModel->search($search, $userID);
    }
    else if ($status === "") {
        $item = $claimModel->myclaim($userID);
    } else {
        $item = $claimModel->getByStatus($userID, $status);
    }
    $totalClaim=$claimModel->personalcountreportclaim($userID);
    $totalPending=$claimModel->countpending($userID);
    $totalApprove=$claimModel->countapprove($userID);
    $totalVerification=$claimModel->countVerification($userID);
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
    <link rel="stylesheet" href="../css/my-claim.css">
    <link rel="stylesheet" href="../css/student-dashboard.css">
    
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
</div>
</div>
    <div class="title-heading">
        <h1>My Claims</h1>
        <p>Track the status of your claims.</p>
</div>
        <div class="card">
            <div class="card-container">
                <i class="fa-solid fa-file-lines"></i>
                <p>Total Claims</p>
                <h3><?php echo $totalClaim["total"]?></h3>
                <p>All your submitted claim reports</p>
            </div>
            <div class="card-container">
                <i class="fa-solid fa-circle-exclamation"></i>
                <p>Pending</p>
                <h3><?php echo $totalPending["total"]?></h3>
                <p>Awaiting review</p>
            </div>
            <div class="card-container">
                <i class="fa-solid fa-check-circle"></i>
                <p>Approved</p>
                <h3><?php echo $totalApprove["total"]?></h3>
                <p>Successfully claimed</p>
            </div>
            <div class="card-container">
                <i class="fa-solid fa-clock"></i>
                <p>Manual Verification</p>
                <h3><?php echo $totalVerification["total"]?></h3>
                <p>Report submitted this week</p>
            </div>
        </div>
        <div class="report">
    <div class="submitted-report">
            <div class="report-headings">
            <h3>Your Submitted Reports</h3>
            <form method="GET" action="my-claim.php">
            <select name="Status" onchange="this.form.submit()">
                <option value="">All Status</option>
                <option value="Pending" <?php if ($status == "Pending") echo "selected"; ?>>Pending</option>
                <option value="Manual Verification" <?php if ($status == "Manual Verification") echo "selected"; ?>>Manual Verification</option>
                <option value="Approved" <?php if ($status == "Approved") echo "selected"; ?>>Approved</option>
                <option value="Rejected" <?php if ($status == "Rejected") echo "selected"; ?>>Rejected</option>
            </select>
</form>
</div>
<div class="table-container">
           <table>
                <tr>
                    <th>Photo</th>
                    <th>Item Details</th>
                    <th>Category</th>
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
                    <td data-label="Photo"><?php if(!empty($i["Photo"])){?>
                <img src="../pictures/<?= htmlspecialchars($i["Photo"]) ?>"
                         alt="Item Photo" width="60">
                <?php } else { ?>
                    No Image
                <?php } ?></td>
                    <td data-label="Item Name"><?php echo $i["ItemName"]?>
                    <br>
                    <small>
                    <?php echo (substr($i["ClaimDetails"], 0, 40)) ?>...
                    </small>
                </td>
                    <td data-label="Category"><?php echo $i["CategoryName"]?></td>
                    <td data-label="Claim Date"><?php echo $i["ClaimDate"]?></td>
                    <td data-label="Status"><?php echo htmlspecialchars($i["ClaimStatus"]); ?></td>
                    <td data-label="Actions">
                        <div class="action-buttons">
                        <a href="viewclaim.php?id=<?php echo $i["ClaimID"]?>" class="view-btn-claim">View</a>
                        <?php if($i["ReportType"]==="Found"){?>
                        <a href="delete-claim.php?id=<?php echo $i["ClaimID"]; ?>"
                            class="reject-claim"
                            onclick="return confirm('Are you sure you want to delete this claim?')">
                             Delete
                        </a>
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