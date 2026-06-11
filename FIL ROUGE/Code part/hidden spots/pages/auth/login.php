<?php

session_start();
require_once __DIR__ . '/../../includes/csrf.php';

// If already logged in , redirect him into home page

if (isset($_SESSION['user_id'])) {
    header("Location: ../home.php");
    exit;
}

?>

<h2>Login</h2>

<?php
// Show error if exists
if (isset($_SESSION['error'])) {
    echo "<p style='color:red'>" . htmlspecialchars($_SESSION['error']) . "</p>";
    unset($_SESSION['error']);
}
?>

<form method="POST" action="../../actions/auth.php">

    <input type="hidden" name="action" value="login">
    <input type="hidden" name="_csrf_token" value="<?php echo generateCsrfToken(); ?>">

    <label>Email:</label>
    <input type="email" name="email" required
           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">

    <br><br>

    <label>Password:</label>
    <input type="password" name="password" required>

    <br><br>

    <button type="submit">Login</button>

</form>

<br>
<a href="forgot_password.php">Forgot password?</a>



