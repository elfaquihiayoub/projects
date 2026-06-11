<?php
session_start();

// If not logged in, redirect to login
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home — Hidden Spots</title>
</head>
<body>

<h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>

<p>Discover and share hidden spots around you.</p>

<hr>

<h3>Quick Actions</h3>

<a href="places/list.php">Browse All Places</a><br>
<a href="places/add.php">Add a New Place</a><br>
<a href="places/user_places.php">My Places</a><br>
<a href="profil.php">My Profile</a><br>
<a href="../actions/logout.php">Logout</a>

</body>
</html>
