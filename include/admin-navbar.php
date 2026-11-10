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
                <li><a href="../admin/dashboard.php">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a></li>
                <li><a href="../admin/manage-item.php">
                    <i class="fa-solid fa-circle-plus"></i>
                    <span>Manage Item</span>
                </a></li>
                <li><a href="../admin/manage-users.php">
                    <i class="fa-solid fa-solid fa-users"></i>
                    <span>Manage Users</span>
                </a></li>
                <li><a href="../admin/manage-claim.php">
                    <i class="fa-solid fa-clipboard-check"></i>
                    <span>Manage Claims</span>
                </a></li>
                <li><a href="../admin/manage-categories.php">
                    <i class="fa-solid fa-solid fa-tags"></i>
                    <span>Manage Categories</span>
                </a></li>
                <li><a href="../admin/manage-location.php">
                    <i class="fa-solid fa-solid fa-location-dot"></i>
                    <span>Manage Locations</span>
                </a></li>
                <li><a href="../admin/report.php">
                    <i class="fa-solid fa-solid fa-chart-column"></i>
                    <span>Reports</span>
                </a></li>
                <li><a href="../student/settings.php">
                    <i class="fa-solid fa-gear"></i>
                    <span>Settings</span>
                </a></li>
                <li><a href="../auth/admin-logout.php">
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