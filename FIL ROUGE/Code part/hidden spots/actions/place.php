<?php 

session_start();
require_once '/../classes/Place.php';


// check if user is logged in

if (!isset($_SESSION['user_id'])) {
    header('Location: ../pages/auth/login.php');
    exit;
}

$place = new Place();

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

        $success = $place->create(
        $user_id,
        $category_id,
        $name,
        $description,
        $location_name,
        $latitude,
        $longitude
    );

            if ($success) {
        $_SESSION['success'] = "Place added successfully!";
        header("Location: ../pages/places/list.php");
    } else {
        $_SESSION['error'] = "Failed to add place.";
        header("Location: ../pages/places/add.php");
    }

    exit;
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

    $success = $place->delete($id);

    if ($success) {
        $_SESSION['success'] = "Place deleted.";
    } else {
        $_SESSION['error'] = "Delete failed.";
    }

    header("Location: ../pages/places/list.php");
    exit;
}





   

    



