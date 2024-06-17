
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
    </style>
</head>
<body>
    <h1>Details for Entry ID: <?php echo $entry_id; ?></h1>
         <!-- Export buttons -->
    <form method="post" action="csvoutput.php?entry_id=<?php echo htmlspecialchars($_GET['entry_id']); ?>">
        <button type="submit" class="export-btn" name="export_comments">Export Comments to CSV</button>
        <button type="submit" class="export-btn" name="export_entries">Export Entries to CSV</button>
        <button type="submit" class="export-btn" name="export_entry_audit">Export Entry Audit to CSV</button>
        <button type="submit" class="export-btn" name="export_organism">Export Organism to CSV</button>
        <button type="submit" class="export-btn" name="export_pathway">Export Pathway to CSV</button>
        <button type="submit" class="export-btn" name="export_protein_description">Export Protein Description to CSV</button>
        <button type="submit" class="export-btn" name="export_reaction_cross_references">Export Reaction Cross References to CSV</button>
    </form>
    <h2>Comments</h2>
    <table>
        <tr>
            <th>Comment ID</th>
            <th>Comment Type</th>
            <th>Value</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result_comments)): ?>
        <tr>
            <td><?php echo $row['comment_id']; ?></td>
            <td><?php echo $row['comment_type']; ?></td>
            <td><?php echo $row['value']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Entries</h2>
    <table>
        <tr>
            <th>Entry Type</th>
            <th>Primary Accession</th>
            <!-- Add more columns as needed -->
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result_entries)): ?>
        <tr>
            <td><?php echo $row['entry_type']; ?></td>
            <td><?php echo $row['primary_accession']; ?></td>
            <!-- Add more columns as needed -->
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Entry Audit</h2>
    <table>
        <tr>
            <th>First Public Date</th>
            <th>Last Annotation Update Date</th>
            <!-- Add more columns as needed -->
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result_entry_audit)): ?>
        <tr>
            <td><?php echo $row['first_public_date']; ?></td>
            <td><?php echo $row['last_annotation_update_date']; ?></td>
            <!-- Add more columns as needed -->
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Organism</h2>
    <table>
        <tr>
            <th>Scientific Name</th>
            <th>Taxon ID</th>
            <!-- Add more columns as needed -->
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result_organism)): ?>
        <tr>
            <td><?php echo $row['scientific_name']; ?></td>
            <td><?php echo $row['taxon_id']; ?></td>
            <!-- Add more columns as needed -->
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Pathway</h2>
    <table>
        <tr>
            <th>Pathway Description</th>
            <!-- Add more columns as needed -->
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result_pathway)): ?>
        <tr>
            <td><?php echo $row['pathway_description']; ?></td>
            <!-- Add more columns as needed -->
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Protein Description</h2>
    <table>
        <tr>
            <th>Full Name</th>
            <th>Short Names</th>
            <th>EC Numbers</th>
            <!-- Add more columns as needed -->
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result_protein_description)): ?>
        <tr>
            <td><?php echo $row['full_name']; ?></td>
            <td><?php echo $row['short_names']; ?></td>
            <td><?php echo $row['ec_numbers']; ?></td>
            <!-- Add more columns as needed -->
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Reaction Cross References</h2>
    <table>
        <tr>
            <th>Reaction Name</th>
            <th>Reaction Cross References</th>
            <!-- Add more columns as needed -->
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result_reaction_cross_references)): ?>
        <tr>
            <td><?php echo $row['reaction_name']; ?></td>
            <td><?php echo $row['reaction_cross_references']; ?></td>
            <!-- Add more columns as needed -->
        </tr>
        <?php endwhile; ?>
    </table>
    
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