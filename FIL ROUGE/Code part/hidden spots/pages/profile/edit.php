<?php

require_once "../../includes/auth_check.php";
require_once "../../includes/csrf.php";
require_once "../../classes/user.php";

$userObj = new User();
$user_id = $_SESSION['user_id'];

// Fetch fresh user data from DB
$user = $userObj->findById($user_id);

if (!$user) {
    $_SESSION['error'] = "User not found.";
    header("Location: ../profil.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
</head>
<body>

<h2>Edit Profile</h2>

<?php
if (isset($_SESSION['success'])): ?>
    <p style="color:green;"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></p>
<?php endif;

if (isset($_SESSION['error'])): ?>
    <p style="color:red;"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></p>
<?php endif; ?>

<hr>

<!-- ── EDIT PROFILE (username + email) ── -->
<h3>Update Profile</h3>

<form action="../../actions/profile.php" method="POST">
    <input type="hidden" name="action" value="update_profile">
    <input type="hidden" name="_csrf_token" value="<?php echo generateCsrfToken(); ?>">

    <label>Username:</label><br>
    <input type="text" name="username" required maxlength="25"
           value="<?php echo htmlspecialchars($user['username']); ?>"><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required maxlength="60"
           value="<?php echo htmlspecialchars($user['email']); ?>"><br><br>

    <button type="submit">Update Profile</button>
</form>

<hr>

<!-- ── CHANGE PASSWORD ── -->
<h3>Change Password</h3>

<form action="../../actions/profile.php" method="POST">
    <input type="hidden" name="action" value="change_password">
    <input type="hidden" name="_csrf_token" value="<?php echo generateCsrfToken(); ?>">

    <label>Current Password:</label><br>
    <input type="password" name="current_password" required><br><br>

    <label>New Password:</label><br>
    <input type="password" name="new_password" required minlength="6"><br><br>

    <label>Confirm New Password:</label><br>
    <input type="password" name="confirm_password" required minlength="6"><br><br>

    <button type="submit">Change Password</button>
</form>

<hr>

<a href="../profil.php">← Back to Profile</a> |
<a href="../../actions/logout.php">Logout</a>

</body>
</html>
