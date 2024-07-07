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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="style.css"> <!-- Link to custom CSS file -->
</head>
<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #004977;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="logo.svg" alt="Logo" width="200" height="100">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="?page=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="?page=about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="?page=contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="?page=search">Search</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <?php if(isLoggedIn()): ?>
                        <span class="navbar-text text-white me-3">Welcome, <?php echo $_SESSION['user_id']; ?>!</span>
                        <a href="?page=logout" class="btn btn-primary">Logout</a>
                    <?php else: ?>
                        <a href="?page=signin" class="btn btn-primary me-2">Sign In</a>
                        <a href="?page=login" class="btn btn-primary">Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
