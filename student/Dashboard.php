<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <!-- http://localhost/LostAndFound/student/dashboard.php -->
</head>
<body>
    
   <div class="layout">
        <?php include 'C:/xampp/htdocs/LostAndFound/include/student-navbar.php'; ?>

        <main class="dashboard-content">
            <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" placeholder="Search items...">
            </div>
            <div class = "box-container">
        <div class = "box">
            <h1> Welcome to Lost & Found</h1>
            <p>Report lost items or check if your beongings have been found</p>
        </div>
    </div>
        </main>
    </div>
</body>
</html>