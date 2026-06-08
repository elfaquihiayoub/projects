<?php

require_once "../../includes/auth_check.php";
require_once "../../classes/Place.php";

$placeObj = new Place();

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: ../user_places.php");
    exit;
}

$place = $placeObj->getPlaceById($id);
$categories = $placeObj->getAllCategories();

if (!$place) {
    echo "Place not found";
    exit;
}

/* SECURITY: only owner can edit */
if ($place['user_id'] != $_SESSION['user_id']) {
    $_SESSION['error'] = "Unauthorized access.";
    header("Location: ../user_places.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Place</title>
</head>
<body>

<h2>Edit Place</h2>

<?php
if (isset($_SESSION['error'])) {
    echo "<p>" . htmlspecialchars($_SESSION['error']) . "</p>";
    unset($_SESSION['error']);
}
?>

<form action="../../actions/place.php" method="POST">

    <input type="hidden" name="action" value="update">
    <input type="hidden" name="id" value="<?php echo $place['id']; ?>">

    <!-- NAME -->
    <label>Name:</label><br>
    <input type="text" name="name"
           value="<?php echo htmlspecialchars($place['name']); ?>" required><br><br>

    <!-- CATEGORY -->
   <label>Category:</label><br>
    <select name="category_id" required>

        <?php foreach ($categories as $cat): ?>

            <option value="<?php echo $cat['id']; ?>"
                <?php echo ($cat['id'] == $place['category_id']) ? 'selected' : ''; ?>>

                <?php echo htmlspecialchars($cat['name']); ?>

            </option>

        <?php endforeach; ?>

    </select><br><br>

    <!-- LOCATION NAME -->
    <label>Location Name:</label><br>
    <input type="text" name="location_name"
           value="<?php echo htmlspecialchars($place['location_name']); ?>"><br><br>

    <!-- LATITUDE -->
    <label>Latitude:</label><br>
    <input type="text" name="latitude"
           value="<?php echo htmlspecialchars($place['latitude']); ?>"><br><br>

    <!-- LONGITUDE -->
    <label>Longitude:</label><br>
    <input type="text" name="longitude"
           value="<?php echo htmlspecialchars($place['longitude']); ?>"><br><br>

    <!-- DESCRIPTION -->
    <label>Description:</label><br>
    <textarea name="description"><?php echo htmlspecialchars($place['description']); ?></textarea><br><br>

    <button type="submit">Update Place</button>

</form>

<br>

<a href="../user_places.php">← Back</a>

</body>
</html>