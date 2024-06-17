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
$chromosomeCounts = [];
$searchQuery = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchQuery = $conn->real_escape_string($_POST['search']);

    // Define your SQL query
    $sql = "SELECT Chromosome, COUNT(*) as count FROM gene_data WHERE Name LIKE '%$searchQuery%' OR Chromosome LIKE '%$searchQuery%' OR Region LIKE '%$searchQuery%' GROUP BY Chromosome";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $chromosomeCounts[$row['Chromosome']] = $row['count'];
        }
    } else {
        echo "No results found.";
    }
}

// Convert PHP array to JSON format for Chart.js
$chartData = json_encode($chromosomeCounts);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chromosome Chart</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="../style.css"> <!-- Adjust the path accordingly -->
</head>
<body>
    <form method="post" action="">
        <input type="text" name="search" placeholder="Enter search term">
        <input type="submit" value="Search">
    </form>
    <p>Show the chromosome bar chart by Search result: "<?php echo htmlspecialchars($searchQuery); ?>"</p>
    <?php if (!empty($chromosomeCounts)): ?>
        <h2>Chromosome Counts</h2>
        <canvas id="myChart"></canvas>

        <script>
            // JavaScript code to create the chart
            var ctx = document.getElementById('myChart').getContext('2d');
            var chartData = <?php echo $chartData; ?>; // Fetch data from PHP

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Object.keys(chartData),
                    datasets: [{
                        label: 'Number of Chromosomes',
                        data: Object.values(chartData),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p>No results found.</p>
    <?php endif; ?>
</body>
</html>
