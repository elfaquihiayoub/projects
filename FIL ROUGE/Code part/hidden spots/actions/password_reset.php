<?php

session_start();
require_once __DIR__ . '/../includes/csrf.php';
require_once __DIR__ . '/../classes/user.php';

$userObj = new User();
$action  = $_POST['action'] ?? null;

if (!$action) {
    header("Location: ../pages/auth/login.php");
    exit;
}

/* ── STEP 1: REQUEST RESET (enter email) ── */
if ($action === "request_reset") {
    requireCsrfToken('../pages/auth/forgot_password.php');

    $email = trim($_POST['email'] ?? '');

    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Please enter a valid email address.";
        header("Location: ../pages/auth/forgot_password.php");
        exit;
    }

    $user = $userObj->findByEmail($email);

    // Always show success to prevent email enumeration
    if (!$user) {
        $_SESSION['success'] = "If that email exists in our system, a reset link has been sent.";
        header("Location: ../pages/auth/forgot_password.php");
        exit;
    }

    // Generate token
    $token = $userObj->createResetToken($user['id']);

    // Build reset URL
    $resetUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http')
              . "://" . ($_SERVER['HTTP_HOST'] ?? 'localhost')
              . dirname($_SERVER['SCRIPT_NAME'])
              . "/../pages/auth/reset_password.php?token=" . $token;

    // In production, send $resetUrl via email.
    // For development, store it in session so the form can display it.
    $_SESSION['reset_link'] = $resetUrl;

    $_SESSION['success'] = "If that email exists in our system, a reset link has been sent.";
    header("Location: ../pages/auth/forgot_password.php");
    exit;
}

/* ── STEP 2: SUBMIT NEW PASSWORD (with token) ── */
if ($action === "reset_password") {
    requireCsrfToken('../pages/auth/reset_password.php');

    $token            = $_POST['token'] ?? '';
    $new_password     = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (!$token) {
        $_SESSION['error'] = "Invalid reset link.";
        header("Location: ../pages/auth/forgot_password.php");
        exit;
    }

    if (!$new_password || !$confirm_password) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: ../pages/auth/reset_password.php?token=" . urlencode($token));
        exit;
    }

    if (strlen($new_password) < 6) {
        $_SESSION['error'] = "Password must be at least 6 characters.";
        header("Location: ../pages/auth/reset_password.php?token=" . urlencode($token));
        exit;
    }

    if ($new_password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: ../pages/auth/reset_password.php?token=" . urlencode($token));
        exit;
    }

    // Validate token
    $user_id = $userObj->findValidToken($token);

    if (!$user_id) {
        $_SESSION['error'] = "This reset link is invalid or has expired.";
        header("Location: ../pages/auth/forgot_password.php");
        exit;
    }

    // Reset password
    $userObj->resetPassword($user_id, $new_password, $token);

    $_SESSION['success'] = "Password has been reset. You can now log in.";
    header("Location: ../pages/auth/login.php");
    exit;
}

// Fallback
header("Location: ../pages/auth/login.php");
exit;
