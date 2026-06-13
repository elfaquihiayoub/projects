<?php
require_once __DIR__ . '/../includes/auth_check.php';
require_once __DIR__ . '/../classes/Place.php';
require_once __DIR__ . '/../classes/favorite.php';

$place = new Place();
$favorite = new Favorite();

$userId = $_SESSION['user_id'];
$username = $_SESSION['username'] ?? 'User';
$email = $_SESSION['email'] ?? '';

// Get user's places
$myPlaces = $place->getPlacesByUser($userId, 1, 6);
$myPlacesCount = $place->countPlacesByUser($userId);

// Get user's favorites
$myFavorites = $favorite->getUserFavorites($userId);

$pageTitle = 'My Profile - Hidden Spots Finder';
?>

<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="container">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-avatar">
            <?php echo strtoupper(substr($username, 0, 1)); ?>
        </div>
        <div class="profile-info">
            <h1><?php echo htmlspecialchars($username); ?></h1>
            <p><?php echo htmlspecialchars($email); ?></p>
            <div class="profile-stats">
                <div class="stat-item">
                    <span class="stat-number"><?php echo $myPlacesCount; ?></span>
                    <span class="stat-label">Places Shared</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number"><?php echo count($myFavorites); ?></span>
                    <span class="stat-label">Favorites</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div style="display: flex; gap: 12px; margin-bottom: 32px; flex-wrap: wrap; justify-content: center;">
        <a href="profile/edit.php" class="btn btn-secondary">Edit Profile</a>
        <a href="places/add.php" class="btn btn-primary">+ Share New Spot</a>
    </div>

    <!-- Tabs -->
    <div class="tabs">
        <button class="tab active" onclick="showTab('places')">My Places</button>
        <button class="tab" onclick="showTab('favorites')">Favorites</button>
    </div>

    <!-- My Places Tab -->
    <div id="places-tab" class="tab-content">
        <?php if (!empty($myPlaces)): ?>
            <div class="places-grid">
                <?php foreach ($myPlaces as $p): ?>
                    <div class="place-card">
                        <a href="places/details.php?id=<?php echo $p['id']; ?>">
                            <img src="<?php echo !empty($p['image']) ? '../' . htmlspecialchars($p['image']) : '../assets/images/placeholder.jpg'; ?>"
                                 alt="<?php echo htmlspecialchars($p['name']); ?>"
                                 class="place-card-img">
                        </a>
                        <div class="place-card-body">
                            <h3 class="place-card-title">
                                <a href="places/details.php?id=<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['name']); ?></a>
                            </h3>
                            <div class="place-card-info">
                                <span>&#9679;</span>
                                <span><?php echo htmlspecialchars($p['location_name'] ?? 'Unknown'); ?></span>
                            </div>
                            <div style="display: flex; gap: 8px; margin-top: 12px;">
                                <a href="places/edit.php?id=<?php echo $p['id']; ?>" class="btn btn-secondary btn-sm">Edit</a>
                                <a href="places/details.php?id=<?php echo $p['id']; ?>" class="btn btn-secondary btn-sm">View</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if ($myPlacesCount > 6): ?>
                <div class="text-center mt-3">
                    <a href="places/user_places.php" class="btn btn-secondary">View All My Places</a>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="empty-state">
                <p>You haven't shared any places yet.</p>
                <a href="places/add.php" class="btn btn-primary">Share Your First Hidden Spot</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Favorites Tab -->
    <div id="favorites-tab" class="tab-content" style="display: none;">
        <?php if (!empty($myFavorites)): ?>
            <div class="places-grid">
                <?php foreach ($myFavorites as $fav): ?>
                    <div class="place-card">
                        <a href="places/details.php?id=<?php echo $fav['id']; ?>">
                            <img src="<?php echo !empty($fav['image']) ? '../' . htmlspecialchars($fav['image']) : '../assets/images/placeholder.jpg'; ?>"
                                 alt="<?php echo htmlspecialchars($fav['name']); ?>"
                                 class="place-card-img">
                        </a>
                        <div class="place-card-body">
                            <h3 class="place-card-title">
                                <a href="places/details.php?id=<?php echo $fav['id']; ?>"><?php echo htmlspecialchars($fav['name']); ?></a>
                            </h3>
                            <div class="place-card-info">
                                <span>&#9679;</span>
                                <span><?php echo htmlspecialchars($fav['location_name'] ?? 'Unknown'); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <p>You haven't added any favorites yet.</p>
                <a href="places/list.php" class="btn btn-primary">Explore Places</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function showTab(tabName) {
    document.querySelectorAll('.tab-content').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.tab').forEach(el => el.classList.remove('active'));
    document.getElementById(tabName + '-tab').style.display = 'block';
    event.target.classList.add('active');
}

// Auto-open favorites tab if URL has #favorites hash
(function() {
    if (window.location.hash === '#favorites') {
        document.querySelectorAll('.tab-content').forEach(el => el.style.display = 'none');
        document.querySelectorAll('.tab').forEach(el => el.classList.remove('active'));
        document.getElementById('favorites-tab').style.display = 'block';
        var tabs = document.querySelectorAll('.tab');
        if (tabs[1]) tabs[1].classList.add('active');
    }
})();
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
