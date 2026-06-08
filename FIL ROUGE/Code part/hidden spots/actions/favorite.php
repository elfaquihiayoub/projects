<?php

session_start();

require_once __DIR__ . '/../classes/Favorite.php';

// 🔒 check login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/auth/login.php");
    exit;
}

$favorite = new Favorite();

$user_id = $_SESSION['user_id'];
$place_id = $_GET['place_id'] ?? null;
$action   = $_GET['action'] ?? null;

// 🔒 validation
if (!$place_id || !$action) {
    header("Location: ../pages/home.php");
    exit;
}

//  ADD FAVORITE
if ($action === "add") {
    $favorite->add($user_id, $place_id);
}

//  REMOVE FAVORITE
if ($action === "remove") {
    $favorite->remove($user_id, $place_id);
}

//  redirect back to previous page
$redirect = $_SERVER['HTTP_REFERER'] ?? '../pages/home.php';
header("Location: $redirect");
exit;