<?php

session_start();

require_once __DIR__ . '/../includes/csrf.php';
require_once __DIR__ . '/../classes/Review.php';

// 🔒 check login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/auth/login.php");
    exit;
}

$review = new Review();

$user_id = $_SESSION['user_id'];
$action = $_POST['action'] ?? null;

$place_id = $_POST['place_id'] ?? null;

if (!$place_id || !$action) {
    header("Location: ../pages/home.php");
    exit;
}

// 🔒 CSRF check
requireCsrfToken('../pages/home.php');

/* ⭐ ADD / UPDATE REVIEW */
if ($action === "save") {

    $rating = $_POST['rating'] ?? null;
    $comment = trim($_POST['comment'] ?? '');

    // 🔒 validation
    if (!$rating || $rating < 1 || $rating > 5) {
        $_SESSION['error'] = "Invalid rating.";
        header("Location: ../pages/places/details.php?id=" . $place_id);
        exit;
    }

    $review->save($user_id, $place_id, $rating, $comment);
}

/* 🗑 DELETE REVIEW */
if ($action === "delete") {
    $review->delete($user_id, $place_id);
}

/* 🔁 back to place */
header("Location: ../pages/places/details.php?id=" . $place_id);
exit;