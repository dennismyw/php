<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "hpidb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$results = [];
$protein = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['protein'])) {
    $protein = $_POST['protein'];
    $scoreThreshold = isset($_POST['scoreThreshold']) ? (int)$_POST['scoreThreshold'] : 0;
    
    // Prepare SQL query with score threshold filtering
    $sql = "SELECT protein1, protein2, combined_score FROM ppi WHERE (protein1 = ? OR protein2 = ?) AND combined_score > ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $protein, $protein, $scoreThreshold);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $results = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $error = "No protein interactions found.";
    }
    
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Protein Interaction Network</title>
    <link href="https://unpkg.com/vis-network/styles/vis-network.min.css" rel="stylesheet" type="text/css" />
    <script src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>
</head>
<body>
    <form id="searchForm" method="POST" action="">
        <label for="protein">Enter Protein:</label>
        <input type="text" id="protein" name="protein" value="<?php echo htmlspecialchars($protein); ?>" required>
        <label for="scoreThreshold">Score Threshold:</label>
        <input type="number" id="scoreThreshold" name="scoreThreshold" value="<?php echo $scoreThreshold; ?>" required>
        <button type="submit">Search</button>
    </form>
    <p>e.g. search 10090.ENSMUSP00000000001</p>
   
    <div id="results">
        <?php if (!empty($results)) : ?>
            <div id="networkChart" style="width: 800px; height: 600px;"></div>
            <script>
                const chartData = <?php echo json_encode($results); ?>;
            </script>
            <script src="/../myweb/pages/network_chart.js"></script>
            <table id="resultTable" border="1">
                <thead>
                    <tr>
                        <th>Protein 1</th>
                        <th>Protein 2</th>
                        <th>Combined Score</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $row) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['protein1']); ?></td>
                            <td><?php echo htmlspecialchars($row['protein2']); ?></td>
                            <td><?php echo htmlspecialchars($row['combined_score']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php elseif ($error) : ?>
            <p id="errorMessage" style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
