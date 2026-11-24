
<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: ../auth/admin-login.php");
    exit();
}

require_once __DIR__ . '/../vendor/autoload.php';
use App\Models\Location;

$locationModel = new Location();
$locations = [];
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["add"])) {
        $locationName = trim($_POST["LocationName"] ?? "");
        if ($locationName === "") {
            $message = "Please enter a location name.";
        } else {
            $locationModel->addLocation($locationName);
            header("Location: manage-location.php");
            exit();
        }
    } elseif (isset($_POST["update"])) {
        $locationID = $_POST["LocationID"];
        $locationName = trim($_POST["LocationName"] ?? "");
        if ($locationName === "") {
            $message = "Please enter a location name.";
        } else {
            $locationModel->updateLocation($locationID, $locationName);
            header("Location: manage-location.php");
            exit();
        }
    } elseif (isset($_POST["delete"])) {
        $locationID = $_POST["LocationID"];
        $locationModel->deleteLocation($locationID);
        header("Location: manage-location.php");
        exit();
    }
}
$editLocation = null;
if (isset($_GET["edit"])) {
    $editLocation = $locationModel->getById($_GET["edit"]);
}
try {
    $locations = $locationModel->getAll();
} catch (PDOException $e) {
    $message = "Unable to load locations.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Location</title>
    <link rel="stylesheet" href="../css/manage-location.css">
</head>
<body>
<div class="layout">
    <?php include 'C:/xampp/htdocs/LostAndFound/include/admin-navbar.php'; ?>
    <main class="dashboard-content">
        <div class="page-header">
            <h2>Manage Locations</h2>
            <p>Manage item locations in your Lost and Found system.</p>
        </div>

        <?php if ($message !== "") { ?>
            <p class="message">
                <?php echo htmlspecialchars($message); ?>
            </p>
        <?php } ?>
        <div class="location-form">
            <h3>
                <?php
                if ($editLocation) {
                    echo "Edit Location";
                } else {
                    echo "Add New Location";
                }
                ?>
            </h3>
            <form method="POST">
                <?php if ($editLocation) { ?>
                    <input type="hidden" name="LocationID"
                        value="<?php echo htmlspecialchars($editLocation["LocationID"]); ?>">
                <?php } ?>
                <label>Location Name</label>
                <input
                    type="text"
                    name="LocationName"
                    placeholder="Enter location name"
                    value="<?php
                        if ($editLocation) {
                            echo htmlspecialchars($editLocation["LocationName"]);
                        }
                    ?>"
                    required>
                <?php if ($editLocation) { ?>
                    <button type="submit" name="update">Update Location</button>
                    <a href="manage-location.php" class="cancel-btn">Cancel</a>
                <?php } else { ?>
                    <button type="submit" name="add">Add Location</button>
                <?php } ?>
            </form>
        </div>

        <div class="location-table">
            <h3>Location List</h3>
            <table>
                <thead>
                    <tr>
                        <th>Location ID</th>
                        <th>Location Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($locations)) { ?>
                    <tr>
                        <td colspan="3">No locations found.</td>
                    </tr>
                <?php } else { ?>
                    <?php foreach ($locations as $location) { ?>
                        <tr>
                            <td>
                                <?php echo htmlspecialchars($location["LocationID"]); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($location["LocationName"]); ?>
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="manage-location.php?edit=<?php echo $location["LocationID"]; ?>"
                                       class="edit-btn">Edit</a>
                                    <form method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this location?');">
                                        <input type="hidden" name="LocationID"
                                            value="<?php echo htmlspecialchars($location["LocationID"]); ?>">
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
