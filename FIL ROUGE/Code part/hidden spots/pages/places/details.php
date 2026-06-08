<?php
require_once "../../includes/auth_check.php";
require_once "../../classes/Place.php";
require_once "../../classes/Favorite.php";
// get place id from url

$id=$_GET['id'] ?? null;
if(!$id){
    header("Location: list.php");
    exit;
}

$placeObj=new Place();
$favoriteObj = new Favorite();

$place=$placeObj->getPlaceById($id);
$isFavorite = $favoriteObj->isFavorite($_SESSION['user_id'], $place['id']);

if(!$place){
   echo "place not found";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place details</title>
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
    <h3>Images</h3>
        <?php if (!empty($place['images'])): ?>
            <?php foreach ($place['images'] as $img): ?>
                <img src="../../<?php echo htmlspecialchars($img); ?>" width="200" style="margin:10px;">
            <?php endforeach; ?>
        <?php else: ?>

            <!-- Placeholder -->
            <img src="../../assets/images/placeholder.jpg" width="200">

        <?php endif; ?>
        <?php if ($isFavorite): ?>

    `        <a href="../../actions/favorite.php?action=remove&place_id=<?php echo $place['id']; ?>">
                Remove from Favorites ❌
            </a>

        <?php else: ?>

            <a href="../../actions/favorite.php?action=add&place_id=<?php echo $place['id']; ?>">
                Add to Favorites ❤️
            </a>

        <?php endif; ?>
`
        <hr>

        <a href="list.php">← Back to list</a>
</body>
</html>
