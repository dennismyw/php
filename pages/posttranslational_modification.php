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

// Function to sanitize input
function sanitize($input) {
    global $conn;
    return mysqli_real_escape_string($conn, htmlspecialchars(strip_tags($input)));
}

// Handle delete action
if (isset($_POST['delete_entry'])) {
    $entry_id = sanitize($_POST['entry_id']);
    
    // SQL to delete entry
    $sql_delete = "DELETE FROM entries WHERE entry_id = $entry_id";
    if ($conn->query($sql_delete) === TRUE) {
        echo "Entry deleted successfully";
    } else {
        echo "Error deleting entry: " . $conn->error;
    }
}

$sql = "SELECT 
            entry_id, 
            entry_type, 
            primary_accession, 
            uniProtkb_id, 
            annotation_score, 
            protein_existence 
        FROM entries";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Entries</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../style.css"> <!-- Adjust the path accordingly -->
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Posttranslational Modification</h1>
        <form action="./pages/upload.php" method="post" enctype="multipart/form-data" class="mb-4">
            <div class="mb-3">
                <label for="file" class="form-label">Choose CSV File:</label>
                <input type="file" class="form-control" id="file" name="file" accept=".csv" required>
            </div>
            <button type="submit" class="btn btn-primary" name="upload">Upload CSV</button>
        </form>
        
        <!-- Table to display entries -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Entry ID</th>
                        <th>Entry Type</th>
                        <th>Primary Accession</th>
                        <th>UniProtKB ID</th>
                        <th>Annotation Score</th>
                        <th>Protein Existence</th>
                        <th>Action</th> <!-- New column for delete button -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td><a href='./pages/details.php?entry_id={$row['entry_id']}'>{$row['entry_id']}</a></td>
                                    <td>{$row['entry_type']}</td>
                                    <td>{$row['primary_accession']}</td>
                                    <td>{$row['uniProtkb_id']}</td>
                                    <td>{$row['annotation_score']}</td>
                                    <td>{$row['protein_existence']}</td>
                                    <td>
                                        <form method='post' action='./pages/posttranslational_modification.php'>
                                            <input type='hidden' name='entry_id' value='{$row['entry_id']}'>
                                            <button type='submit' class='btn btn-danger' name='delete_entry'>Delete</button>
                                        </form>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No entries found</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
