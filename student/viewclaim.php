<?php 
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: ../auth/login.php");
    exit();
}

require_once __DIR__. '/../vendor/autoload.php';
use App\Models\Claim;

$claimModel=new Claim();

if(isset($_GET["id"])){
    $id=$_GET["id"];
try{
    $item = $claimModel->ViewClaimById($id);
    if (!$item) {
    exit("Claim not found. Claim ID: " . htmlspecialchars($id));
}
    

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


    <link rel="stylesheet" href="../css/updateclaim.css">
    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

<div class="layout">
    <main class="dashboard-content">
        <div class="edit-header">
            <a href="my-claim.php?id=<?php echo urlencode((string)$id); ?>" class="back-btn">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>
            <h1>Edit Claim</h1>
            <p>Update your claim information below.</p>
        </div>
        <div class="edit-container">
            <form action="updateclaim.php" method="POST" enctype="multipart/form-data">
                <div class="edit-grid">
    <div class="edit-fields">
        <input type="hidden" name="ClaimID"
                        value="<?php echo htmlspecialchars((string)$item["ClaimID"]); ?>">
        <label>Description</label>
        <textarea name="description" rows="5" required><?php
            echo htmlspecialchars($item["ClaimDetails"]);
        ?></textarea>
    </div>
    <div class="edit-photo">
        <label>Current Photo</label>
        <?php if (!empty($item["PhotoClaim"])) { ?>
            <img src="../pictures/<?php echo htmlspecialchars($item["PhotoClaim"]); ?>"
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
                    <a href="my-claim.php?id=<?php echo urlencode((string)$id); ?>"
                       class="cancel-btn">Cancel</a>

                    <input type="submit" name="up" value="Save Changes">
                </div>
            </form>
        </div>
    </main>
</div>

</body>
</html>