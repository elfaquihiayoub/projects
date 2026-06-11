<?php
require_once "../../includes/auth_check.php";
require_once "../../includes/csrf.php";
require_once "../../classes/Place.php";

$placeObj = new Place();
$categories = $placeObj->getAllCategories();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Place</title>
</head>
<body>

<h2>Add New Place</h2>
<!-- if there is an error message , show it and clear session error -->
<?php
if (isset($_SESSION['error'])) {
    echo "<p>" . htmlspecialchars($_SESSION['error']) . "</p>";
    unset($_SESSION['error']);
}
?>

<form action="../../actions/place.php" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="action" value="add">
    <input type="hidden" name="_csrf_token" value="<?php echo generateCsrfToken(); ?>">

    <!-- NAME -->
    <label>place name :</label><br>
    <input type="text" name="name" required><br><br>
      <!-- CATEGORY -->
    <label>Category:</label><br>
    <select name="category_id" required>
        <option value="">Select category</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?php echo $cat['id']; ?>">
                <?php echo htmlspecialchars($cat['name']); ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <!-- LOCATION NAME -->
    <label>Location Name:</label><br>
    <input type="text" name="location_name"><br><br>
     <!-- LATITUDE -->
    <label>Latitude:</label><br>
    <input type="text" name="latitude" required><br><br>

    <!-- LONGITUDE -->
    <label>Longitude:</label><br>
    <input type="text" name="longitude" required><br><br>

    <!-- DESCRIPTION -->
    <label>Description:</label><br>
    <textarea name="description"></textarea><br><br>
    <!-- IMAGES -->
    <label>Images:</label><br>
    <input type="file" name="images[]" multiple><br><br>

    <!-- SUBMIT -->
    <button type="submit">Add Place</button>

</form>
<br>

<a href="list.php">← Back to list</a> |
<a href="../../actions/logout.php">Logout</a>

    
</body>
</html>