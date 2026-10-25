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
        <h1>Welcome back!</h1>
    </div>
</div>

    <div class="container">
    <h2>Log In</h2>
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
        </div>
        <div class="check">
            <label>
                <input type="checkbox" name="policy" class="policy"> Remember Me
                </label>
                <a href="#">Forgot Password?</a>
        </div>
        <button type="submit" class="create-acc">Log In</button>
        <p>--------------------------or--------------------------<p>
        <button type="button" class="google-btn">
            <img src="../pictures/google.webp" alt="Google logo">
            Continue with Google
        </button>
        <div class="log">
        <p class="text">Don't have an account?</p>
            <a href="../auth/signup.php">Sign Up</a>
        </div>
        </div>

</body>
</html>