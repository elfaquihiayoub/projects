<?php

require_once "../includes/auth_check.php";
require_once "../classes/Place.php";

$placeObj = new Place();

$user_id = $_SESSION['user_id'];
$places = $placeObj->getPlacesByUser($user_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Places</title>
</head>
<body>

<h2>My Places</h2>

<?php
if (isset($_SESSION['success'])) {
    echo "<p>" . htmlspecialchars($_SESSION['success']) . "</p>";
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    echo "<p>" . htmlspecialchars($_SESSION['error']) . "</p>";
    unset($_SESSION['error']);
}
?>

<a href="places/add.php">Add New Place</a>

<hr>

<?php if (!empty($places)): ?>

    <?php foreach ($places as $place): ?>

        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">

            <img src="../<?php echo htmlspecialchars($place['image']); ?>" width="120">

            <h3><?php echo htmlspecialchars($place['name']); ?></h3>

            <p><?php echo htmlspecialchars($place['category_name']); ?></p>

            <a href="places/details.php?id=<?php echo $place['id']; ?>">View</a>
            <a href="places/edit.php?id=<?php echo $place['id']; ?>">Edit</a>

           <a href="places/delete.php?id=<?php echo $place['id']; ?>"
             onclick="return confirm('Are you sure?')">
                Delete
            </a>

        </div>

    <?php endforeach; ?>

<?php else: ?>

    <p>You have no places yet.</p>

<?php endif; ?>

</body>
</html>