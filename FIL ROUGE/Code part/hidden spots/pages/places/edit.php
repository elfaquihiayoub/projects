<?php
require_once __DIR__ . '/../../includes/auth_check.php';
require_once __DIR__ . '/../../includes/csrf.php';
require_once __DIR__ . '/../../classes/Place.php';

$place = new Place();
$categories = $place->getAllCategories();

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

if (!$place->isOwner($placeId, $_SESSION['user_id'])) {
    header("Location: list.php");
    exit;
}

$pageTitle = 'Edit Place - Hidden Spots Finder';
?>
<?php require_once __DIR__ . '/../../includes/header.php'; ?>

<div class="container">
    <div class="page-header">
        <h1>Edit Place</h1>
        <p>Update your hidden spot details</p>
    </div>

    <div class="form-wrapper">
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <form method="POST" action="<?php echo $base; ?>actions/place.php" enctype="multipart/form-data">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="place_id" value="<?php echo $placeId; ?>">
            <input type="hidden" name="_csrf_token" value="<?php echo generateCsrfToken(); ?>">

            <div class="form-group">
                <label for="name">Place Name</label>
                <input type="text" id="name" name="name" class="form-control"
                       value="<?php echo htmlspecialchars($placeData['name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select id="category_id" name="category_id" class="form-control" required>
                    <option value="">Select a category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>"
                            <?php echo ($placeData['category_id'] == $category['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($category['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location_name" class="form-control"
                       value="<?php echo htmlspecialchars($placeData['location_name'] ?? ''); ?>">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label for="latitude">Latitude</label>
                    <input type="number" step="any" id="latitude" name="latitude" class="form-control"
                           value="<?php echo htmlspecialchars($placeData['latitude'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="longitude">Longitude</label>
                    <input type="number" step="any" id="longitude" name="longitude" class="form-control"
                           value="<?php echo htmlspecialchars($placeData['longitude'] ?? ''); ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="5"><?php echo htmlspecialchars($placeData['description'] ?? ''); ?></textarea>
            </div>

            <!-- Existing Images -->
            <?php if (!empty($placeData['images'])): ?>
                <div class="form-group">
                    <label>Current Images</label>
                    <div class="image-grid">
                        <?php foreach ($placeData['images'] as $img): ?>
                            <div class="image-grid-item">
                                <img src="../../<?php echo htmlspecialchars($img['image_path']); ?>" alt="Place image">
                                <button type="submit" name="action" value="delete_image"
                                        onclick="return confirm('Delete this image?');"
                                        class="delete-img" title="Delete image">
                                    <input type="hidden" name="image_id" value="<?php echo $img['id']; ?>">
                                    <input type="hidden" name="image_path" value="<?php echo htmlspecialchars($img['image_path']); ?>">
                                    &#10005;
                                </button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label>Add More Images</label>
                <div class="upload-area">
                    <p>&#128247; Click to upload or drag and drop</p>
                    <p class="hint">PNG, JPG, WEBP (max 5MB each)</p>
                    <input type="file" name="images[]" id="imageInput" accept="image/*" multiple style="display: none;">
                </div>
                <div id="imagePreview" class="image-grid"></div>
            </div>

            <div class="form-actions">
                <a href="details.php?id=<?php echo $placeId; ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
const uploadArea = document.querySelector('.upload-area');
const imageInput = document.getElementById('imageInput');
const imagePreview = document.getElementById('imagePreview');

uploadArea.addEventListener('click', () => imageInput.click());

imageInput.addEventListener('change', function(e) {
    Array.from(e.target.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'image-grid-item';
            div.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
            imagePreview.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
});
</script>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
