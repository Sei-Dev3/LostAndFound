<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/report-item.css">
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
        <h1>Report Lost Items</h1>
        <p>Submit a report for an item you've lost.</p>
</div>
        <div class="fillout">
        <div class="fillout-container">
        <div class="inputs">
            <div class="column">
                <div class="label-input">
                <label>Item Name</label>
                <input type="text" placeholder="e.g Black wallet, iphone 13, Backpack">
                </div>
                <div class="label-input">
                <label>Category</label>
                 <select name="category" id="category">
                    <option value="" disabled selected>Select Category</option>
                    <option value="bags">Bags</option>
                    <option value="electronics">Electronics</option>
                    <option value="wallets">Wallets</option>
                    <option value="keys">Keys</option>
                    <option value="clothing">Clothing</option>
                    <option value="others">Others</option>
                 </select>
                </div>
            </div>
            <div class="column">
                <div class="label-input">
                <label>Location</label>
                 <select name="location" id="location">
                    <option value="" disabled selected>Select Location</option>
                    <option value="Library">Library</option>
                    <option value="canteen">Canteen</option>
                    <option value="classroom">Classroom</option>
                 </select>
                </div>
                <div class="label-input">
                <label>Date Lost</label>
                <input type="date">
                </div>
        </div>
        <div class="column">
                <div class="label-input">
                <label>Description</label>
                <textarea
                    name="description"
                    id="description"
                    placeholder="Provide a detailed description of the item."
                    row="4"></textarea>
                </div>
        </div>
            <div class="label-input photo-field">
                <div class="labels">
                <label>Item Photo <span class="required">(optional)</span></label>
</div>
                <label for="item-photo" class="upload-container">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <p>Click to upload or drag and drop</p>
                    <span>PNG, JPG or JPEG (Max 5MB)</span>
                    <input type="file"
                        id="item-photo"
                        name="item_photo"
                        hidden
                        required>
                </label>
                </div>
                <hr class="devider">
                <div class="submit-cancel-btn">
                    <button type="button" class="cancel">
                        Cancel</button>
                    <button type="button" class="submit">
                        <i class="fa-solid fa-paper-plane"></i>
                        Submit</button>
                </div>
            </div>
        </div>
</main>
</div>
</body>
</html>