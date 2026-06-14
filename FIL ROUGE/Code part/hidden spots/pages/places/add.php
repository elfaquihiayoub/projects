<?php
require_once __DIR__ . '/../../includes/auth_check.php';
require_once __DIR__ . '/../../includes/csrf.php';
require_once __DIR__ . '/../../classes/Place.php';

$place = new Place();
$categories = $place->getAllCategories();

$pageTitle = 'Share a Hidden Spot - HiddenSpots';
?>
<?php require_once __DIR__ . '/../../includes/header.php'; ?>

<div class="container">
    <div class="page-header">
        <h1>Share a Hidden Spot</h1>
        <p>Help others discover the beauty you've found</p>
    </div>

    <div class="form-wrapper">
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <form method="POST" action="<?php echo $base; ?>actions/place.php" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="_csrf_token" value="<?php echo generateCsrfToken(); ?>">

            <div class="form-group">
                <label for="name">Place Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="e.g., Secret Beach Cove" required>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select id="category_id" name="category_id" class="form-control" required>
                    <option value="">Select a category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location_name" class="form-control" placeholder="The exact location path">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label for="latitude">Latitude</label>
                    <input type="number" step="any" id="latitude" name="latitude" class="form-control" placeholder="e.g., 40.7128">
                </div>

                <div class="form-group">
                    <label for="longitude">Longitude</label>
                    <input type="number" step="any" id="longitude" name="longitude" class="form-control" placeholder="e.g., -74.0060">
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="5" placeholder="Tell us what makes this place special..."></textarea>
            </div>

            <div class="form-group">
                <label>Upload Images</label>
                <div class="upload-area">
                    <p>&#128247; Click to upload or drag and drop</p>
                    <p class="hint">PNG, JPG, WEBP (max 5MB each, up to 5 images)</p>
                    <input type="file" name="images[]" id="imageInput" accept="image/*" multiple style="display: none;">
                </div>
                <div id="imagePreview" class="preview-grid"></div>
            </div>

            <div class="info-box">
                <p>&#128161; <strong>Curation Tip:</strong> Share places that are truly hidden and deserve protection. Help preserve their beauty by encouraging respectful visits.</p>
            </div>

            <div class="form-actions">
                <a href="list.php" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Share Hidden Spot</button>
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
    imagePreview.innerHTML = '';
    Array.from(e.target.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'preview-item';
            div.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
            imagePreview.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
});
</script>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
