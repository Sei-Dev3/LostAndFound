<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/student-dashboard.css">
    <link rel="stylesheet" href="../css/my-report.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
>
</head>
<body>
    <div class="layout">
        <?php include 'C:/xampp/htdocs/LostAndFound/include/student-navbar.php'; ?>
        <main class="dashboard-content">
            <div class="topbar">
                <button class="menu-btn" onclick="showSidebar()" type="button">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" placeholder="Search items...">
</div>
        <div class="topbar-action">
            <button type="button" class="notification">
                    <i class="fa-solid fa-bell"></i>
                    <!-- <span class="notification-badge">3</span> -->
                    </button>
                <button type="button" class="circle-profile">
</button>
</div>
</div>
    <div class="title-heading">
        <h1>My Claims</h1>
        <p>Track the status of your claims.</p>
</div>

        <div class="card">
            <div class="card-container">
                <i class="fa-solid fa-file-lines"></i>
                <p>Total Claims</p>
                <h3>23</h3>
                <p>All your submitted reports</p>
            </div>
            <div class="card-container">
                <i class="fa-solid fa-circle-exclamation"></i>
                <p>Pending</p>
                <h3>12</h3>
                <p>Awaiting review</p>
            </div>
            <div class="card-container">
                <i class="fa-solid fa-check-circle"></i>
                <p>Approved</p>
                <h3>18</h3>
                <p>Successfully claimed</p>
            </div>
            <div class="card-container">
                <i class="fa-solid fa-clock"></i>
                <p>Manual Verification</p>
                <h3>10</h3>
                <p>Report submitted this week</p>
            </div>
        </div>
        <div class="report">
    <div class="submitted-report">
            <div class="report-headings">
            <h3>Your Submitted Reports</h3>
            <select name="status" id="status">
                <option value="" disabled selected>Status</option>
                <option>Approved</option>
                <option>Pending</option>
                <option>Manual Verification</option>
            </select>
</div>
            <div class="descrip">
                <p>Item Photo</p>
                <p>Item Name</p>
                <p>Claim Date</p>
                <p>Status</p>
                <p>Action</p>
</div>

            <div class="empty-state">
                <i class="fa-regular fa-folder-open"></i>
                <h3>No More Claims</h3>
                <p>You haven't submitted any claim request yet.</p>
</div>
            </div>
</div>
</div>
</main>
</div>
</body>
</html>