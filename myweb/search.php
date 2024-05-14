<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $userSearch = $_POST["usersearch"];

    try {
        require_once "includes/dbh.inc.php";
        $query = "SELECT * FROM comments WHERE username = :usersearch;";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":usersearch", $userSearch);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

       

        // Close connections
        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

} else {
    header("Location: ../index.php");
    // exit(); // Make sure to stop execution after redirection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main>
        <h3>Search Results:</h3>
        <?php
        if (empty($results)){
            echo "<div>";
            echo "<p>No results found</p>";
            echo "</div>";
        } else {
            // var_dump($results);
            foreach ($results as $row) {
                echo htmlspecialchars($row["username"]);
                echo htmlspecialchars($row["comment_text"]);
                echo htmlspecialchars($row["created_at"]);

                
            
            }
        }
        ?>
    </main>
</body>
</html>
