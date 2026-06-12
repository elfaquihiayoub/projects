<?php

session_start();
require_once __DIR__ . '/../../includes/csrf.php';

// If already logged in, redirect to home page
if (isset($_SESSION['user_id'])) {
    header("Location: ../home.php");
    exit;
}

$pageTitle = 'Sign In - Hidden Spots Finder';
?>
<?php require_once __DIR__ . '/../../includes/header.php'; ?>

<div class="auth-wrapper">
    <div class="auth-image">
        <img src="<?php echo $base; ?>assets/images/placeholder.jpg" alt="Hidden spot">
        <div class="auth-image-overlay">
            <h2>Hidden Spots Finder</h2>
            <p>Discover the quiet corners of the world, curated for those who seek serenity beyond the noise.</p>
        </div>
    </div>

    <div class="auth-form-side">
        <div class="auth-form-box">
            <h2>Welcome Back</h2>
            <p>Find your next favorite quiet space.</p>

            <div class="tabs mb-3">
                <button class="tab active">Sign In</button>
                <a href="register.php" class="tab" style="text-decoration:none; color:inherit;">Create Account</a>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
            <?php endif; ?>

            <form method="POST" action="<?php echo $base; ?>actions/auth.php">
                <input type="hidden" name="action" value="login">
                <input type="hidden" name="_csrf_token" value="<?php echo generateCsrfToken(); ?>">

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="you@example.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>

                <button type="submit" class="btn btn-primary btn-full">Sign In</button>
            </form>

            <p class="auth-footer-text">By continuing, you agree to our Terms of Service and Privacy Policy.</p>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
