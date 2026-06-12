<?php
$pageTitle = isset($pageTitle) ? $pageTitle : 'Hidden Spots Finder';

// Auto-compute relative path from current page to project root
// header.php is in: project_root/includes/header.php
// So __DIR__ = project_root/includes
// We need to go up 1 level from there to reach project_root
$_rootPath = dirname(__DIR__) . '/';

// Compute the relative path from the current script's directory to project root
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
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar">
    <div class="nav-container">
        <a href="<?php echo $base; ?>pages/home.php" class="nav-logo">Hidden Spots</a>

        <button class="nav-toggle" onclick="document.querySelector('.nav-links').classList.toggle('active')" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <ul class="nav-links">
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="<?php echo $base; ?>pages/home.php">Home</a></li>
                <li><a href="<?php echo $base; ?>pages/places/list.php">Explore</a></li>
                <li><a href="<?php echo $base; ?>pages/places/add.php">Share a Spot</a></li>
                <li><a href="<?php echo $base; ?>pages/profil.php">Profile</a></li>
                <li><a href="<?php echo $base; ?>actions/logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="<?php echo $base; ?>pages/auth/login.php">Login</a></li>
                <li><a href="<?php echo $base; ?>pages/auth/register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<main class="page-content">
