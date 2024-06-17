<!-- header.php -->
<?php

require_once 'session_manager.php';
// Check if the logout button is pressed
if(isset($_GET['page']) && $_GET['page'] === 'logout') {
    logoutUser(); // Call the logoutUser() function
    header("Location: /myweb/?page=home"); // Redirect to the home page after logout
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Routing Example</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to external CSS file -->
</head>
<body>
    <nav>
        <img src="logo.svg" alt="Logo" width="200" height="100">
        <ul>
            <li><a href="?page=home">Home</a></li>
            <li><a href="?page=about">About</a></li>
            <li><a href="?page=contact">Contact</a></li>
            <li><a href="?page=search">Search</a></li>
        </ul>
        <div class="auth-buttons">
            <?php if(isLoggedIn()): ?>
                <span class="welcome-text">Welcome, <?php echo $_SESSION['user_id']; ?>!</span>
                <a href="?page=logout" class="btn">Logout</a>
            <?php else: ?>
                <a href="?page=signin" class="btn">Sign In</a>
                <a href="?page=login" class="btn">Login</a>
            <?php endif; ?>
        </div>
    </nav>
