<?php 

session_start();
require_once __DIR__ . '/../classes/Place.php';
require_once __DIR__ . '/../config/database.php'; // for adding images to database


// check if user is logged in

if (!isset($_SESSION['user_id'])) {
    header('Location: ../pages/auth/login.php');
    exit;
}

$place = new Place();
$db = Database::getInstance()->getConnection(); // for adding images to database

// add new place;

if (isset($_POST['action']) && $_POST['action'] === "add") {
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

        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {

            $fileName = time() . "_" . $_FILES['images']['name'][$key];
            $targetFile = $uploadDir . $fileName;

            $ext = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp'];

            if (!in_array($ext, $allowed)) continue;

            if (move_uploaded_file($tmp_name, $targetFile)) {

                $imagePath = "uploads/" . $fileName;

                // insert image into DB
                $stmt = $db->prepare("
                    INSERT INTO place_images (place_id, image_path)
                    VALUES (:place_id, :image_path)
                ");

                $stmt->execute([
                    'place_id' => $place_id,
                    'image_path' => $imagePath
                ]);
            }
        }
    }

        $_SESSION['success'] = "Place added successfully!";
        header("Location: ../pages/places/list.php");
        exit;
        // result add place with or without images ( ading placeholder after in ui)

}
//  update place


if (isset($_POST['action']) && $_POST['action'] === "update") {

    $id = $_POST['id'] ?? null;

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

    if ($success) {
        $_SESSION['success'] = "Place updated!";
        header("Location: ../pages/places/details.php?id=" . $id);
    } else {
        $_SESSION['error'] = "Update failed.";
        header("Location: ../pages/places/edit.php?id=" . $id);
    }

    exit;
}
// delete place

if (isset($_GET['action']) && $_GET['action'] === "delete") {

    $id = $_GET['id'] ?? null;

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





   

    



