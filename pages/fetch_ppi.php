<?php
$servername = "localhost";
$username = "root";  // Change to your database username
$password = "123456";  // Change to your database password
$dbname = "hpidb";  // Change to your database name


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['protein'])) {
    $protein = $_GET['protein'];
    
    try {
        $sql = "SELECT protein1, protein2, combined_score FROM ppi WHERE protein1 = :protein OR protein2 = :protein";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':protein', $protein);
        $stmt->execute();
        
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($results);
    } catch(PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}