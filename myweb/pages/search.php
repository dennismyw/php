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

$results = [];
$searchQuery = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchQuery = $conn->real_escape_string($_POST['search']);

    // Define your SQL query
    $sql = "SELECT * FROM gene_data WHERE Name LIKE '%$searchQuery%' OR Chromosome LIKE '%$searchQuery%' OR Region LIKE '%$searchQuery%'";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch all results into an array
        $results = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "No results found.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Search</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    <form method="post" action="">
        <input placeholder="e.g. SPACA" type="text" name="search" >
        <input type="submit" value="Search">
        
    </form>
    <p>Show the chromosome table by Search result: "<?php echo htmlspecialchars($searchQuery); ?>"</p>

    <?php if (isset($results) && count($results) > 0): ?>
        <h2>Search Results:</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Chromosome</th>
                    <th>Region</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($result['Name']); ?></td>
                        <td><?php echo htmlspecialchars($result['Chromosome']); ?></td>
                        <td><?php echo htmlspecialchars($result['Region']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p>No results found.</p>
    <?php endif; ?>
</body>
</html>
