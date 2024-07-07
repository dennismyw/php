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

function generateCSV($filename, $data) {
    // Set headers to force download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    // Open output stream
    $output = fopen('php://output', 'w');

    // Write headers
    fputcsv($output, array_keys($data[0]));

    // Write data rows
    foreach ($data as $row) {
        fputcsv($output, $row);
    }

    // Close the output stream
    fclose($output);
}

// Check if entry_id parameter is set and is numeric
if (isset($_GET['entry_id']) && is_numeric($_GET['entry_id'])) {
    // Sanitize the input to prevent SQL injection
    $entry_id = intval($_GET['entry_id']);

    // Query to fetch data from each table based on entry_id
    $query_comments = "SELECT * FROM comments WHERE entry_id = $entry_id";
    $query_entries = "SELECT * FROM entries WHERE entry_id = $entry_id";
    $query_entry_audit = "SELECT * FROM entry_audit WHERE entry_id = $entry_id";
    $query_organism = "SELECT * FROM organisms WHERE entry_id = $entry_id";
    $query_pathway = "SELECT * FROM pathway WHERE entry_id = $entry_id";
    $query_protein_description = "SELECT * FROM protein_description WHERE entry_id = $entry_id";
    $query_reaction_cross_references = "SELECT * FROM reaction_cross_references WHERE entry_id = $entry_id";

    // Execute queries
    $result_comments = mysqli_query($conn, $query_comments);
    $result_entries = mysqli_query($conn, $query_entries);
    $result_entry_audit = mysqli_query($conn, $query_entry_audit);
    $result_organism = mysqli_query($conn, $query_organism);
    $result_pathway = mysqli_query($conn, $query_pathway);
    $result_protein_description = mysqli_query($conn, $query_protein_description);
    $result_reaction_cross_references = mysqli_query($conn, $query_reaction_cross_references);

    // Check if queries returned results
    if ($result_comments && $result_entries && $result_entry_audit && $result_organism &&
        $result_pathway && $result_protein_description && $result_reaction_cross_references) {

        // Fetch all rows from each result set
        $comments_data = mysqli_fetch_all($result_comments, MYSQLI_ASSOC);
        $entries_data = mysqli_fetch_all($result_entries, MYSQLI_ASSOC);
        $entry_audit_data = mysqli_fetch_all($result_entry_audit, MYSQLI_ASSOC);
        $organism_data = mysqli_fetch_all($result_organism, MYSQLI_ASSOC);
        $pathway_data = mysqli_fetch_all($result_pathway, MYSQLI_ASSOC);
        $protein_description_data = mysqli_fetch_all($result_protein_description, MYSQLI_ASSOC);
        $reaction_cross_references_data = mysqli_fetch_all($result_reaction_cross_references, MYSQLI_ASSOC);

        // Function to generate CSV for each dataset
        // You can customize the filename and data as needed
        $filename_comments = 'comments.csv';
        $filename_entries = 'entries.csv';
        $filename_entry_audit = 'entry_audit.csv';
        $filename_organism = 'organism.csv';
        $filename_pathway = 'pathway.csv';
        $filename_protein_description = 'protein_description.csv';
        $filename_reaction_cross_references = 'reaction_cross_references.csv';

        // Generate CSV for each dataset
        if (isset($_POST['export_comments'])) {
            generateCSV($filename_comments, $comments_data);
        } elseif (isset($_POST['export_entries'])) {
            generateCSV($filename_entries, $entries_data);
        } elseif (isset($_POST['export_entry_audit'])) {
            generateCSV($filename_entry_audit, $entry_audit_data);
        } elseif (isset($_POST['export_organism'])) {
            generateCSV($filename_organism, $organism_data);
        } elseif (isset($_POST['export_pathway'])) {
            generateCSV($filename_pathway, $pathway_data);
        } elseif (isset($_POST['export_protein_description'])) {
            generateCSV($filename_protein_description, $protein_description_data);
        } elseif (isset($_POST['export_reaction_cross_references'])) {
            generateCSV($filename_reaction_cross_references, $reaction_cross_references_data);
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Page</title>
    <!-- Include any CSS or meta tags needed for styling -->
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .export-btn {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Details for Entry ID: <?php echo $entry_id; ?></h1>

    <!-- Export buttons -->
    <form method="post">
        <button type="submit" class="export-btn" name="export_comments">Export Comments to CSV</button>
        <button type="submit" class="export-btn" name="export_entries">Export Entries to CSV</button>
        <button type="submit" class="export-btn" name="export_entry_audit">Export Entry Audit to CSV</button>
        <button type="submit" class="export-btn" name="export_organism">Export Organism to CSV</button>
        <button type="submit" class="export-btn" name="export_pathway">Export Pathway to CSV</button>
        <button type="submit" class="export-btn" name="export_protein_description">Export Protein Description to CSV</button>
        <button type="submit" class="export-btn" name="export_reaction_cross_references">Export Reaction Cross References to CSV</button>
    </form>

    <!-- Display tables (similar to previous implementation) -->

</body>
</html>
<?php
    } else {
        echo "Error: Unable to fetch data from the database.";
    }

    // Free result sets
    mysqli_free_result($result_comments);
    mysqli_free_result($result_entries);
    mysqli_free_result($result_entry_audit);
    mysqli_free_result($result_organism);
    mysqli_free_result($result_pathway);
    mysqli_free_result($result_protein_description);
    mysqli_free_result($result_reaction_cross_references);
} else {
    // Handle case where entry_id is not provided or is invalid
    echo "Error: Entry ID not provided or invalid.";
}
?>
