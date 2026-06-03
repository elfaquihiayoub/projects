<?php
session_start();

// If already logged in → redirect
if (isset($_SESSION['user_id'])) {
    header("Location: ../home.php");
    exit;
}

?>

<h2>Register</h2>

<?php
// Show error or success messages


if (isset($_SESSION['error'])) {
    echo "<p style='color:red'>" . htmlspecialchars($_SESSION['error']) . "</p>";
    unset($_SESSION['error']);
}

if (isset($_SESSION['success'])) {
    echo "<p style='color:green'>" . htmlspecialchars($_SESSION['success']) . "</p>";
    unset($_SESSION['success']);
}
?>

<form method="POST" action="../../actions/auth.php">

    <input type="hidden" name="action" value="register">

    <label>Username:</label>
    <input type="text" name="username" required
           value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">

    <br><br>

    <label>Email:</label>
    <input type="email" name="email" required
           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">

    <br><br>

    <label>Password:</label>
    <input type="password" name="password" required>

    <br><br>

    <button type="submit">Register</button>

</form>