<?php 

require_once __DIR__. '/../vendor/autoload.php';
use App\Models\Authentication;
$message= "";
if(isset($_POST["sub"])){
    $fullname=$_POST["fullname"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $confirmpassword=$_POST["confirmpassword"];

     
    $auth=new Authentication();
    $message=$auth->signup($fullname, $email, $password, $confirmpassword);
    if($message == "Account created successfully!"){
        header("Location: login.php");
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
    
<div class="half-signup">
    <div class="title-text">
        <h2>Lost & Found</h2>
    </div>
    <div class="welcome">
        <h1>Lost Something?</h1>
        <h1>Letsfind it together.<h1>
    </div>
</div>

<div class="container">
    <h2>Create an Account</h2>
    <form method="POST">
    <div class="insight">
        <div class="label-icon">
            <i class="fa-solid fa-user"></i>
            <label for="email2">Fullname:</label>
        </div>
            <input type="text" name="fullname" id="fullname" placeholder="Enter your fullname" required>
        </div>
        <div class="insight">
            <div class="label-icon">
            <i class="fa-solid fa-envelope"></i>
            <label for="password">Email Address:</label>
</div>
            <input type="email" name="email" id="email" placeholder="Email" required>
        </div>
        <div class="insight">
            <div class="label-icon">
            <i class="fa-solid fa-lock"></i>
            <label for="password">Password:</label>
</div>
            <input type="password" name="password" id="password" placeholder="Password" required>
        </div>
        <div class="insight">
            <div class="label-icon">
            <i class="fa-solid fa-lock"></i>
            <label for="password">Confirm Password:</label>
</div>
            <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm your password" required>
            <?php 
            if($message !== ""){
                echo "<p>$message</p>";
            }
            ?>
        </div>

        <button type="submit" name="sub" class="create-acc" href="login.php">Sign Up</button>
</form>
        <div class="log">
        <p class="text">Already have an Account?</p>
            <a href="../auth/login.php">Log In</a>
        </div>
        </div>

</body>
</html>