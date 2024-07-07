<?php
// process_login.php
require_once 'session_manager.php';
require_once 'config.php'; // Include the database connection configuration

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Prepare and execute SQL query to retrieve the user's hashed password
        $sql = "SELECT id, pwd FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Fetch the user record
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify the password against the hashed password
            if (password_verify($password, $user['pwd'])) {
                // Password is correct, user authenticated successfully
                echo "Login successful!";
                $user_id = $user['id'];
                setUserLogin($user_id); // Set the user login state
                // Redirect the user to another page
                header("Location: /myweb/?page=home");
                exit();
            } else {
                // Password is incorrect
                echo "Invalid email or password. Please try again.";
            }
        } else {
            // No user found with the provided email
            echo "Invalid email or password. Please try again.";
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>
