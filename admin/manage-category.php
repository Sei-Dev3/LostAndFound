<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: ../auth/admin-login.php");
    exit();
}

require_once __DIR__ . '/../vendor/autoload.php';
use App\Models\Category;
$categoryModel = new Category();
$categories = [];
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["add"])) {
        $categoryName = trim($_POST["CategoryName"] ?? "");

        if ($categoryName === "") {
            $message = "Please enter a category name.";
        } else {
            $categoryModel->addCategory($categoryName);
            header("Location: manage-category.php");
            exit();
        }
    } elseif (isset($_POST["update"])) {
        $categoryID = $_POST["CategoryID"];
        $categoryName = trim($_POST["CategoryName"] ?? "");
        if ($categoryName === "") {
            $message = "Please enter a category name.";
        } else {
            $categoryModel->updateCategory($categoryID, $categoryName);
            header("Location: manage-category.php");
            exit();
        }
    } elseif (isset($_POST["delete"])) {
        $categoryID = $_POST["CategoryID"];
        $categoryModel->deleteCategory($categoryID);

        header("Location: manage-category.php");
        exit();
    }
}
$editCategory = null;
if (isset($_GET["edit"])) {
    $editCategory = $categoryModel->getById($_GET["edit"]);
}
try {
    $categories = $categoryModel->getAll();
} catch (PDOException $e) {
    $message = "Unable to load categories.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Category</title>
    <link rel="stylesheet" href="../css/haha.css">
</head>
<body>

<div class="layout">
    <?php include 'C:/xampp/htdocs/LostAndFound/include/admin-navbar.php'; ?>
    <main class="dashboard-content">
        <div class="page-header">
            <h2>Manage Categories</h2>
            <p>Manage item categories in your Lost and Found system.</p>
        </div>
        <?php if ($message !== "") { ?>
            <p class="message">
                <?php echo htmlspecialchars($message); ?>
            </p>
        <?php } ?>
        <div class="category-form">
            <h3>
                <?php
                if ($editCategory) {
                    echo "Edit Category";
                } else {
                    echo "Add New Category";
                }
                ?>
            </h3>
            <form method="POST">

                <?php if ($editCategory) { ?>
                    <input type="hidden" name="CategoryID"
                        value="<?php echo htmlspecialchars($editCategory["CategoryID"]); ?>">
                <?php } ?>
                <label>Category Name</label>
                <input
                    type="text"
                    name="CategoryName"
                    placeholder="Enter category name"
                    value="<?php
                        if ($editCategory) {
                            echo htmlspecialchars($editCategory["CategoryName"]);
                        }
                    ?>"
                    required>
                <?php if ($editCategory) { ?>
                    <button type="submit" name="update">Update Category</button>
                    <a href="manage-category.php" class="cancel-btn">Cancel</a>
                <?php } else { ?>
                    <button type="submit" name="add">Add Category</button>
                <?php } ?>
            </form>
        </div>
        <div class="category-table">
            <h3>Category List</h3>
            <table>
                <thead>
                    <tr>
                        <th>Category ID</th>
                        <th>Category Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($categories)) { ?>
                    <tr>
                        <td colspan="3">No categories found.</td>
                    </tr>
                <?php } else { ?>
                    <?php foreach ($categories as $category) { ?>
                        <tr>
                            <td>
                                <?php echo htmlspecialchars($category["CategoryID"]); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($category["CategoryName"]); ?>
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="manage-category.php?edit=<?php echo $category["CategoryID"]; ?>"
                                       class="edit-btn">Edit</a>
                                    <form method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this category?');">
                                        <input type="hidden" name="CategoryID"
                                            value="<?php echo htmlspecialchars($category["CategoryID"]); ?>">
                                        <button type="submit" name="delete"
                                            class="delete-btn">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

</body>
</html>