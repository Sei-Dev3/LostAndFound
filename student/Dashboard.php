<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/student-dashboard.css">
    <!-- http://localhost/LostAndFound/student/dashboard.php -->
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
        <div class="dashboard-grid">
            <div class="dashboard-top">
            <div class = "box-container">
        <div class = "box">
            <h1> Welcome to Lost & Found</h1>
            <p>Report lost items or check if your beongings have been found</p>
        </div>
    </div>
        <div class="container-layout">
            <div class="container">
                <i class="fa-solid fa-box"></i>
                <p>Total Lost Items</p>
                <h3>23</h3>
                <p>+1 this week</p>
            </div>
            <div class="container">
                <i class="fa-solid fa-bag-shopping"></i>
                <p>Total Found Items</p>
                <h3>12</h3>
                <p>+3 this week</p>
            </div>
            <div class="container">
                <i class="fa-solid fa-check-circle"></i>
                <p>Returned Items</p>
                <h3>18</h3>
                <p>+4 this week</p>
            </div>
            <div class="container">
                <i class="fa-solid fa-clock"></i>
                <p>Pending Claims</p>
                <h3>10</h3>
                <p>+5 this week</p>
            </div>
        </div>
        <div class="recent-listing">
            <div class="recent-header">
            <h3>Recent Listings</h3>
            <a href="view.php">View All →</a>
</div>
            <div class="btn">
            <button type="button" class="lost-item-btn">
                Lost Items
</button>
            <button type="button" class="found-item-btn">
                Found Items
            </button>
</div>
            <div class="descrip">
                <p>Photo</p>
                <p>Item Details</p>
                <p>Category</p>
                <p>Date Found/Lost</p>
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
            <div class="dashboard">
                <div class="quick-action">
                    <h3>Quick Action</h3>
                    <div class="buttons">
                    <button type="button" class="lost-btn">
                    <i class="fa-solid fa-circle-plus"></i> 
                    Report Lost Item</button>
                    <button type="button" class="found-btn">
                    <i class="fa-solid fa-file-lines"></i>
                    My Reports</button>
                    </div>
</div>
                    <div class="category">
                        <h3>Filter by Category</h3>
                        <button type="button" class="category-btn">
                            <i class="fa-solid fa-bag-shopping"></i>
                            Bags
                        </button>
                        <button type="button" class="category-btn">
                            <i class="fa-solid fa-mobile-screen"></i>
                            Electronics
                        </button>
                        <button type="button" class="category-btn">
                            <i class="fa-solid fa-wallet"></i>
                            Wallets
                        </button>
                        <button type="button" class="category-btn">
                            <i class="fa-solid fa-key"></i>
                            Keys
                        </button>
                        <button type="button" class="category-btn">
                            <i class="fa-solid fa-shirt"></i>
                            Clothing
                        </button>
                        <button type="button" class="category-btn">
                            <i class="fa-solid fa-ellipsis"></i>
                            Others
                        </button>
                </div>
                </div>
      </div>
        </main>
    </div>

</body>
</html>