<?php 
session_start();
if (!isset($_SESSION["email"])) {
     header("Location: ../auth/admin-login.php");
    exit();
}

require_once __DIR__. '/../vendor/autoload.php';
use App\Models\User;
$userID=$_SESSION["UserID"];
$userModel=new User();
$user=$_GET["users"] ?? "";
try{
    if ($user === "") {
    $item = $userModel->getAllUsers();
}
else {
    $item = $userModel->getByRoles($user);
}
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
    <link rel="stylesheet" href="../css/manage-claim.css">
    <link rel="stylesheet" href="../css/manage-item.css">
    <link rel="stylesheet" href="../css/manage.css">
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
        <h1>Manage Users</h1>
        <p>View, edit, and manage all users.</p>
</div>
</div>
        <div class="users-layout-container">
            <div class="users-container1">
            <div class="users-filter">
            <form method="GET" action="manage-users.php">
            <select name="users" onchange="this.form.submit()">
                <option value="">All Roles</option>
                <option value="User" <?php if ($user == "User") echo "selected"; ?>>User</option>
                <option value="Admin" <?php if ($user == "Admin") echo "selected"; ?>>Admin</option>
            </select>
</form>
</div>
</div>
            <div class="users-container2">
                <table>
                <tr>
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
                <h3>No Users Yet</h3>
                <p>There are no users to display.</p>
</div>
</td>
</tr>
                <?php }else{
                        foreach($item as $i){
                ?>
                <tr>
                    <td><?php echo $i["fullname"]?>
                </td>
                <td><?php echo $i["email"]?></td>
                <td>
                <?php echo $i["role"]?>
</td>
                    
                    <td><?php echo $i["created_at"]?></td>
                    <td>
                        <a href="viewbyuser.php?id=<?php echo $i["UserID"]; ?>" class="view-btn">
                            View
                        </a>
                        <a href="delete-user.php?id=<?php echo $i['UserID']; ?>"
                            onclick="return confirm('Are you sure you want to delete this user?')"
                    class="delete-option"> Delete
</a></td>
                </tr>
                 <?php }}?>
            </table>
            </div>
</div>
</main>
</div>
</body>
</html>