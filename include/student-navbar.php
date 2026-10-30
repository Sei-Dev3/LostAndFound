<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
>
</head>
<body>
     <header class="sidebar" id="sidebar">
        <nav>
            <button class="exit-btn" onclick="hideSidebar()" type="button">
                <i class="fa-solid fa-xmark"></i>
            </button>
                <div class="logo2">
                <h1>Lost & Found</h1>
                </div>
                     <ul>
                <li><a href="../student/dashboard.php">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a></li>
                <li><a href="../student/report-item.php">
                    <i class="fa-solid fa-circle-plus"></i>
                    <span>Report Item</span>
                </a></li>
                <li><a href="../student/my-reports.php">
                    <i class="fa-solid fa-file-lines"></i>
                    <span>My Reports</span>
                </a></li>
                <li><a href="../student/my-claim.php">
                    <i class="fa-solid fa-clipboard-check"></i>
                    <span>My Claim</span>
                </a></li>
                <li><a href="../student/message.php">
                    <i class="fa-solid fa-envelope"></i>
                    <span>Message</span>
                </a></li>
                <li><a href="../student/profile.php">
                    <i class="fa-solid fa-user"></i>
                    <span>Profile</span>
                </a></li>
                <li><a href="../student/settings.php">
                    <i class="fa-solid fa-gear"></i>
                    <span>Settings</span>
                </a></li>
                <li><a href="../student/logout.php">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Log Out</span>
                </a></li>
            </ul>

        </nav>
    </header>

    <script>
            function showSidebar() {
                document.getElementById('sidebar').classList.add('active');
            }

            function hideSidebar() {
                document.getElementById('sidebar').classList.remove('active');
            }
        </script>
</body>
</html> 