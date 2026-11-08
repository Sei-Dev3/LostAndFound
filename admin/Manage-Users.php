<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/manage-item.css">
    <link rel="stylesheet" href="../css/student-dashboard.css">
    <link rel="stylesheet" href="../css/my-report.css">
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
        <h1>Manage Users</h1>
        <p>View, edit, and manage all users.</p>
</div>
</div>
        <div class="users-layout-container">
            <div class="users-container1">
                <div class="users-search1">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" placeholder="Search Users...">
            </div>
            <div class="users-filter">
            <select name="location" id="location">
                    <option value="" disabled selected>All Roles</option>
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
                    <option value="" disabled selected>All Users</option>
                    <option value="Library">Library</option>
                    <option value="canteen">Canteen</option>
                    <option value="classroom">Classroom</option>
            </select>
</div>
</div>
            <div class="users-container2">
                <div class="users-container-navbar">
                    <p>#</p>
                    <p>Profile</p>
                    <p>Name</p>
                    <p>Email</p>
                    <p>Role</p>
                    <p>Status</p>
                    <p>Date Registered</p>
                    <p>Action</p>
                </div>
                <div class="empty-state">
                <i class="fa-solid fa-solid fa-users"></i>
                <h3>No Users Yet</h3>
                <p>There are no users to display.</p>
</div>
            </div>
</div>
</main>
</div>
</body>
</html>