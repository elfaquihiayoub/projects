<?php

session_start();
require_once __DIR__ . '/../../includes/csrf.php';

// If already logged in, redirect to home page
if (isset($_SESSION['user_id'])) {
    header("Location: ../home.php");
    exit;
}

$pageTitle = 'Sign In - Hidden Spots Finder';

// Compute base path (normally set by header.php)
$_rootPath = dirname(__DIR__, 2) . '/';
$_scriptDir = dirname($_SERVER['SCRIPT_FILENAME']) . '/';
$_rootNormalized = str_replace('\\', '/', $_rootPath);
$_scriptNormalized = str_replace('\\', '/', $_scriptDir);
if (strpos($_scriptNormalized, $_rootNormalized) === 0) {
    $_diff = substr($_scriptNormalized, strlen($_rootNormalized));
    $_depth = substr_count($_diff, '/');
    $base = str_repeat('../', $_depth);
} else {
    $base = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <link rel="stylesheet" href="<?php echo $base; ?>assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="auth-wrapper">
    <!-- Left: Full-bleed Image -->
    <div class="auth-image">
        <img src="<?php echo $base; ?>assets/images/placeholder.jpg" alt="Hidden spot">

        <div class="auth-branding">
            <h1>Hidden Spots Finder</h1>
            <p>Discover the quiet corners of the world, curated for those who seek serenity beyond the noise.</p>
        </div>

        <div class="auth-spot-card">
            <div>
                <div class="auth-spot-card-label">Current Spot</div>
                <div class="auth-spot-card-name">Mirror Lake, Cascadia</div>
            </div>
            <div class="auth-spot-avatar">
                <img src="<?php echo $base; ?>assets/images/placeholder.jpg" alt="Explorer">
            </div>
        </div>
    </div>

    <!-- Right: Form Panel -->
    <div class="auth-form-side">
        <div class="auth-form-box">
            <h2>Welcome Back</h2>
            <p>Find your next favorite quiet space.</p>

            <!-- Segmented Tabs -->
            <div class="auth-segmented-tabs">
                <button class="active" onclick="window.location.href='login.php'">Sign In</button>
                <a href="register.php">Create Account</a>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
            <?php endif; ?>

            <form method="POST" action="<?php echo $base; ?>actions/auth.php" id="loginForm">
                <input type="hidden" name="action" value="login">
                <input type="hidden" name="_csrf_token" value="<?php echo generateCsrfToken(); ?>">

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="explorer@serenity.com" required>
                </div>

                <div class="form-group" style="margin-bottom: 4px;">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                        <button type="button" class="password-toggle" onclick="togglePassword('password', this)" aria-label="Toggle password visibility">&#128065;</button>
                    </div>
                </div>
                <a href="#" class="forgot-link">Forgot?</a>

                <button type="submit" class="btn btn-primary btn-auth">Sign In</button>
            </form>

            <p class="auth-footer-text">
                By continuing, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.
            </p>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId, btn) {
    var input = document.getElementById(inputId);
    if (input.type === 'password') {
        input.type = 'text';
        btn.innerHTML = '&#128064;';
    } else {
        input.type = 'password';
        btn.innerHTML = '&#128065;';
    }
}
</script>

</body>
</html>
