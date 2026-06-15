<?php

session_start();
require_once __DIR__ . '/../includes/csrf.php';
require_once __DIR__ . '/../classes/user.php';

// 🔒 check login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/auth/login.php");
    exit;
}

$userObj = new User();
$user_id = $_SESSION['user_id'];
$action  = $_POST['action'] ?? null;

if (!$action) {
    header("Location: ../pages/profile/profil.php");
    exit;
}

/* ── UPDATE PROFILE (username + email) ── */
if ($action === "update_profile") {
    requireCsrfToken('../pages/profile/edit.php');

    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');

    // Validation
    if (!$username || !$email) {
        $_SESSION['error'] = "Username and email are required.";
        header("Location: ../pages/profile/edit.php");
        exit;
    }

    if (strlen($username) > 25) {
        $_SESSION['error'] = "Username must be 25 characters or less.";
        header("Location: ../pages/profile/edit.php");
        exit;
    }

    if (strlen($email) > 60 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email address.";
        header("Location: ../pages/profile/edit.php");
        exit;
    }

    $result = $userObj->updateProfile($user_id, $username, $email);

    if ($result['success']) {
        // Update session with new values
        $_SESSION['username'] = $username;
        $_SESSION['email']    = $email;
        $_SESSION['success']  = $result['message'];
    } else {
        $_SESSION['error'] = $result['message'];
    }

    header("Location: ../pages/profile/edit.php");
    exit;
}

/* ── CHANGE PASSWORD ── */
if ($action === "change_password") {
    requireCsrfToken('../pages/profile/edit.php');

    $current_password = $_POST['current_password'] ?? '';
    $new_password     = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (!$current_password || !$new_password || !$confirm_password) {
        $_SESSION['error'] = "All password fields are required.";
        header("Location: ../pages/profile/edit.php");
        exit;
    }

    if (strlen($new_password) < 6) {
        $_SESSION['error'] = "New password must be at least 6 characters.";
        header("Location: ../pages/profile/edit.php");
        exit;
    }

    if ($new_password !== $confirm_password) {
        $_SESSION['error'] = "New passwords do not match.";
        header("Location: ../pages/profile/edit.php");
        exit;
    }

    $result = $userObj->updatePassword($user_id, $current_password, $new_password);

    if ($result['success']) {
        $_SESSION['success'] = $result['message'];
    } else {
        $_SESSION['error'] = $result['message'];
    }

    header("Location: ../pages/profile/edit.php");
    exit;
}

// Fallback
header("Location: ../pages/profile/profil.php");
exit;
