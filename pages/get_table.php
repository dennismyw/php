<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "proteomics";

function fetchTable($conn, $tableName, $columns) {
    $sql = "SELECT * FROM $tableName";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table class='table table-bordered mt-3'><tr>";
        foreach ($columns as $column) {
            echo "<th>$column</th>";
        }
        echo "</tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($columns as $column) {
                echo "<td>" . (isset($row[$column]) ? $row[$column] : "N/A") . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
}

if (isset($_GET['table']) && isset($_GET['columns'])) {
    $tableName = $_GET['table'];
    $columns = explode(',', $_GET['columns']);
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    fetchTable($conn, $tableName, $columns);
    $conn->close();
}
?>
