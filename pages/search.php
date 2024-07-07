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
        echo "<div class='alert alert-warning' role='alert'>No results found.</div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../style.css"> <!-- Custom CSS -->
</head>

<body>
    <div class="container mt-5">
        <form method="post" action="" class="mb-4">
            <div class="input-group">
                <input placeholder="e.g. SPACA" type="text" name="search" class="form-control" value="<?php echo htmlspecialchars($searchQuery); ?>">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <p class="lead">Show the chromosome table by Search result: "<?php echo htmlspecialchars($searchQuery); ?>"</p>

        <?php if (isset($results) && count($results) > 0): ?>
            <h2 class="mb-3">Search Results:</h2>
            <table class="table table-striped table-bordered">
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
            <div class="alert alert-warning" role="alert">No results found.</div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap JS -->
</body>

</html>
