<?php

require_once "../includes/auth_check.php";
require_once "../includes/csrf.php";
require_once "../classes/Place.php";
require_once "../classes/Favorite.php";

$placeObj = new Place();
$favoriteObj = new Favorite();

$user_id = $_SESSION['user_id'];

/* USER PLACES */
$placesCount = $placeObj->countPlacesByUser($user_id);
$myPlaces = $placeObj->getPlacesByUser($user_id, 1, 5); // show latest 5 on profile

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

            <form method="POST" action="../actions/place.php" style="display:inline;"
              onsubmit="return confirm('Are you sure?')">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?php echo $place['id']; ?>">
                <input type="hidden" name="_csrf_token" value="<?php echo generateCsrfToken(); ?>">
                <button type="submit">Delete</button>
            </form>

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

            <form method="POST" action="../actions/favorite.php" style="display:inline;">
                <input type="hidden" name="action" value="remove">
                <input type="hidden" name="place_id" value="<?php echo $place['id']; ?>">
                <input type="hidden" name="_csrf_token" value="<?php echo generateCsrfToken(); ?>">
                <button type="submit">Remove from Favorites</button>
            </form>

        </div>

        <hr>

    <?php endforeach; ?>

<?php else: ?>
    <p>No favorite places yet.</p>
<?php endif; ?>

<hr>

<!-- ACTIONS -->
<h3>Quick Actions</h3>

<a href="profile/edit.php">Edit Profile</a><br>
<a href="user_places.php">My Places Page</a><br>
<a href="places/add.php">Add New Place</a><br>
<a href="../actions/logout.php">Logout</a>

</body>
</html>