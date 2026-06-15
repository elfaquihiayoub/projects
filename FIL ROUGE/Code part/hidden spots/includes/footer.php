<?php
// Ensure $base is available (normally set by header.php)
if (!isset($base)) {
    $_rootPath = dirname(__DIR__) . '/';
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
}
?>
</main>

<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-brand">
                <img src="<?php echo $base; ?>assets/images/logo.png" alt="HiddenSpots" class="footer-logo">
                <p>&copy; <?php echo date('Y'); ?> HiddenSpots. Find &bull; Explore &bull; Share.</p>
            </div>

            <div class="footer-links">
                <h4>Explore</h4>
                <ul>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="<?php echo $base; ?>pages/home.php">Home</a></li>
                        <li><a href="<?php echo $base; ?>pages/places/list.php">Browse Places</a></li>
                        <li><a href="<?php echo $base; ?>pages/places/add.php">Share a Spot</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo $base; ?>pages/auth/login.php">Sign In</a></li>
                        <li><a href="<?php echo $base; ?>pages/auth/register.php">Create Account</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="footer-links">
                <h4>Account</h4>
                <ul>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="<?php echo $base; ?>pages/profile/profil.php">My Profile</a></li>
                        <li><a href="<?php echo $base; ?>pages/profile/profil.php#favorites">My Favorites</a></li>
                        <li><a href="<?php echo $base; ?>pages/profile/edit.php">Settings</a></li>
                        <li><a href="<?php echo $base; ?>actions/logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo $base; ?>pages/auth/login.php">Login</a></li>
                        <li><a href="<?php echo $base; ?>pages/auth/register.php">Register</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="footer-links">
                <h4>Information</h4>
                <ul>
                    <li><a href="<?php echo $base; ?>pages/home.php">About Us</a></li>
                    <li><a href="<?php echo $base; ?>pages/home.php">Privacy Policy</a></li>
                    <li><a href="<?php echo $base; ?>pages/home.php">Terms of Service</a></li>
                    <li><a href="<?php echo $base; ?>pages/home.php">Community Guidelines</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<script src="<?php echo $base; ?>assets/js/main.js"></script>
</body>
</html>
