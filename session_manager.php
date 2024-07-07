<?php
session_start();

// Function to check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Function to set user login status
function setUserLogin($user_id) {
    $_SESSION['user_id'] = $user_id;
}

// Function to log out user
function logoutUser() {
    // Unset all session variables
    $_SESSION = [];
    // Destroy the session
    session_destroy();
}
?>
