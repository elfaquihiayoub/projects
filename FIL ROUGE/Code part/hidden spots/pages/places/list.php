<?php
require_once __DIR__ . '/../../includes/auth_check.php';
require_once __DIR__ . '/../../classes/Place.php';

$place = new Place();
$categories = $place->getAllCategories();

// Get current page number
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$placesPerPage = 12;

// Get search parameters
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$category_id = isset($_GET['category']) ? (int)$_GET['category'] : 0;

// Get places: use search() only when filters are active, otherwise getAllPlaces()
if (!empty($keyword) || (!empty($category_id) && $category_id !== 'all')) {
    $places = $place->search($keyword, $category_id);
} else {
    $places = $place->getAllPlaces($page, $placesPerPage);
}

$pageTitle = 'Explore Places - Hidden Spots Finder';
?>
<?php require_once __DIR__ . '/../../includes/header.php'; ?>

<div class="container">
    <div class="page-header">
        <h1>Explore Places</h1>
        <p>Discover hidden gems from around the world</p>
    </div>

    <!-- Search Bar -->
    <div class="search-bar">
        <span style="color: var(--text-muted);">&#128269;</span>
        <input type="text" id="searchInput" placeholder="Search places..." autocomplete="off">
    </div>

    <!-- Category Filters -->
    <div class="filter-tabs">
        <button class="filter-tab active" data-category="all">All</button>
        <?php foreach ($categories as $category): ?>
            <button class="filter-tab" data-category="<?php echo $category['id']; ?>">
                <?php echo htmlspecialchars($category['name']); ?>
            </button>
        <?php endforeach; ?>
    </div>

    <!-- Places Grid -->
    <div id="placesGrid" class="places-grid">
        <?php if (!empty($places)): ?>
            <?php foreach ($places as $p): ?>
                <div class="place-card" data-category="<?php echo $p['category_id']; ?>">
                    <a href="details.php?id=<?php echo $p['id']; ?>">
                        <img src="<?php echo !empty($p['image']) ? '../../' . htmlspecialchars($p['image']) : '../../assets/images/placeholder.jpg'; ?>"
                             alt="<?php echo htmlspecialchars($p['name']); ?>"
                             class="place-card-img">
                    </a>
                    <div class="place-card-body">
                        <span class="card-category"><?php echo htmlspecialchars($p['category_name'] ?? ''); ?></span>
                        <h3 class="place-card-title">
                            <a href="details.php?id=<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['name']); ?></a>
                        </h3>
                        <div class="place-card-info">
                            <span>&#9679;</span>
                            <span><?php echo htmlspecialchars($p['location_name'] ?? 'Unknown'); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state" style="grid-column: 1 / -1;">
                <p>No places found.</p>
                <a href="add.php" class="btn btn-primary">Share the First Hidden Spot</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php
    $totalPlaces = $place->countAllPlaces();
    $totalPages = ceil($totalPlaces / $placesPerPage);

    // Build query string preserving filters
    $_qs = [];
    if (!empty($keyword)) $_qs['keyword'] = urlencode($keyword);
    if (!empty($category_id)) $_qs['category'] = $category_id;
    $_queryString = !empty($_qs) ? '&' . http_build_query($_qs) : '';

    if ($totalPages > 1):
    ?>
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?><?php echo $_queryString; ?>">Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <?php if ($i === $page): ?>
                    <span class="active"><?php echo $i; ?></span>
                <?php else: ?>
                    <a href="?page=<?php echo $i; ?><?php echo $_queryString; ?>"><?php echo $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?php echo $page + 1; ?><?php echo $_queryString; ?>">Next</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<script src="<?php echo $base; ?>assets/js/search.js"></script>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
