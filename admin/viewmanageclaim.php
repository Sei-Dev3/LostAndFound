<?php 
session_start();
if (!isset($_SESSION["email"])) {
  header("Location: ../auth/admin-login.php");
    exit();
}

require_once __DIR__. '/../vendor/autoload.php';
use App\Models\Item;
use App\Models\Claim;

$claimModel=new Claim();
$itemModel=new Item();
if (!isset($_GET["id"])) {
    exit("No Claim ID provided.");
}

$claimID = $_GET["id"];
    try {
        if(isset($_POST["save_status"])){
            $status=$_POST["status"];
        $claimModel->updatestatus($claimID, $status);
        header("Location: viewmanageclaim.php?id=" . urlencode($claimID));
        exit();
    }$claim = $claimModel->ViewClaimById($claimID);

    if (!$claim) {
        exit("Claim not found.");
    }$item = $itemModel->ViewById($claim["ItemID"]);

    if (!$item) {
        exit("Item not found.");
    }
    }catch (PDOException $e) {
    exit(
        "Database Error: " . $e->getMessage() .
        "<br>File: " . $e->getFile() .
        "<br>Line: " . $e->getLine()
    );
}
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Claim</title>
    <link rel="stylesheet" href="../css/viewclaim.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/view-claim.css">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

<div class="layout">

    <main class="dashboard-content">

        <div class="claim-header">
            <a href="manage-claim.php" class="back-btn">
                <i class="fa-solid fa-arrow-left"></i> Back to Claims
            </a>

            <h1>Claim Details</h1>
            <p>Review the claimant's information and manage their request.</p>
        </div>

        <div class="claim-container">

            <div class="claim-title">
    <h2><?php echo htmlspecialchars($item["ItemName"]); ?></h2>

    <span class="status">
        <?php echo htmlspecialchars($claim["Status"]); ?>
    </span>
</div>

            <div class="claim-content">
                <div class="item-photo">
                    <h3>Claimant's Photo Evidence</h3>
                    <?php if (!empty($claim["PhotoClaim"])) { ?>
                        <img src="../pictures/<?php echo htmlspecialchars($claim["PhotoClaim"]); ?>"
                            alt="Current Item Photo">
                        <?php } else { ?>
            <p>No image uploaded.</p>
        <?php } ?>
                </div>

                <div class="claim-info">

                    <h3>Item Information</h3>

                    <div class="info-group">
                        <label>Item Name</label>
                        <p><?php echo $item["ItemName"]?></p>
                    </div>

                    <div class="info-group">
                        <label>Category</label>
                        <p><?php echo $item["CategoryName"]?></p>
                    </div>

                    <div class="info-group">
                        <label>Location Found</label>
                        <p><?php echo $item["LocationName"]?></p>
                    </div>

                    <div class="info-group">
                        <label>Claimant</label>
                        <p><?php echo $claim["ClaimantName"]; ?></p>
                    </div>

                    <div class="info-group">
                        <label>Claim Date</label>
                        <p><?php echo $claim["ClaimDate"]?></p>
                    </div>

                </div>

            </div>

            <div class="claim-description">
                <h3>Claimant's Explanation</h3>
                <p>
                    <?php echo $claim["ClaimDetails"]; ?>
                </p>
            </div>
<form method="POST" action="viewmanageclaim.php?id=<?php echo $claimID; ?>">
            <input type="hidden" name="claimID" value="<?php echo htmlspecialchars($claimID); ?>">
            <div class="status-section">

                <h3>Update Claim Status</h3>
                <label for="status">Select Status</label>

        <select name="status" id="status" required>
            <option value="Pending" <?php echo ($claim["Status"] == "Pending") ? "selected" : ""; ?>>
                Pending
            </option>
            <option value="Approved" <?php echo ($claim["Status"] == "Approved") ? "selected" : ""; ?>>
                Approved
            </option>
            <option value="Manual Verification" <?php echo ($claim["Status"] == "Manual Verification") ? "selected" : ""; ?>>
                Manual Verification
            </option>
            <option value="Rejected" <?php echo ($claim["Status"] == "Rejected") ? "selected" : ""; ?>>
                Rejected
            </option>
        </select>


                <div class="status-note">
                    <i class="fa-solid fa-circle-info"></i>
                    For manual verification, instruct the claimant
                    to visit the school office for further checking.
</div>
            </div>

            <div class="claim-actions">
                
                <button type="submit" name="save_status" class="save-btn">
                    Save Changes
                </button>
            </div>
</form>
        </div>

    </main>
</div>

</body>
</html>