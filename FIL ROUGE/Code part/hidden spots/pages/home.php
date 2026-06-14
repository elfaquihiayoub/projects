<?php

require_once __DIR__ . '/../classes/Place.php';
require_once __DIR__ . '/../classes/Review.php';
require_once __DIR__ . '/../includes/csrf.php';

$place = new Place();
$review = new Review();
$categories = $place->getAllCategories();
$recentPlaces = $place->getAllPlaces(1, 6); // 6 most recent places

$pageTitle = 'Home - HiddenSpots';
?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>

<!-- Hero Section -->
<section class="hero-section container">
    <div class="hero-content">
        <div class="hero-badge">
            &#127807; Curated Serenity for Urban Explorers
        </div>
        <h1 class="hero-title">Discover places only <span>locals know</span>.</h1>
        <p class="hero-description">
            Uncover the hidden gems, quiet corners, and secret sanctuaries tucked away in the bustle of the city. Hand-picked spots for those who seek peace.
        </p>
        <div class="hero-buttons">
            <a href="places/list.php" class="btn btn-primary">Start Exploring &rarr;</a>
            <a href="places/add.php" class="btn btn-outline-dark">Add a Spot &#9825;</a>
        </div>
    </div>
    <div class="hero-image-wrapper">
        <?php if (!empty($recentPlaces)): ?>
            <a href="places/details.php?id=<?php echo $recentPlaces[0]['id']; ?>">
                <img src="<?php echo !empty($recentPlaces[0]['image']) ? '../' . htmlspecialchars($recentPlaces[0]['image']) : $base . 'assets/images/placeholder.jpg'; ?>" alt="<?php echo htmlspecialchars($recentPlaces[0]['name']); ?>">
            </a>
        <?php else: ?>
            <img src="<?php echo $base; ?>assets/images/placeholder.jpg" alt="Featured hidden spot">
        <?php endif; ?>
        <div class="hero-image-label">
            <small>SPOT OF THE MONTH</small>
            <?php if (!empty($recentPlaces)): ?>
                <h3><?php echo htmlspecialchars($recentPlaces[0]['name']); ?></h3>
            <?php else: ?>
                <h3>The Verant Conservatory</h3>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="categories-section">
    <div class="container">
        <div class="section-header">
            <div>
                <h2>Find Your Vibe</h2>
                <p>Filter by the atmosphere you're craving today.</p>
            </div>
            <a href="places/list.php" class="view-all">View All Categories &rsaquo;</a>
        </div>

        <?php if (!empty($categories)): ?>
            <div class="categories-grid">
                <?php
                $categoryIconMap = [
                    'dating'        => ['class' => 'date',      'symbol' => '&#10084;'],
                    'date'          => ['class' => 'date',      'symbol' => '&#10084;'],
                    'romantic'      => ['class' => 'date',      'symbol' => '&#10084;'],
                    'exploring'     => ['class' => 'adventure', 'symbol' => '&#129517;'],
                    'explore'       => ['class' => 'adventure', 'symbol' => '&#129517;'],
                    'adventure'     => ['class' => 'adventure', 'symbol' => '&#129517;'],
                    'hiking'        => ['class' => 'adventure', 'symbol' => '&#129517;'],
                    'relaxing'      => ['class' => 'chill',     'symbol' => '&#127807;'],
                    'relax'         => ['class' => 'chill',     'symbol' => '&#127807;'],
                    'chill'         => ['class' => 'chill',     'symbol' => '&#127807;'],
                    'socializing'   => ['class' => 'social',    'symbol' => '&#128101;'],
                    'social'        => ['class' => 'social',    'symbol' => '&#128101;'],
                    'party'         => ['class' => 'social',    'symbol' => '&#127881;'],
                    'studying'      => ['class' => 'study',     'symbol' => '&#128214;'],
                    'study'         => ['class' => 'study',     'symbol' => '&#128214;'],
                    'library'       => ['class' => 'study',     'symbol' => '&#128214;'],
                    'work'          => ['class' => 'study',     'symbol' => '&#128187;'],
                    'nature'        => ['class' => 'nature',    'symbol' => '&#9968;'],
                    'park'          => ['class' => 'nature',    'symbol' => '&#9968;'],
                    'garden'        => ['class' => 'nature',    'symbol' => '&#127807;'],
                    'food'          => ['class' => 'food',      'symbol' => '&#127860;'],
                    'restaurant'    => ['class' => 'food',      'symbol' => '&#127860;'],
                    'cafe'          => ['class' => 'cafe',      'symbol' => '&#9749;'],
                    'coffee'        => ['class' => 'cafe',      'symbol' => '&#9749;'],
                    'music'         => ['class' => 'music',     'symbol' => '&#127925;'],
                    'art'           => ['class' => 'art',       'symbol' => '&#127912;'],
                    'culture'       => ['class' => 'art',       'symbol' => '&#127963;'],
                    'sport'         => ['class' => 'sport',     'symbol' => '&#9917;'],
                    'sports'        => ['class' => 'sport',     'symbol' => '&#9917;'],
                    'fitness'       => ['class' => 'sport',     'symbol' => '&#128170;'],
                ];
                foreach ($categories as $category):
                    $catNameLower = strtolower(trim($category['name']));
                    $iconData = $categoryIconMap[$catNameLower] ?? ['class' => 'chill', 'symbol' => '&#10024;'];
                ?>
                    <a href="places/list.php?category=<?php echo $category['id']; ?>" class="category-card">
                        <div class="category-icon <?php echo $iconData['class']; ?>">
                            <?php echo $iconData['symbol']; ?>
                        </div>
                        <h3><?php echo htmlspecialchars($category['name']); ?></h3>
                    </a>
                <?php
                endforeach;
                ?>
            </div>
        <?php else: ?>
            <p class="text-muted">No categories available yet.</p>
        <?php endif; ?>
    </div>
