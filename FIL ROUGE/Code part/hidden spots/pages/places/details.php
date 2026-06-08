<?php

require_once "../../includes/auth_check.php";
require_once "../../classes/Place.php";
require_once "../../classes/Favorite.php";
require_once "../../classes/Review.php";

/* 1. GET PLACE ID */
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: list.php");
    exit;
}

/* 2. INIT CLASSES */
$placeObj = new Place();
$favoriteObj = new Favorite();
$reviewObj = new Review();

/* 3. GET PLACE */
$place = $placeObj->getPlaceById($id);

if (!$place) {
    echo "Place not found";
    exit;
}

/* 4. USER ID */
$user_id = $_SESSION['user_id'];

/* 5. FAVORITE STATUS */
$isFavorite = $favoriteObj->isFavorite($user_id, $place['id']);

/* 6. REVIEWS DATA */
$userReview = $reviewObj->getUserReview($user_id, $place['id']);
$allReviews = $reviewObj->getByPlace($place['id']);
$avgRating = $reviewObj->getAverageRating($place['id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Place Details</title>
</head>
<body>

<h2><?php echo htmlspecialchars($place['name']); ?></h2>

<p><strong>Category:</strong> <?php echo htmlspecialchars($place['category_name']); ?></p>
<p><strong>Added by:</strong> <?php echo htmlspecialchars($place['username']); ?></p>
<p><strong>Location:</strong> <?php echo htmlspecialchars($place['location_name']); ?></p>

<p>
    <strong>Description:</strong><br>
    <?php echo nl2br(htmlspecialchars($place['description'])); ?>
</p>

<hr>

<!-- ⭐ AVERAGE RATING -->
<h3>Rating</h3>
<p>
    Average: <?php echo number_format($avgRating, 1); ?> / 5
</p>

<hr>

<!-- 🖼️ IMAGES -->
<h3>Images</h3>

<?php if (!empty($place['images'])): ?>

    <?php foreach ($place['images'] as $img): ?>
        <img src="../../<?php echo htmlspecialchars($img); ?>" width="200" style="margin:10px;">
    <?php endforeach; ?>

<?php else: ?>

    <img src="../../assets/images/placeholder.jpg" width="200">

<?php endif; ?>

<hr>

<!-- ❤️ FAVORITE BUTTON -->
<h3>Favorites</h3>

<?php if ($isFavorite): ?>

    <a href="../../actions/favorite.php?action=remove&place_id=<?php echo $place['id']; ?>">
        Remove from Favorites ❌
    </a>

<?php else: ?>

    <a href="../../actions/favorite.php?action=add&place_id=<?php echo $place['id']; ?>">
        Add to Favorites ❤️
    </a>

<?php endif; ?>

<hr>

<!-- ⭐ REVIEW FORM -->
<h3>Your Review</h3>

<form method="POST" action="../../actions/review.php">

    <input type="hidden" name="place_id" value="<?php echo $place['id']; ?>">

    <label>Rating (1-5):</label>
    <input type="number" name="rating"
           value="<?php echo $userReview['rating'] ?? ''; ?>"
           min="1" max="5" required>

    <br><br>

    <label>Comment:</label>
    <textarea name="comment"><?php echo htmlspecialchars($userReview['comment'] ?? ''); ?></textarea>

    <br><br>

    <input type="hidden" name="action" value="save">

    <button type="submit">
        <?php echo $userReview ? "Update Review" : "Add Review"; ?>
    </button>

</form>

<?php if ($userReview): ?>

<form method="POST" action="../../actions/review.php">
    <input type="hidden" name="place_id" value="<?php echo $place['id']; ?>">
    <input type="hidden" name="action" value="delete">

    <button type="submit">Delete My Review</button>
</form>

<?php endif; ?>

<hr>

<!-- ⭐ ALL REVIEWS -->
<h3>All Reviews</h3>

<?php if (!empty($allReviews)): ?>

    <?php foreach ($allReviews as $r): ?>

        <div>

            <p><strong><?php echo htmlspecialchars($r['username']); ?></strong></p>

            <p>Rating: <?php echo $r['rating']; ?>/5</p>

            <p><?php echo nl2br(htmlspecialchars($r['comment'])); ?></p>

            <small><?php echo $r['created_at']; ?></small>

        </div>

        <hr>

    <?php endforeach; ?>

<?php else: ?>

    <p>No reviews yet.</p>

<?php endif; ?>

<hr>

<a href="list.php">← Back to list</a>

</body>
</html>