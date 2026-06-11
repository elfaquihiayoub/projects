<?php

session_start();
require_once __DIR__ . '/../../includes/csrf.php';

// If logged in, redirect to home
if (isset($_SESSION['user_id'])) {
    header("Location: ../home.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
</head>
<body>

<h2>Forgot Password</h2>

<?php
if (isset($_SESSION['success'])): ?>
    <p style="color:green;"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></p>
<?php endif;

if (isset($_SESSION['error'])): ?>
    <p style="color:red;"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></p>
<?php endif;

// Show reset link in development (remove in production — use email instead)
if (isset($_SESSION['reset_link'])): ?>
    <p style="background:#fff3cd; padding:10px; border:1px solid #ffc107;">
        <strong>Dev mode:</strong> Copy this reset link:<br>
        <a href="<?php echo htmlspecialchars($_SESSION['reset_link']); ?>">
            <?php echo htmlspecialchars($_SESSION['reset_link']); ?>
        </a>
    </p>
    <?php unset($_SESSION['reset_link']); ?>
<?php endif; ?>

<p>Enter your email address. If an account exists, you will receive a password reset link.</p>

<form method="POST" action="../../actions/password_reset.php">
    <input type="hidden" name="action" value="request_reset">
    <input type="hidden" name="_csrf_token" value="<?php echo generateCsrfToken(); ?>">

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <button type="submit">Send Reset Link</button>
</form>

<br>
<a href="login.php">← Back to Login</a>

</body>
</html>
