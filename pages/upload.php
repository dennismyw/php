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

// Handle file upload
if (isset($_POST['upload'])) {
    $file = $_FILES['file'];

    // Check if file is uploaded successfully
    if ($file['error'] === UPLOAD_ERR_OK) {
        $filename = $file['tmp_name'];

        // Read the file
        $handle = fopen($filename, "r");

        // Skip the header row
        fgetcsv($handle);

        // Prepare SQL statement
        $sql = "INSERT INTO entries (entry_type, primary_accession, uniProtkb_id, annotation_score, protein_existence) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bind_param("sssss", $entry_type, $primary_accession, $uniProtkb_id, $annotation_score, $protein_existence);

        // Read data from CSV and insert into database
        while (($data = fgetcsv($handle)) !== false) {
            $entry_type = $data[0];
            $primary_accession = $data[1];
            $uniProtkb_id = $data[2];
            $annotation_score = $data[3];
            $protein_existence = $data[4];

            $stmt->execute();
        }

        fclose($handle);
        echo "<h2 class='alert alert-success'>CSV file uploaded successfully and data inserted into database.</h2>";
    } else {
        echo "<div class='alert alert-danger'>Error uploading file: " . $file['error'] . "</div>";
    }
}

// Close connection
$conn->close();
?>
