<?php
// process_signin.php
require_once 'session_manager.php';
require_once 'config.php'; // Include the database connection configuration

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    try {
        $sql = "INSERT INTO users (username, email, pwd) VALUES (:username, :email, :pwd)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pwd', $password);
        $stmt->execute();

        $_SESSION['message'] = "New user created successfully! Please log in!";
        header("Location: /myweb/?page=signin");
        exit();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$pdo = null; // Close the database connection
?>
