<?php 
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: ../auth/loguot.php");
    exit();
}

require_once __DIR__. '/../vendor/autoload.php';
use App\Models\Item;

$itemModel=new Item();

if(isset($_GET["id"])){
    $id=$_GET["id"];
try{
    $item = $itemModel->ViewById($id);

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
    <title>Document</title>
    <link rel="stylesheet" href="../css/manage-item.css">
    <link rel="stylesheet" href="../css/student-dashboard.css">
    <link rel="stylesheet" href="../css/style.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
>
</head>
<body>
    <div class="layout">
        <main class="dashboard-content">
            <div class="topbar1">
        <div class="topbar-action">
            <button type="button" class="notification">
                    <i class="fa-solid fa-bell"></i>
                    <!-- <span class="notification-badge">3</span> -->
                    </button>
                <button type="button" class="circle-profile">
</button>
</div>
</div>
        <div class="view-item">
        <a href="dashboard.php" class="view">← Dashboard</a>
</div>
            <div class="view-container">
                <div class="view-layout">
                    <div class="view-photo">
                        <?php
                             if(!empty($item["Photo"])){?>
                             <img src="../pictures/<?php echo htmlspecialchars($item["Photo"]) ?>"
                                    alt="Item Photo" width="60">
                            <?php } else { ?>
                             <h1>No image</h1>
                        <?php } ?>
                       
                    </div>
                    <div class="info-view">
                    <input type="text" name="pname" value="<?php echo $item["ItemName"]?>">
                    <div class="info">
                        <p class="lost">
                            <?php if ($item["ReportType"] === "Found") { ?>
                                Found
                            <?php } else { ?>
                                Lost
                            <?php } ?>
                        </p>
                        <p class="date"><?php if ($item["ReportType"] === "Lost"){
                            echo $item["DateLost"];
                        }else{
                            echo $item["DateFound"];
                        }?></p>
                    </div>
                    <hr>
                    
                    <h3>Category:<?php echo htmlspecialchars($item["CategoryName"]);?> </h3>
                    <h3>Location:<?php echo $item["LocationName"]?> </h3>
                    <h3>Description: <?php echo $item["Description"]?></h3>
                    <hr>
                    <div class="btns">
<button type="Submit">Update</button>
<a  href="manage-item.php">Cancel</a>
</div>

                </div>
                </div>

            </div>
</div>
</main>
</div>
</body>
</html>