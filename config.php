<?php
$host = 'localhost'; // Change if necessary
$db = 'myfirstdb'; // The database you created
$user = 'root'; // Your MySQL username
$pass = '123456'; // Your MySQL password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $db :" . $e->getMessage());
}
?>
