<?php
require_once __DIR__ . '/../../includes/auth_check.php';
require_once __DIR__ . '/../../includes/csrf.php';
require_once __DIR__ . '/../../classes/Place.php';

$place = new Place();
$userId = $_SESSION['user_id'];

// Get current page number
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$placesPerPage = 12;

// Get user's places
$places = $place->getPlacesByUser($userId, $page, $placesPerPage);
$totalPlaces = $place->countPlacesByUser($userId);
$totalPages = ceil($totalPlaces / $placesPerPage);

$pageTitle = 'My Places - Hidden Spots Finder';
?>
<?php require_once __DIR__ . '/../../includes/header.php'; ?>

<div class="container">
    <div class="page-header">
        <div class="flex-between" style="max-width: 800px; margin: 0 auto; text-align: left;">
            <div>
                <h1>My Places</h1>
                <p>Manage your shared hidden spots</p>
            </div>
            <a href="add.php" class="btn btn-primary">+ Add New Place</a>
        </div>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <?php if (!empty($places)): ?>
        <div class="places-grid">
            <?php foreach ($places as $p): ?>
                <div class="place-card">
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

                        <div style="display: flex; gap: 8px; margin-top: 12px;">
                            <a href="details.php?id=<?php echo $p['id']; ?>" class="btn btn-secondary btn-sm">View</a>
                            <a href="edit.php?id=<?php echo $p['id']; ?>" class="btn btn-secondary btn-sm">Edit</a>
                            <form method="POST" action="../../actions/place.php" style="flex: 1;" onsubmit="return confirm('Are you sure you want to delete this place?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="place_id" value="<?php echo $p['id']; ?>">
                                <input type="hidden" name="_csrf_token" value="<?php echo generateCsrfToken(); ?>">
                                <button type="submit" class="btn btn-danger btn-sm" style="width: 100%;">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>">Previous</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <?php if ($i === $page): ?>
                        <span class="active"><?php echo $i; ?></span>
                    <?php else: ?>
                        <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?php echo $page + 1; ?>">Next</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    <?php else: ?>
        <div class="empty-state">
            <p>You haven't shared any places yet.</p>
            <a href="add.php" class="btn btn-primary">Share Your First Hidden Spot</a>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
