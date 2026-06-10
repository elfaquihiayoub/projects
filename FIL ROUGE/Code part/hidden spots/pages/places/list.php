<?php
require_once "../../includes/auth_check.php";
require_once "../../classes/Place.php";

$placeObj = new Place();
$places = $placeObj->getAllPlaces();
$categories = $placeObj->getAllCategories();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Places</title>
</head>
<body>

<h2>All Places</h2>

<a href="add.php">Add New Place</a>

<hr>

<!-- 🔍 SEARCH UI (NO PHP FILTERING) -->
<form id="searchForm">

    <input type="text" id="keyword" placeholder="Search by name">

    <select id="category_id">
        <option value="">All Categories</option>

        <?php foreach ($categories as $cat): ?>
            <option value="<?php echo $cat['id']; ?>">
                <?php echo htmlspecialchars($cat['name']); ?>
            </option>
        <?php endforeach; ?>

    </select>

</form>

<hr>

<!-- 📦 RESULTS CONTAINER -->
<div id="placesContainer">

    <?php foreach ($places as $place): ?>

        <div style="border:1px solid #ccc; padding:10px; margin:10px; width:300px; display:inline-block;">

            <img 
                src="../../<?php echo !empty($place['image']) 
                    ? htmlspecialchars($place['image']) 
                    : 'assets/images/placeholder.jpg'; ?>" 
                width="100%" height="150">

            <h3><?php echo htmlspecialchars($place['name']); ?></h3>

            <p><?php echo htmlspecialchars($place['category_name']); ?></p>

            <small>By <?php echo htmlspecialchars($place['username']); ?></small>

            <br><br>

            <a href="details.php?id=<?php echo $place['id']; ?>">
                View Details →
            </a>

        </div>

    <?php endforeach; ?>

</div>

</body>
</html>
<script src="../../assets/js/search.js"></script>