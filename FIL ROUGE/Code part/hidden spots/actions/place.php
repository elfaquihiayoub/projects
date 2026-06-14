<?php 

session_start();
require_once __DIR__ . '/../includes/csrf.php';
require_once __DIR__ . '/../classes/Place.php';


// check if user is logged in

if (!isset($_SESSION['user_id'])) {
    header('Location: ../pages/auth/login.php');
    exit;
}

$place = new Place();

// Upload limits
const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5 MB in bytes
const MAX_IMAGES_PER_PLACE = 5;

// add new place;

if (isset($_POST['action']) && $_POST['action'] === "add") {
    requireCsrfToken('../pages/places/add.php');

    $user_id = $_SESSION['user_id'];
    $category_id   = $_POST['category_id'] ?? null;
    $name= trim($_POST['name'] ?? '');
    $description   = trim($_POST['description'] ?? '');
    $location_name = trim($_POST['location_name'] ?? '');
    $latitude      = $_POST['latitude'] ?? null;
    $longitude     = $_POST['longitude'] ?? null;

         //  validation dot not empy

        if (!$name || !$category_id || !$latitude || !$longitude) {
        $_SESSION['error'] = "Please fill all required fields.";
        header("Location: ../pages/places/add.php");
        exit;
    }


    //create place ;

        $place_id = $place->create(
        $user_id,
        $category_id,
        $name,
        $description,
        $location_name,
        $latitude,
        $longitude
    );
      if (!empty($_FILES['images']['name'][0])) {

        $uploadDir = __DIR__ . "/../uploads/";

        // Ensure uploads directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $imageCount = 0;
        $uploadErrors = [];

        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {

            // Skip if upload had an error
            if ($_FILES['images']['error'][$key] !== UPLOAD_ERR_OK) {
                $uploadErrors[] = $_FILES['images']['name'][$key] . ': upload error code ' . $_FILES['images']['error'][$key];
                continue;
            }

            // Skip empty tmp_name
            if (empty($tmp_name)) {
                continue;
            }

            // Check max image count
            if ($imageCount >= MAX_IMAGES_PER_PLACE) {
                $uploadErrors[] = "Maximum " . MAX_IMAGES_PER_PLACE . " images allowed. Remaining files skipped.";
                break;
            }

            // Check file size (5 MB max)
            if ($_FILES['images']['size'][$key] > MAX_FILE_SIZE) {
                $uploadErrors[] = $_FILES['images']['name'][$key] . ' exceeds 5 MB limit.';
                continue;
            }

            $fileName = time() . "_" . $imageCount . "_" . $_FILES['images']['name'][$key];
            $targetFile = $uploadDir . $fileName;

            $ext = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp'];

            if (!in_array($ext, $allowed)) continue;

            if (move_uploaded_file($tmp_name, $targetFile)) {
                $imagePath = "uploads/" . $fileName;
                $place->addImage($place_id, $imagePath);
                $imageCount++;
            } else {
                $uploadErrors[] = $_FILES['images']['name'][$key] . ': failed to move uploaded file.';
            }
        }

        if (!empty($uploadErrors)) {
            $_SESSION['error'] = "Some images failed: " . implode(' | ', $uploadErrors);
        }
    }

        $_SESSION['success'] = "Place added successfully!";
        header("Location: ../pages/places/list.php");
        exit;
        // result add place with or without images ( ading placeholder after in ui)

}
//  update place


