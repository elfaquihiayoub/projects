<?php
require_once __DIR__ . '/../../includes/auth_check.php';
require_once __DIR__ . '/../../includes/csrf.php';
require_once __DIR__ . '/../../classes/Place.php';
require_once __DIR__ . '/../../classes/favorite.php';
require_once __DIR__ . '/../../classes/Review.php';

$place = new Place();
$favorite = new Favorite();
$review = new Review();

if (!isset($_GET['id'])) {
    header("Location: list.php");
    exit;
}

$placeId = (int)$_GET['id'];
$placeData = $place->getPlaceById($placeId);

if (!$placeData) {
    header("Location: list.php");
    exit;
}

$isFavorite = $favorite->isFavorite($_SESSION['user_id'], $placeId);
$isOwner = $place->isOwner($placeId, $_SESSION['user_id']);
$reviews = $review->getByPlace($placeId);
$avgRating = $review->getAverageRating($placeId);
$userReview = $review->getUserReview($placeId, $_SESSION['user_id']);

$pageTitle = htmlspecialchars($placeData['name']) . ' - Hidden Spots Finder';
?>
<?php require_once __DIR__ . '/../../includes/header.php'; ?>

<div class="container">
    <!-- Back Button -->
    <div style="margin-bottom: 16px;">
        <a href="list.php" class="btn btn-secondary btn-sm">&larr; Back to Explore</a>
    </div>

    <!-- Place Images Gallery -->
    <?php if (!empty($placeData['images'])): ?>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 12px; margin-bottom: 24px;">
            <?php foreach ($placeData['images'] as $img): ?>
                <img src="../../<?php echo htmlspecialchars($img['image_path']); ?>"
                     alt="<?php echo htmlspecialchars($placeData['name']); ?>"
                     style="width: 100%; height: 250px; object-fit: cover; border-radius: var(--radius-lg);">
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <img src="../../assets/images/placeholder.jpg"
             alt="<?php echo htmlspecialchars($placeData['name']); ?>"
             style="width: 100%; max-height: 400px; object-fit: cover; border-radius: var(--radius-lg); margin-bottom: 24px;">
    <?php endif; ?>

    <!-- Place Info -->
    <div style="display: grid; grid-template-columns: 1fr 300px; gap: 32px; margin-bottom: 32px;">
        <div>
            <h1 style="margin-bottom: 8px;"><?php echo htmlspecialchars($placeData['name']); ?></h1>

            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px; flex-wrap: wrap;">
                <span class="card-category"><?php echo htmlspecialchars($placeData['category_name'] ?? 'Uncategorized'); ?></span>
                <?php if ($avgRating > 0): ?>
                    <span style="color: var(--primary); font-weight: 600;">
                        ★ <?php echo number_format($avgRating, 1); ?>
                    </span>
                    <span style="color: var(--text-muted); font-size: 0.875rem;">
                        (<?php echo count($reviews); ?> reviews)
                    </span>
                <?php endif; ?>
            </div>

            <div class="place-card-info mb-2">
                <span>📍</span>
                <span><?php echo htmlspecialchars($placeData['location_name'] ?? 'Location not specified'); ?></span>
            </div>

            <div style="background: var(--white); padding: 24px; border-radius: var(--radius-lg); box-shadow: var(--shadow-card); margin-top: 16px;">
                <h3 style="margin-bottom: 12px;">About this place</h3>
                <p style="color: var(--text-light); line-height: 1.7;">
                    <?php echo nl2br(htmlspecialchars($placeData['description'] ?? 'No description provided.')); ?>
                </p>
            </div>

            <?php if ($isOwner): ?>
                <div style="margin-top: 16px; display: flex; gap: 8px;">
                    <a href="edit.php?id=<?php echo $placeId; ?>" class="btn btn-secondary">Edit Place</a>
                    <form method="POST" action="../../actions/place.php" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this place?');">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="place_id" value="<?php echo $placeId; ?>">
                        <input type="hidden" name="_csrf_token" value="<?php echo generateCsrfToken(); ?>">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div>
            <!-- Favorite Button -->
            <div style="background: var(--white); padding: 20px; border-radius: var(--radius-lg); box-shadow: var(--shadow-card); margin-bottom: 16px;">
                <form method="POST" action="../../actions/favorite.php">
                    <input type="hidden" name="place_id" value="<?php echo $placeId; ?>">
                    <input type="hidden" name="_csrf_token" value="<?php echo generateCsrfToken(); ?>">

                    <?php if ($isFavorite): ?>
                        <input type="hidden" name="action" value="remove">
                        <button type="submit" class="btn btn-secondary btn-full" style="color: var(--error);">
                            ♥ Remove from Favorites
                        </button>
                    <?php else: ?>
                        <input type="hidden" name="action" value="add">
                        <button type="submit" class="btn btn-primary btn-full">
                            ♡ Add to Favorites
                        </button>
                    <?php endif; ?>
                </form>
            </div>

            <!-- Location Info -->
            <?php if (!empty($placeData['latitude']) && !empty($placeData['longitude'])): ?>
                <div style="background: var(--white); padding: 20px; border-radius: var(--radius-lg); box-shadow: var(--shadow-card);">
                    <h3 style="margin-bottom: 12px;">Location</h3>
                    <p style="color: var(--text-light); font-size: 0.875rem;">
                        Lat: <?php echo htmlspecialchars($placeData['latitude']); ?><br>
                        Lng: <?php echo htmlspecialchars($placeData['longitude']); ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Reviews Section -->
    <div style="margin-top: 48px;">
        <h2 style="margin-bottom: 24px;">Reviews</h2>

        <!-- Review Form -->
        <div style="background: var(--white); padding: 24px; border-radius: var(--radius-lg); box-shadow: var(--shadow-card); margin-bottom: 24px;">
            <h3 style="margin-bottom: 16px;">Write a Review</h3>

            <form method="POST" action="../../actions/review.php">
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="place_id" value="<?php echo $placeId; ?>">
                <input type="hidden" name="_csrf_token" value="<?php echo generateCsrfToken(); ?>">

                <div class="form-group">
                    <label>Rating</label>
                    <div class="stars-input">
                        <?php for ($i = 5; $i >= 1; $i--): ?>
                            <input type="radio" id="star<?php echo $i; ?>" name="rating" value="<?php echo $i; ?>"
                                   <?php echo ($userReview && $userReview['rating'] == $i) ? 'checked' : ''; ?> required>
                            <label for="star<?php echo $i; ?>">★</label>
                        <?php endfor; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="comment">Your Review</label>
                    <textarea id="comment" name="comment" class="form-control" rows="4" placeholder="Share your experience..."><?php echo htmlspecialchars($userReview['comment'] ?? ''); ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit Review</button>
            </form>
        </div>

        <!-- Reviews List -->
        <?php if (!empty($reviews)): ?>
            <?php foreach ($reviews as $r): ?>
                <div class="review-item">
                    <div class="review-header">
                        <div class="review-avatar">
                            <?php echo strtoupper(substr($r['username'] ?? 'U', 0, 1)); ?>
                        </div>
                        <div>
                            <div class="review-name"><?php echo htmlspecialchars($r['username'] ?? 'Anonymous'); ?></div>
                            <div class="review-date">
                                <?php echo date('M d, Y', strtotime($r['created_at'])); ?>
                            </div>
                        </div>
                        <div class="review-stars" style="margin-left: auto;">
                            <?php echo str_repeat('★', $r['rating']) . str_repeat('☆', 5 - $r['rating']); ?>
                        </div>
                    </div>
                    <p class="review-text"><?php echo nl2br(htmlspecialchars($r['comment'] ?? '')); ?></p>

                    <?php if ($r['user_id'] == $_SESSION['user_id']): ?>
                        <form method="POST" action="../../actions/review.php" style="margin-top: 12px;" onsubmit="return confirm('Delete this review?');">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="review_id" value="<?php echo $r['id']; ?>">
                            <input type="hidden" name="_csrf_token" value="<?php echo generateCsrfToken(); ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted text-center">No reviews yet. Be the first to share your thoughts!</p>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
