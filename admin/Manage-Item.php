<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/manage-item.css">
    <link rel="stylesheet" href="../css/student-dashboard.css">
    <link rel="stylesheet" href="../css/my-report.css">
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
            <button type="button" class="notification">
                    <i class="fa-solid fa-bell"></i>
                    <!-- <span class="notification-badge">3</span> -->
                    </button>
                <button type="button" class="circle-profile">
</button>
</div>
</div>
    <div class="manage-heading">
        <div class="heading-text">
        <h1>Manage Items</h1>
        <p>View, edit, and manage all found and lost items.</p>
</div>
<button type="button">+ Add item</button>
</div>
        <div class="layout-container">
            <div class="container1">
                <div class="search1">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" placeholder="Search items...">
            </div>
            <select name="location" id="location">
                    <option value="" disabled selected>All types</option>
                    <option value="Library">Library</option>
                    <option value="canteen">Canteen</option>
                    <option value="classroom">Classroom</option>
            </select>
            <select name="location" id="location">
                    <option value="" disabled selected>All Locations</option>
                    <option value="Library">Library</option>
                    <option value="canteen">Canteen</option>
                    <option value="classroom">Classroom</option>
            </select>
            <select name="location" id="location">
                    <option value="" disabled selected>All Status</option>
                    <option value="Library">Library</option>
                    <option value="canteen">Canteen</option>
                    <option value="classroom">Classroom</option>
            </select>
            <select name="location" id="location">
                    <option value="" disabled selected>All Categories</option>
                    <option value="Library">Library</option>
                    <option value="canteen">Canteen</option>
                    <option value="classroom">Classroom</option>
            </select>
</div>
            <div class="container2">
                <div class="container-navbar">
                    <p>#</p>
                    <p>Item Photo</p>
                    <p>Item Name</p>
                    <p>Item Type</p>
                    <p> Category</p>
                    <p>Location</p>
                    <p>Date Reported</p>
                    <p>Status</p>
                    <p>Action</p>
                </div>
                <div class="empty-state">
                <i class="fa-regular fa-folder-open"></i>
                <h3>No Items Yet</h3>
                <p>There are no lost or found items to display.</p>
</div>
            </div>
</div>
</main>
</div>
</body>
</html>