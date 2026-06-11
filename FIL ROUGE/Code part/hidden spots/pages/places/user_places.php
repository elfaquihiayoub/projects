<?php

require_once "../includes/auth_check.php";
require_once "../includes/csrf.php";
require_once "../classes/Place.php";

$placeObj = new Place();

$user_id = $_SESSION['user_id'];

// Pagination
$perPage = 12;
$currentPage = max(1, (int) ($_GET['page'] ?? 1));
$totalPlaces = $placeObj->countPlacesByUser($user_id);
$totalPages = max(1, (int) ceil($totalPlaces / $perPage));

if ($currentPage > $totalPages) {
    $currentPage = $totalPages;
}

$places = $placeObj->getPlacesByUser($user_id, $currentPage, $perPage);

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

<a href="places/add.php">Add New Place</a> |
<a href="../profil.php">My Profile</a> |
<a href="../../actions/logout.php">Logout</a>

<hr>

<?php if (!empty($places)): ?>

    <?php foreach ($places as $place): ?>

        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">

            <img src="../<?php echo htmlspecialchars($place['image']); ?>" width="120">

            <h3><?php echo htmlspecialchars($place['name']); ?></h3>

            <p><?php echo htmlspecialchars($place['category_name']); ?></p>

            <a href="places/details.php?id=<?php echo $place['id']; ?>">View</a>
            <a href="places/edit.php?id=<?php echo $place['id']; ?>">Edit</a>

           <form method="POST" action="../../actions/place.php" style="display:inline;"
             onsubmit="return confirm('Are you sure?')">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?php echo $place['id']; ?>">
                <input type="hidden" name="_csrf_token" value="<?php echo generateCsrfToken(); ?>">
                <button type="submit">Delete</button>
            </form>

        </div>

    <?php endforeach; ?>

<?php else: ?>

    <p>You have no places yet.</p>

<?php endif; ?>

<!-- PAGINATION -->
<?php if ($totalPages > 1): ?>
    <div style="margin: 20px 0; text-align: center;">

        <?php if ($currentPage > 1): ?>
            <a href="?page=<?php echo $currentPage - 1; ?>">&laquo; Prev</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <?php if ($i === $currentPage): ?>
                <strong><?php echo $i; ?></strong>
            <?php else: ?>
                <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?php echo $currentPage + 1; ?>">Next &raquo;</a>
        <?php endif; ?>

    </div>
<?php endif; ?>

</body>
</html>