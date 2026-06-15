<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pageTitle = isset($pageTitle) ? $pageTitle : 'HiddenSpots';

// Auto-compute relative path from current page to project root
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

// Determine active page for nav highlighting
$_currentPage = basename($_SERVER['SCRIPT_FILENAME'], '.php');
$_currentDir = basename(dirname($_SERVER['SCRIPT_FILENAME']));
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

<nav class="navbar">
    <div class="nav-container">
        <a href="<?php echo $base; ?>pages/home.php" class="nav-logo">
            <img src="<?php echo $base; ?>assets/images/logo.png" alt="HiddenSpots" class="nav-logo-img">
        </a>

        <button class="nav-toggle" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="nav-overlay"></div>

        <ul class="nav-links">
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="<?php echo $base; ?>pages/home.php" class="<?php echo ($_currentPage === 'home') ? 'active' : ''; ?>">Home</a></li>
                <li><a href="<?php echo $base; ?>pages/places/list.php" class="<?php echo ($_currentDir === 'places' && $_currentPage === 'list') ? 'active' : ''; ?>">Places</a></li>
                <li><a href="<?php echo $base; ?>pages/places/add.php" class="<?php echo ($_currentDir === 'places' && $_currentPage === 'add') ? 'active' : ''; ?>">Add Place</a></li>
                <li><a href="<?php echo $base; ?>pages/profile/profil.php" class="<?php echo ($_currentPage === 'profil') ? 'active' : ''; ?>">Profile</a></li>
                <li class="nav-mobile-logout">
                    <a href="<?php echo $base; ?>actions/logout.php" class="nav-mobile-logout-btn">Logout</a>
                </li>
            <?php endif; ?>
        </ul>

        <div class="nav-right">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="<?php echo $base; ?>actions/logout.php" class="nav-signin-btn btn-logout">Logout</a>
            <?php else: ?>
                <a href="<?php echo $base; ?>pages/auth/login.php" class="nav-signin-btn">Sign In</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<main class="page-content">