</section>

<!-- Hand-Picked Discoveries -->
<section class="discoveries-section">
    <div class="container">
        <div class="discoveries-header">
            <h2>Hand-Picked Discoveries</h2>
        </div>

        <?php if (!empty($recentPlaces)): ?>
            <div class="discoveries-grid">
                <?php
                $displayPlaces = array_slice($recentPlaces, 0, 3);
                foreach ($displayPlaces as $p):
                    $avgRating = $review->getAverageRating($p['id']);
                    $ratingDisplay = $avgRating > 0 ? number_format($avgRating, 1) : 'No reviews';
                ?>
                    <div class="discovery-card">
                        <div class="discovery-card-img">
                            <a href="places/details.php?id=<?php echo $p['id']; ?>">
                                <img src="<?php echo !empty($p['image']) ? '../' . htmlspecialchars($p['image']) : '../assets/images/placeholder.jpg'; ?>"
                                     alt="<?php echo htmlspecialchars($p['name']); ?>">
                            </a>
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <form method="POST" action="<?php echo $base; ?>actions/favorite.php" style="position:absolute;top:12px;right:12px;margin:0;">
                                    <input type="hidden" name="place_id" value="<?php echo $p['id']; ?>">
                                    <input type="hidden" name="action" value="add">
                                    <input type="hidden" name="_csrf_token" value="<?php echo generateCsrfToken(); ?>">
                                    <button type="submit" class="discovery-bookmark" title="Save to Favorites">&#10084;</button>
                                </form>
                            <?php endif; ?>
                            <span class="discovery-category-badge"><?php echo htmlspecialchars($p['category_name'] ?? ''); ?></span>
                        </div>
                        <div class="discovery-card-body">
                            <h3 class="discovery-card-title">
                                <a href="places/details.php?id=<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['name']); ?></a>
                            </h3>
                            <div class="discovery-card-meta">
                                <span class="discovery-card-location">&#9679; <?php echo htmlspecialchars($p['location_name'] ?? 'Unknown'); ?></span>
                                <span class="discovery-card-rating">&#9733; <?php echo $ratingDisplay; ?></span>
                            </div>
                        </div>
                    </div>
                <?php
                endforeach;
                ?>
            </div>

            <a href="places/list.php" class="explore-all-btn">Explore All Spots</a>
        <?php else: ?>
            <div class="empty-state">
                <p>No places shared yet. Be the first to share a hidden spot!</p>
                <a href="places/add.php" class="btn btn-primary">Share a Hidden Spot</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA / Newsletter Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-box">
            <div class="cta-content">
                <h2>Be the first to find the quietest corners.</h2>
                <p>Join our community of urban explorers and receive weekly curation of the most serene spots in your city.</p>
                <form class="cta-form" onsubmit="return handleSubscribe(event);">
                    <input type="email" name="email" placeholder="Your email address" required>
                    <button type="submit">Subscribe</button>
                </form>
            </div>
            <div class="cta-features">
                <div class="cta-feature">
                    <span class="cta-feature-icon">&#10024;</span>
                    <span>Curated by Locals</span>
                </div>
                <div class="cta-feature">
                    <span class="cta-feature-icon">&#128737;</span>
                    <span>Verified Spots</span>
                </div>
                <div class="cta-feature">
                    <span class="cta-feature-icon">&#128172;</span>
                    <span>Vibrant Community</span>
                </div>
                <div class="cta-feature">
                    <span class="cta-feature-icon">&#128506;</span>
                    <span>Offline Maps</span>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

<script>
function handleSubscribe(e) {
    e.preventDefault();
    var form = e.target;
    var email = form.querySelector('input[name="email"]').value;
    if (email) {
        alert('Thank you for subscribing with: ' + email);
        form.reset();
    }
    return false;
}
</script>
