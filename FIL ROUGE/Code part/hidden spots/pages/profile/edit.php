<?php
require_once __DIR__ . '/../../includes/auth_check.php';
require_once __DIR__ . '/../../includes/csrf.php';

$pageTitle = 'Edit Profile - Hidden Spots Finder';
?>
<?php require_once __DIR__ . '/../../includes/header.php'; ?>

<div class="container">
    <div class="page-header">
        <h1>Edit Profile</h1>
        <p>Update your account information</p>
    </div>

    <div style="max-width: 600px;">
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <!-- Update Profile Info -->
        <div style="background: var(--white); padding: 24px; border-radius: var(--radius-lg); box-shadow: var(--shadow-card); margin-bottom: 24px;">
            <h3 style="margin-bottom: 16px;">Profile Information</h3>

            <form method="POST" action="<?php echo $base; ?>actions/profile.php">
                <input type="hidden" name="action" value="update_profile">
                <input type="hidden" name="_csrf_token" value="<?php echo generateCsrfToken(); ?>">

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control"
                           value="<?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?>"
                           required maxlength="25">
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control"
                           value="<?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>"
                           required maxlength="60">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>
        </div>

        <!-- Change Password -->
        <div style="background: var(--white); padding: 24px; border-radius: var(--radius-lg); box-shadow: var(--shadow-card);">
            <h3 style="margin-bottom: 16px;">Change Password</h3>

            <form method="POST" action="<?php echo $base; ?>actions/profile.php">
                <input type="hidden" name="action" value="change_password">
                <input type="hidden" name="_csrf_token" value="<?php echo generateCsrfToken(); ?>">

                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" id="current_password" name="current_password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" id="new_password" name="new_password" class="form-control"
                           required minlength="6" placeholder="At least 6 characters">
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm New Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control"
                           required minlength="6">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>
        </div>

        <div style="margin-top: 24px; text-align: center;">
            <a href="../profil.php" class="btn btn-secondary">&larr; Back to Profile</a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
