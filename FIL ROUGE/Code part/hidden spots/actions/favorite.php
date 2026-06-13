<?php

session_start();

require_once __DIR__ . '/../includes/csrf.php';
require_once __DIR__ . '/../classes/Favorite.php';

// 🔒 check login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/auth/login.php");
    exit;
}

$favorite = new Favorite();

$user_id = $_SESSION['user_id'];
$place_id = $_POST['place_id'] ?? null;
$action   = $_POST['action'] ?? null;

// 🔒 validation
if (!$place_id || !$action) {
    header("Location: ../pages/home.php");
    exit;
}

// 🔒 CSRF check
requireCsrfToken('../pages/home.php');

//  ADD FAVORITE
if ($action === "add") {
    $favorite->add($user_id, $place_id);
}

//  REMOVE FAVORITE
if ($action === "remove") {
    $favorite->remove($user_id, $place_id);
}

//  redirect back to the referring page
$_referer = $_SERVER['HTTP_REFERER'] ?? '../pages/home.php';
// If referer is the favorite action itself, fall back to home
if (strpos($_referer, 'favorite.php') !== false) {
    $_referer = '../pages/home.php';
}
header("Location: " . $_referer);
exit;