if (isset($_POST['action']) && $_POST['action'] === "update") {
    requireCsrfToken('../pages/places/list.php');

    $id = $_POST['place_id'] ?? null;

    $category_id   = $_POST['category_id'] ?? null;
    $name          = trim($_POST['name'] ?? '');
    $description   = trim($_POST['description'] ?? '');
    $location_name = trim($_POST['location_name'] ?? '');
    $latitude      = $_POST['latitude'] ?? null;
    $longitude     = $_POST['longitude'] ?? null;

    if (!$id || !$name) {
        $_SESSION['error'] = "Invalid data.";
        header("Location: ../pages/places/edit.php?id=" . $id);
        exit;
    }
        if (!$place->isOwner($id, $_SESSION['user_id'])) {
        $_SESSION['error'] = "Unauthorized action.";
        header("Location: ../pages/places/list.php");
    exit;
    }

    $success = $place->update(
        $id,
        $category_id,
        $name,
        $description,
        $location_name,
        $latitude,
        $longitude
    );

    // Handle new image uploads
    if (!empty($_FILES['images']['name'][0])) {
        $uploadDir = __DIR__ . "/../uploads/";

        // Ensure uploads directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $existingCount = $place->countImages($id);
        $newCount = 0;
        $uploadErrors = [];

        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {

            // Skip if upload had an error
            if ($_FILES['images']['error'][$key] !== UPLOAD_ERR_OK) {
                $uploadErrors[] = $_FILES['images']['name'][$key] . ': upload error code ' . $_FILES['images']['error'][$key];
                continue;
            }

            // Skip empty tmp_name
            if (empty($tmp_name)) {
                continue;
            }

            // Check max image count (existing + new)
            if (($existingCount + $newCount) >= MAX_IMAGES_PER_PLACE) {
                $uploadErrors[] = "Maximum " . MAX_IMAGES_PER_PLACE . " images allowed. Remaining files skipped.";
                break;
            }

            // Check file size (5 MB max)
            if ($_FILES['images']['size'][$key] > MAX_FILE_SIZE) {
                $uploadErrors[] = $_FILES['images']['name'][$key] . ' exceeds 5 MB limit.';
                continue;
            }

            $fileName = time() . "_" . $newCount . "_" . $_FILES['images']['name'][$key];
            $targetFile = $uploadDir . $fileName;

            $ext = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp'];

            if (!in_array($ext, $allowed)) continue;

            if (move_uploaded_file($tmp_name, $targetFile)) {
                $imagePath = "uploads/" . $fileName;
                $place->addImage($id, $imagePath);
                $newCount++;
            } else {
                $uploadErrors[] = $_FILES['images']['name'][$key] . ': failed to move uploaded file.';
            }
        }

        if (!empty($uploadErrors)) {
            $_SESSION['error'] = "Some images failed: " . implode(' | ', $uploadErrors);
        }
    }

    if ($success) {
        $_SESSION['success'] = "Place updated!";
        header("Location: ../pages/places/details.php?id=" . $id);
    } else {
        $_SESSION['error'] = "Update failed.";
        header("Location: ../pages/places/edit.php?id=" . $id);
    }

    exit;
}
// delete place (POST only)

if (isset($_POST['action']) && $_POST['action'] === "delete") {
    requireCsrfToken('../pages/places/list.php');

    $id = $_POST['place_id'] ?? null;

    if (!$id) {
        header("Location: ../pages/places/list.php");
        exit;
    }
    // 🔒 OWNER CHECK
    if (!$place->isOwner($id, $_SESSION['user_id'])) {
        $_SESSION['error'] = "Unauthorized action.";
        header("Location: ../pages/places/list.php");
        exit;
    }

    $success = $place->delete($id);

    if ($success) {
        $_SESSION['success'] = "Place deleted.";
    } else {
        $_SESSION['error'] = "Delete failed.";
    }

    header("Location: ../pages/places/list.php");
    exit;
}

// delete single image

if (isset($_POST['action']) && $_POST['action'] === "delete_image") {
    requireCsrfToken('../pages/places/edit.php');

    $id = $_POST['place_id'] ?? null;
    $image_path = $_POST['image_path'] ?? null;

    if (!$id || !$image_path) {
        header("Location: ../pages/places/list.php");
        exit;
    }

    // 🔒 Prevent path traversal — image_path must start with "uploads/"
    if (!str_starts_with($image_path, 'uploads/')) {
        $_SESSION['error'] = "Invalid image path.";
        header("Location: ../pages/places/list.php");
        exit;
    }

    // OWNER CHECK
    if (!$place->isOwner($id, $_SESSION['user_id'])) {
        $_SESSION['error'] = "Unauthorized action.";
        header("Location: ../pages/places/list.php");
        exit;
    }

    // Delete from DB
    $place->deleteImage($id, $image_path);

    // Delete physical file
    $fullPath = __DIR__ . "/../" . $image_path;
    if (file_exists($fullPath)) {
        unlink($fullPath);
    }

    $_SESSION['success'] = "Image deleted.";
    header("Location: ../pages/places/edit.php?id=" . $id);
    exit;
}





   

    



