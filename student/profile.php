<?php 
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: ../auth/login.php");
    exit();
}

require_once __DIR__. '/../vendor/autoload.php';
use App\Models\User;

$userModel=new User();
$userID = $_SESSION["UserID"];
try {
    $user = $userModel->ViewUserById($userID);

    if (!$user) {
        exit("User not found.");
    }

} catch (PDOException $e) {
    exit("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | Lost &amp; Found</title>
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <main class="profile-card">
        <section class="profile-header" aria-labelledby="profile-title">
            <div class="header-top">
                <h1 id="profile-title">My Profile</h1>
            </div>  
        </section>

        <section class="profile-content" aria-labelledby="personal-info-title">
            <h2 id="personal-info-title">Personal Information</h2>
            <dl class="details-grid">
                <div class="detail">
                    <dt>Full Name</dt>
                    <dd><?php echo $user["fullname"]?></dd>
                </div>
                <div class="detail">
                    <dt>Email</dt>
                    <dd><?php echo $user["email"]?></dd>
                </div>
                <div class="detail">
                    <dt>Role</dt>
                    <dd><?php echo $user["role"]?></dd>
                </div>
                <div class="detail">
                    <dt>Account Created</dt>
                    <dd><?php echo $user["created_at"]?></dd>
                </div>
            </dl>

            <div class="account-settings">
                <div class="settings-heading">
                    <h2>Account Settings</h2>
                    <i class="fa-solid fa-gear" aria-hidden="true"></i>
                </div>
            </div>

            <a class="back-link" href="dashboard.php">
                <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                Back to Dashboard
            </a>
        </section>
    </main>
</body>
</html>