<?php

session_start();
require_once __DIR__ . '/../../includes/csrf.php';
require_once __DIR__ . '/../../classes/user.php';

// If logged in, redirect to home
if (isset($_SESSION['user_id'])) {
    header("Location: ../home.php");
    exit;
}

$token = $_GET['token'] ?? '';

if (!$token) {
    $_SESSION['error'] = "Invalid reset link.";
    header("Location: forgot_password.php");
    exit;
}

// Validate token before showing form
$userObj = new User();
$user_id = $userObj->findValidToken($token);

if (!$user_id) {
    $_SESSION['error'] = "This reset link is invalid or has expired.";
    header("Location: forgot_password.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body>

<h2>Reset Password</h2>

<?php
if (isset($_SESSION['error'])): ?>
    <p style="color:red;"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></p>
<?php endif; ?>

<form method="POST" action="../../actions/password_reset.php">
    <input type="hidden" name="action" value="reset_password">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
    <input type="hidden" name="_csrf_token" value="<?php echo generateCsrfToken(); ?>">

    <label>New Password:</label><br>
    <input type="password" name="new_password" required minlength="6"><br><br>

    <label>Confirm New Password:</label><br>
    <input type="password" name="confirm_password" required minlength="6"><br><br>

    <button type="submit">Reset Password</button>
</form>

<br>
<a href="login.php">← Back to Login</a>

</body>
</html>
