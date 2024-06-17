

<?php
// signin.php
require_once 'session_manager.php';
?>
<!-- signin.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="auth-container">
    <h2>Signin</h2>
        <form action="process_signin.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Sign In</button>
        </form>
        <?php
        // Display session message if exists
        if (isset($_SESSION['message'])) {
            echo "<p>" . $_SESSION['message'] . "</p>";
            // Unset session message after displaying
            unset($_SESSION['message']);
        }
        ?>
    </div>
</body>
</html>
