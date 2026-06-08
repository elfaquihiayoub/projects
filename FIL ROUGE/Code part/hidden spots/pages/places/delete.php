<?php

require_once "../../includes/auth_check.php";
require_once "../../classes/Place.php";

$placeObj = new Place();

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: ../user_places.php");
    exit;
}

$place = $placeObj->getPlaceById($id);

if (!$place) {
    header("Location: ../user_places.php");
    exit;
}

/*  OWNER CHECK */
if ($place['user_id'] != $_SESSION['user_id']) {
    $_SESSION['error'] = "Unauthorized action.";
    header("Location: ../user_places.php");
    exit;
}

$success = $placeObj->delete($id);

if ($success) {
    $_SESSION['success'] = "Place deleted successfully.";
} else {
    $_SESSION['error'] = "Delete failed.";
}

header("Location: ../user_places.php");
exit;