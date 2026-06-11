<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Generate a CSRF token and store it in the session.
 * Returns the same token for the entire session (single-token strategy).
 */
function generateCsrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Validate a CSRF token against the one stored in the session.
 * Uses hash_equals() to prevent timing attacks.
 */
function validateCsrfToken($token) {
    if (empty($_SESSION['csrf_token']) || empty($token)) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Regenerate the CSRF token after a successful form submission
 * to prevent token reuse (optional but recommended).
 */
function regenerateCsrfToken() {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/**
 * Reject the request if CSRF token is invalid.
 * Redirects back with an error message.
 */
function requireCsrfToken($redirectOnFail) {
    $token = $_POST['_csrf_token'] ?? '';
    if (!validateCsrfToken($token)) {
        $_SESSION['error'] = "Invalid security token. Please try again.";
        header("Location: $redirectOnFail");
        exit;
    }
}
