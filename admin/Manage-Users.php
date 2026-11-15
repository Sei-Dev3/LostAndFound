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
    $item=$itemModel->getAllUsers();
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
    <title>Document</title>
    <link rel="stylesheet" href="../css/manage-item.css">
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
        <h1>Manage Users</h1>
        <p>View, edit, and manage all users.</p>
</div>
</div>
        <div class="users-layout-container">
            <div class="users-container1">
                <div class="users-search1">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" placeholder="Search Users...">
            </div>
            <div class="users-filter">
            <select name="location" id="location">
                    <option value="" disabled selected>All Roles</option>
                    <option value="Library">Library</option>
                    <option value="canteen">Canteen</option>
                    <option value="classroom">Classroom</option>
            </select>
            <select name="location" id="location">
                    <option value="" disabled selected>All Status</option>
                    <option value="Library">Library</option>
                    <option value="canteen">Canteen</option>
                    <option value="classroom">Classroom</option>
            </select>
            <select name="location" id="location">
                    <option value="" disabled selected>All Users</option>
                    <option value="Library">Library</option>
                    <option value="canteen">Canteen</option>
                    <option value="classroom">Classroom</option>
            </select>
</div>
</div>
            <div class="users-container2">
                <table>
                <tr>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Date Registered</th>
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
                    <td><?php echo $i["fullname"]?>
                </td>
                <td><?php echo $i["email"]?></td>
                <td>
                <?php echo $i["role"]?>
</td>
                    
                    <td><?php echo $i["created_at"]?></td>
                    <td>
                        <a href="viewbyuser.php" class="view-btn">View</a>
                        <a href="" class="claim" onclick="return confirm('Are you sure?')">Delete</a></td>
                    </td>
                </tr>
                 <?php }}?>
            </table>
            </div>
</div>
</main>
</div>
</body>
</html>