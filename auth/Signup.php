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
        </div>

        <div class="radio-btn">
            <h4>Role</h4>
            <input type="radio" id="student" value="checked" required>
            <label for="container">Student</label>
            <input type="radio" name="staff" value="checked" required>
            <label for="container">Staff</label>
</div>
        <button type="submit" class="create-acc">Sign Up</button>
        <p>--------------------------or--------------------------<p>
        <button type="button" class="google-btn">
            <img src="../pictures/google.webp" alt="Google logo">
            Sign up with Google
        </button>
        <div class="log">
        <p class="text">Already have an Account?</p>
            <a href="../auth/login.php">Log In</a>
        </div>
        </div>

</body>
</html>