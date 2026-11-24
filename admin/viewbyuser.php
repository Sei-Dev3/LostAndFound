<?php 
session_start();
if (!isset($_SESSION["email"])) {
 header("Location: ../auth/admin-login.php");
    exit();
}

require_once __DIR__. '/../vendor/autoload.php';
use App\Models\User;

$userModel=new User();

if(isset($_GET["id"])){
    $userID = $_GET["id"];
try{
    $user = $userModel->ViewUserById($userID);

}catch(PDOException $e){
    echo $e->getMessage();
}
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
    <link rel="stylesheet" href="../css/user.css">
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
</div>
</div>

    <div class="view-item">
        <a href="manage-users.php" class="view">← Back</a>
</div>

        <div class ="info-user-layout">
            <div class="info-user-container">
                <div class="profile-header">
            <div class="profile-icon">
                <i class="fa-solid fa-circle-user"></i>
            </div>
            <div class="profile-heading">
                <h1><?= htmlspecialchars($user["fullname"]); ?></h1>
                <p><?= htmlspecialchars($user["email"]); ?></p>
                <span class="role-badge">
                    <?= htmlspecialchars($user["role"]); ?>
                </span>
            </div>
        </div>

        <hr>

         <h2 class="section-title">Personal Information</h2>

        <div class="user-information">

            <div class="info-box">
                <h4>Full Name</h4>
                <h3><?= htmlspecialchars($user["fullname"]); ?></h3>
            </div>

            <div class="info-box">
                <h4>Email Address</h4>
                <h3><?= htmlspecialchars($user["email"]); ?></h3>
            </div>

            <div class="info-box">
                <h4>Role</h4>
                <h3><?= htmlspecialchars($user["role"]); ?></h3>
            </div>

            <div class="info-box">
                <h4>Account Created</h4>
                <h3><?= htmlspecialchars($user["created_at"]); ?></h3>
            </div>

        </div>


                
        </div>
</main>
</div>
</body>
</html>