<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/manage-item.css">
    <link rel="stylesheet" href="../css/student-dashboard.css">
    <link rel="stylesheet" href="../css/admin-dashboard.css">
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
        <h1>Admin Dashboard</h1>
        <p>Overview of the lost and found system.</p>
</div>
</div>
        <div class="admin-container-layout">
            <div class="admin-container">
                <i class="fa-solid fa-box"></i>
                <h3>23</h3>
                <h5>Total Lost Items</h5>
                <p>Lost and found records</p>
            </div>
            <div class="admin-container">
                <i class="fa-solid fa-clock"></i>
                <h3>12</h3>
                <h5>Pending Claims</h5>
                <p>Awaiting review</p>
            </div>
            <div class="admin-container">
                <i class="fa-solid fa-check-circle"></i>
                <h3>18</h3>
                <h5>Approved Claims</H5>
                <p>Successfully claimed</p>
            </div>
            <div class="admin-container">
                <i class="fa-solid fa-users"></i>
                <h3>10</h3>
                <h5>Total Users</h5>
                <p>Registered account</p>
            </div>
        </div>
        <div class="quick-action-container">
            <div class="quick-box">
                <h3>Quick Actions</h3>
                <div class="quick-btn-container">                
                    <div class="quick-btn">
                        <i class="fa-solid fa-circle-plus"></i>
                        <div class="text-btn">
                        <h3>Add Found Item</h3>
                        <p>Record a new found item</p>
                    </div>
</div>
                    <div class="quick-btn">
                        <i class="fa-solid fa-clipboard-list"></i>
                        <div class="text-btn">
                        <h3>Review Claims</h3>
                        <p>Process claim requests</p>
                    </div>
                    </div>
                    <div class="quick-btn">
                        <i class="fa-solid fa-users"></i>
                        <div class="text-btn">
                        <h3>Manage Users</h3>
                        <p>Manage registered accounts</p>
                    </div>
                    </div>
                <div class="quick-btn">
                    <i class="fa-solid fa-gear"></i>
                    <div class="text-btn">
                        <h3>Settings</h3>
                        <p>Configure system settings</p>
                    </div> 
                </div>
                </div>
</div>
        </div>
        <div class="box-layout">
            <div class="pending-claims">
            <div class="pending-header">
            <h3>Pending Claims</h3>
            <a href="view.php">View All Claims →</a>
</div>
            <div class="pending-descrip">
                <p>Claim ID</p>
                <p>Item Name</p>
                <p>Claim Date</p>
                <p>Status</p>
                <p>Action</p>
</div>

            <div class="pending-empty-state">
                <i class="fa-regular fa-folder-open"></i>
                <h3>No Claims Yet</h3>
                <p>There are no Claims to display.</p>
</div>
            </div>
            <div class="recent-activity">
                <div class="recent-admin">
                    <h3>Recent Activity</h3>
                    <a href="#">View All→</a>
                </div>
                <div class="item-activity">
                    <i class="fa-solid fa-box"></i>
                    <div class="activity-details">
                        <h4>New Lost Item Report</h4>
                        <p>Black Backpack submitted by user</p>
                    </div>
                    <span>2 hours ago</span>
                </div>
                <div class="item-activity">
                    <i class="fa-solid fa-check"></i>
                    <div class="activity-details">
                        <h4>Claim Approved</h4>
                        <p>Claim for an iphone</p>
                    </div>
                    <span>3 hours ago</span>
                </div>
                <div class="item-activity">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <div class="activity-details">
                        <h4>Manul Verification Required</h4>
                        <p>Claim for a Blue Wallet</p>
                    </div>
                    <span>5 hours ago</span>
                </div>
                <div class="item-activity">
                    <i class="fa-solid fa-gift"></i>
                    <div class="activity-details">
                        <h4>New Found Item</h4>
                        <p>Umbrella dound in the library</p>
                    </div>
                    <span>6 hours ago</span>
                </div>
            </div>
            
</div>
            </div>
        </div>
</div>
</main>
</div>
</body>
</html>