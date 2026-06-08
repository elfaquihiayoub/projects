<?php

require_once "../includes/auth_check.php";
require_once "../classes/Place.php";

$placeObj = new Place();

$user_id = $_SESSION['user_id'];

/* 🔥 GET USER STATS */
$myPlaces = $placeObj->getPlacesByUser($user_id);
$placesCount = count($myPlaces);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
</head>
<body>

<h2>My Profile</h2>

<!-- USER INFO -->
<p><strong>Username:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
<p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>

<hr>

<!-- STATS -->
<p><strong>Total Places:</strong> <?php echo $placesCount; ?></p>

<hr>

<!-- ACTIONS -->
<a href="user_places.php">My Places</a><br>
<a href="places/add.php">Add New Place</a>

</body>
</html>