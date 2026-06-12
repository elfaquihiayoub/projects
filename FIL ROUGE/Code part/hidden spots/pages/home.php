<?php

require_once __DIR__ . '/../classes/Place.php';

$place = new Place();
$categories = $place->getAllCategories();
$recentPlaces = $place->getAllPlaces(1, 6); // 6 most recent places

$pageTitle = 'Home - Hidden Spots Finder';
?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="container">
    <!-- Hero Section -->
    <section style="text-align: center; padding: 64px 0 48px;">
        <h1 style="font-size: 2.5rem; margin-bottom: 12px;">Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Explorer'); ?>!</h1>
        <p style="font-size: 1.125rem; color: var(--text-light); max-width: 500px; margin: 0 auto 32px;">
            Discover hidden gems or share your own secret spots with the community.
        </p>
        <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
            <a href="places/add.php" class="btn btn-primary">+ Share a Hidden Spot</a>
            <a href="places/list.php" class="btn btn-secondary">Explore Places</a>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="section">
        <h2 class="section-title">Explore by Category</h2>
        <?php if (!empty($categories)): ?>
            <div class="grid grid-4">
                <?php foreach ($categories as $category): ?>
                    <a href="places/list.php?category=<?php echo $category['id']; ?>" class="card" style="text-align: center; padding: 24px; text-decoration: none;">
                        <h3 style="color: var(--text);"><?php echo htmlspecialchars($category['name']); ?></h3>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-muted">No categories available yet.</p>
        <?php endif; ?>
    </section>

    <!-- Recent Discoveries -->
    <section class="section">
        <div class="flex-between mb-3">
            <h2 class="section-title" style="margin-bottom: 0;">Recent Discoveries</h2>
            <a href="places/list.php" class="btn btn-secondary btn-sm">View All</a>
        </div>

        <?php if (!empty($recentPlaces)): ?>
            <div class="places-grid">
                <?php foreach ($recentPlaces as $p): ?>
                    <div class="place-card">
                        <a href="places/details.php?id=<?php echo $p['id']; ?>">
                            <img src="<?php echo !empty($p['image']) ? '../../' . htmlspecialchars($p['image']) : '../../assets/images/placeholder.jpg'; ?>"
                                 alt="<?php echo htmlspecialchars($p['name']); ?>"
                                 class="place-card-img">
                        </a>
                        <div class="place-card-body">
                            <h3 class="place-card-title">
                                <a href="places/details.php?id=<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['name']); ?></a>
                            </h3>
                            <div class="place-card-info">
                                <span>📍</span>
                                <span><?php echo htmlspecialchars($p['location'] ?? 'Unknown'); ?></span>
                            </div>
                            <span class="card-category mt-1"><?php echo htmlspecialchars($p['category_name'] ?? ''); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-muted">No places shared yet. Be the first to share a hidden spot!</p>
        <?php endif; ?>
    </section>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
