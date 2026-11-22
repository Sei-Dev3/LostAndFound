<?php 
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: ../auth/admin-login.php");
    exit();
    
}
require_once __DIR__. '/../vendor/autoload.php';
use App\Models\Claim;
use App\Models\Item;
use App\Models\User;
$userID=$_SESSION["UserID"];
$claimModel=new Claim();
$itemModel=new Item();
$userModel=new User();
try{
    $item=$claimModel->getAllclaim();
    $totalClaim=$claimModel->personalcountreportclaim();
    $totalPending=$claimModel->countpending();
    $totalApprove=$claimModel->countapprove();
    $totalUser=$userModel->countuser();
    $recentLostItem = $itemModel->getbyrecentitem("Lost");
    $recentFoundItem = $itemModel->getbyrecentitem("Found"); 
    $recentApproved = $claimModel->getbyrecentclaim("Approved");
    $recentVerification = $claimModel->getbyrecentclaim("Manual Verification");
}


catch(PDOException $e){
    echo $e->getMessage();
    $item=[];
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
    <link rel="stylesheet" href="../css/admin-dashboard.css">
    <link rel="stylesheet" href="../css/manage.css">
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
        <h1>Admin Dashboard</h1>
        <p>Overview of the lost and found system.</p>
</div>
</div>
        <div class="admin-container-layout">
            <div class="admin-container">
                <i class="fa-solid fa-box"></i>
                <h3><?php echo $totalClaim["total"]?></h3>
                <h5>Total Lost Items</h5>
                <p>Lost and found records</p>
            </div>
            <div class="admin-container">
                <i class="fa-solid fa-clock"></i>
                <h3><?php echo $totalPending["total"]?></h3>
                <h5>Pending Claims</h5>
                <p>Awaiting review</p>
            </div>
            <div class="admin-container">
                <i class="fa-solid fa-check-circle"></i>
                <h3><?php echo $totalApprove["total"]?></h3>
                <h5>Approved Claims</H5>
                <p>Successfully claimed</p>
            </div>
            <div class="admin-container">
                <i class="fa-solid fa-users"></i>
                <h3><?php echo $totalUser["total"]?></h3>
                <h5>Total Users</h5>
                <p>Registered account</p>
            </div>
        </div>
    
        <div class="box-layout">
            <div class="pending-claims">
            <div class="pending-header">
            <h3>Pending Claims</h3>
</div>
<div class="table-container">
            <table>
                <tr>
                    <th>Claimant</th>
                    <th>Item Name</th>
                    <th>Date</th>
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
                    <td><?php echo $i["fullname"]?>
                </td>
                <td><?php echo $i["ItemName"]?></td>
                <td>
                <?php echo $i["ClaimDate"]?>
</td>  
                    <td><?php echo $i["Status"]?></td>
                    <td>
    <div class="action-dropdown">
        <button type="button" class="action-btn">
            <i class="fa-solid fa-ellipsis-vertical"></i>
        </button>

        <div class="dropdown-menu">

            <a href="viewbyid.php?id=<?php echo $i['ItemID']; ?>">
                <i class="fa-solid fa-eye"></i> View
            </a>

            <a href="update.php?id=<?php echo $i['ItemID']; ?>">
                <i class="fa-solid fa-pen"></i> Update
            </a>

            <a href="delete.php?id=<?php echo $i['ItemID']; ?>"
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
            <div class="recent-activity">
                <div class="recent-admin">
                    <h3>Recent Activity</h3>
                </div>
                <div class="item-activity">
                
                    <i class="fa-solid fa-box"></i>
                    <div class="activity-details">
                        <h4>New Lost Item Report</h4>
                        <p>Black Backpack submitted by user</p>
                    </div>
                    <span><?php

                            $date = $recentLostItem["DateLost"];
                                if (!empty($date)) {
                                    $hours = floor((time() - strtotime($date)) / 3600);
                                    if ($hours == 0) {
                                        $minutes = floor((time() - strtotime($date)) / 60);
                                        if ($minutes == 0) {
                                            echo "Just now";
                                        } else {
                                            echo $minutes . " minutes ago";
                                        }
                                    } else if ($hours == 1) {
                                        echo "1 hour ago";
                                    } else {
                                        echo $hours . " hours ago";
                                    }
                                } else {
                                    echo "Date unavailable";
                                }
                        //         $date = $recentLostItem["DateLost"];
                            
                        //     if (!empty($date)) {
                        //         $days = floor((time() - strtotime($date)) / 86400);

                        //         echo $days . " days ago";
                        //     } else {
                        //         echo "Date unavailable";
                        //     }
                        // ?>  </span>
                </div>
                <div class="item-activity">
                    <i class="fa-solid fa-check"></i>
                    <div class="activity-details">
                        <h4>Claim Approved</h4>
                        <p>Claim for an iphone</p>
                    </div>
                    <span><?php
                         $date = $recentApproved["ClaimDate"];
                                if (!empty($date)) {
                                    $hours = floor((time() - strtotime($date)) / 3600);
                                    if ($hours == 0) {
                                        $minutes = floor((time() - strtotime($date)) / 60);
                                        if ($minutes == 0) {
                                            echo "Just now";
                                        } else {
                                            echo $minutes . " minutes ago";
                                        }
                                    } else if ($hours == 1) {
                                        echo "1 hour ago";
                                    } else {
                                        echo $hours . " hours ago";
                                    }
                                } else {
                                    echo "Date unavailable";
                                }
                        ?>  </span>
                </div>
                <div class="item-activity">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <div class="activity-details">
                        <h4>Manul Verification Required</h4>
                        <p>Claim for a Blue Wallet</p>
                    </div>
                    <span><?php
                        $date = $recentVerification["ClaimDate"];
                                if (!empty($date)) {
                                    $hours = floor((time() - strtotime($date)) / 3600);
                                    if ($hours == 0) {
                                        $minutes = floor((time() - strtotime($date)) / 60);
                                        if ($minutes == 0) {
                                            echo "Just now";
                                        } else {
                                            echo $minutes . " minutes ago";
                                        }
                                    } else if ($hours == 1) {
                                        echo "1 hour ago";
                                    } else {
                                        echo $hours . " hours ago";
                                    }
                                } else {
                                    echo "Date unavailable";
                                }?>  </span>
                </div>
                <div class="item-activity">
                    <i class="fa-solid fa-gift"></i>
                    <div class="activity-details">
                        <h4>New Found Item</h4>
                        <p>Umbrella dound in the library</p>
                    </div>
                    <span><?php
                         $date = $recentFoundItem["DateFound"];
                                if (!empty($date)) {
                                    $hours = floor((time() - strtotime($date)) / 3600);
                                    if ($hours == 0) {
                                        $minutes = floor((time() - strtotime($date)) / 60);
                                        if ($minutes == 0) {
                                            echo "Just now";
                                        } else {
                                            echo $minutes . " minutes ago";
                                        }
                                    } else if ($hours == 1) {
                                        echo "1 hour ago";
                                    } else {
                                        echo $hours . " hours ago";
                                    }
                                } else {
                                    echo "Date unavailable";
                                }
                        ?>  </span>
                </div>
            </div>
            
</div>
            </div>
        </div>
</div>
</main>
</div>
</body>
</html>