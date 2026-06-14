<?php
session_start();
require_once __DIR__ . '/../../includes/csrf.php';

// If already logged in → redirect
if (isset($_SESSION['user_id'])) {
    header("Location: ../home.php");
    exit;
}

$pageTitle = 'Create Account - HiddenSpots';

// Compute base path reliably
$base = '../../';
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
        <img src="<?php echo $base; ?>assets/images/auth-bg.jpg" alt="Hidden spot">

        <div class="auth-branding">
            <img src="<?php echo $base; ?>assets/images/logo.png" alt="HiddenSpots" class="auth-logo-img">
            <p>Discover the quiet corners of the world, curated for those who seek serenity beyond the noise.</p>
        </div>
    </div>

    <!-- Right: Form Panel -->
    <div class="auth-form-side">
        <div class="auth-form-box">
            <h2>Create Account</h2>
            <p>Start your journey to hidden serenity.</p>

            <!-- Segmented Tabs -->
            <div class="auth-segmented-tabs">
                <a href="login.php">Sign In</a>
                <button class="active">Create Account</button>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
            <?php endif; ?>

            <form method="POST" action="<?php echo $base; ?>actions/auth.php" id="registerForm">
                <input type="hidden" name="action" value="register">
                <input type="hidden" name="_csrf_token" value="<?php echo generateCsrfToken(); ?>">

                <div class="form-group">
                    <label for="username">Full Name</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Your name" required
                           value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="explorer@serenity.com" required
                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>

                <div class="form-group" style="margin-bottom: 4px;">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" class="form-control" placeholder="At least 6 characters" required minlength="6">
                        <button type="button" class="password-toggle" onclick="togglePassword('password', this)" aria-label="Toggle password visibility">&#128065;</button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-auth">Create Account</button>
            </form>

            <p class="auth-footer-text">
                Already have an account? <a href="login.php">Sign In</a>
            </p>
            <p class="auth-footer-text">
                By creating an account, you agree to our <a href="#">Terms</a> and <a href="#">Privacy Policy</a>.
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
