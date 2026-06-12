<?php
session_start();
require_once __DIR__ . '/../../includes/csrf.php';

// If already logged in → redirect
if (isset($_SESSION['user_id'])) {
    header("Location: ../home.php");
    exit;
}

$pageTitle = 'Create Account - Hidden Spots Finder';
?>
<?php require_once __DIR__ . '/../../includes/header.php'; ?>

<div class="auth-wrapper">
    <div class="auth-image">
        <img src="<?php echo $base; ?>assets/images/placeholder.jpg" alt="Hidden spot">
        <div class="auth-image-overlay">
            <h2>Join our community of explorers.</h2>
            <p>Start sharing your own hidden gems and discover the quiet beauty that others have left behind.</p>
        </div>
    </div>

    <div class="auth-form-side">
        <div class="auth-form-box">
            <h2>Create your account</h2>
            <p>Enter your details to begin your journey.</p>

            <div class="tabs mb-3">
                <a href="login.php" class="tab" style="text-decoration:none; color:inherit;">Sign In</a>
                <button class="tab active">Create Account</button>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
            <?php endif; ?>

            <form method="POST" action="<?php echo $base; ?>actions/auth.php">
                <input type="hidden" name="action" value="register">
                <input type="hidden" name="_csrf_token" value="<?php echo generateCsrfToken(); ?>">

                <div class="form-group">
                    <label for="username">Full Name</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Your name" required
                           value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="you@example.com" required
                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="At least 6 characters" required minlength="6">
                </div>

                <button type="submit" class="btn btn-primary btn-full">Create Account</button>
            </form>

            <p class="auth-footer-text">
                Already have an account? <a href="login.php">Sign In</a>
            </p>
            <p class="auth-footer-text">By creating an account, you agree to our Terms and Privacy Policy.</p>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
