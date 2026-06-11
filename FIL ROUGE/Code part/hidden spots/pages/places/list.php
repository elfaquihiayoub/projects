<?php
require_once "../../includes/auth_check.php";
require_once "../../classes/Place.php";

$placeObj = new Place();

// Pagination
$perPage = 12;
$currentPage = max(1, (int) ($_GET['page'] ?? 1));
$totalPlaces = $placeObj->countAllPlaces();
$totalPages = max(1, (int) ceil($totalPlaces / $perPage));

// Clamp page to valid range
if ($currentPage > $totalPages) {
    $currentPage = $totalPages;
}

$places = $placeObj->getAllPlaces($currentPage, $perPage);
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

<a href="add.php">Add New Place</a> |
<a href="../profil.php">My Profile</a> |
<a href="../../actions/logout.php">Logout</a>

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
<script src="../../assets/js/search.js"></script>