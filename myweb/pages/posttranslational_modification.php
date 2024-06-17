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
<html>
<head>
    <title>Entries</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Entries</h1>
    <table>
        <tr>
            <th>Entry ID</th>
            <th>Entry Type</th>
            <th>Primary Accession</th>
            <th>UniProtKB ID</th>
            <th>Annotation Score</th>
            <th>Protein Existence</th>
        </tr>
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
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No entries found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
