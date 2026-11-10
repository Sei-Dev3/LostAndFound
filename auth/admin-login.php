<?php 
session_start();

require_once __DIR__. '/../vendor/autoload.php';

use App\Models\Authentication;

$message = "";

if(isset($_POST["sub"])){
    $email=$_POST["email"];
    $password=$_POST["password"];

    $auth=new Authentication();
    $message=$auth->login($email, $password);
    
    if($message==="Login Successful"){
    $_SESSION["email"]=$email;
    header("Location: ../admin/dashboard.php");
    exit();
}
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../css/auth.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
>
</head>
<body>
<div class="half-login">
    <div class="title-text">
        <h2>Lost & Found</h2>
    </div>
    <div class="welcome">
        <h1>Welcome back! Admin</h1>
    </div>
</div>

    <div class="container">
    <h2>Log In</h2>
    <form method="POST">
        <div class="insight">
            <div class="label-icon">
            <i class="fa-solid fa-envelope"></i>
            <label for="email2">Email Address:</label>
</div>
            <input type="email" name="email" id="email" placeholder="Email" required>
        </div>
        <div class="insight">
            <div class="label-icon">
            <i class="fa-solid fa-lock"></i>
            <label for="password">Password:</label>
</div>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <?php 
            if($message !== ""){
                echo "<p>$message</p>";
            }
            ?>
        </div>
        <div class="check">
            <label>
                <input type="checkbox" name="policy" class="policy"> Remember Me
                </label>
                <a href="#">Forgot Password?</a>
        </div>
        <button type="submit" name="sub" class="create-acc">Log In</button>
        <div class="log">
        <p class="text">Don't have an account?</p>
            <a href="../auth/signup.php">Sign Up</a>
        </div>
</form>
        </div>

</body>
</html>