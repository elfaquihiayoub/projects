<?php

require_once "../includes/auth_check.php";
require_once "../classes/Place.php";
require_once "../classes/Favorite.php";

$placeObj = new Place();
$favoriteObj = new Favorite();

$user_id = $_SESSION['user_id'];

/* USER PLACES */
$myPlaces = $placeObj->getPlacesByUser($user_id);
$placesCount = count($myPlaces);

/* FAVORITES */
$favoritePlaces = $favoriteObj->getUserFavorites($user_id);
$favoriteCount = count($favoritePlaces);

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
<p><strong>Favorites:</strong> <?php echo $favoriteCount; ?></p>

<hr>

<!-- MY PLACES -->
<h3>My Places</h3>

<?php if (!empty($myPlaces)): ?>

    <?php foreach ($myPlaces as $place): ?>

        <div>

            <h4><?php echo htmlspecialchars($place['name']); ?></h4>

            <?php if (!empty($place['image'])): ?>
                <img src="../<?php echo htmlspecialchars($place['image']); ?>" width="120">
            <?php endif; ?>

            <br>

            <a href="places/details.php?id=<?php echo $place['id']; ?>">
                View
            </a>

            <a href="places/edit.php?id=<?php echo $place['id']; ?>">
                Edit
            </a>

            <a href="../actions/place.php?action=delete&id=<?php echo $place['id']; ?>">
                Delete
            </a>

        </div>

        <hr>

    <?php endforeach; ?>

<?php else: ?>
    <p>You haven't added any places yet.</p>
<?php endif; ?>

<hr>

<!-- FAVORITES -->
<h3>My Favorites</h3>

<?php if (!empty($favoritePlaces)): ?>

    <?php foreach ($favoritePlaces as $place): ?>

        <div>

            <h4><?php echo htmlspecialchars($place['name']); ?></h4>

            <?php if (!empty($place['image'])): ?>
                <img src="../<?php echo htmlspecialchars($place['image']); ?>" width="120">
            <?php endif; ?>

            <br>

            <a href="places/details.php?id=<?php echo $place['id']; ?>">
                View
            </a>

            <a href="../actions/favorite.php?action=remove&place_id=<?php echo $place['id']; ?>">
                Remove from Favorites 
            </a>

        </div>

        <hr>

    <?php endforeach; ?>

<?php else: ?>
    <p>No favorite places yet.</p>
<?php endif; ?>

<hr>

<!-- ACTIONS -->
<h3>Quick Actions</h3>

<a href="user_places.php">My Places Page</a><br>
<a href="places/add.php">Add New Place</a>

</body>
</html>