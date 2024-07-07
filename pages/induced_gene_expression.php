<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "proteomics";

// Function to fetch and display a table with debug information
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

        // Debugging: Print fetched data
        echo "<pre>";
        print_r($row);
        echo "</pre>";
    } else {
        echo "0 results";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Induced Gene Expression</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="panel panel-primary">
            <div class="panel-heading">
                CHK2_HUMAN - PTM Information in dbPTM
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="protein-expression-tab" data-bs-toggle="tab" data-bs-target="#protein-expression" type="button" role="tab" aria-controls="protein-expression" aria-selected="true">Protein Expression</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pathogen-tab" data-bs-toggle="tab" data-bs-target="#pathogen" type="button" role="tab" aria-controls="pathogen" aria-selected="false">Pathogen</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="go-analysis-tab" data-bs-toggle="tab" data-bs-target="#go-analysis" type="button" role="tab" aria-controls="go-analysis" aria-selected="false">GO Analysis</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="kegg-pathway-tab" data-bs-toggle="tab" data-bs-target="#kegg-pathway" type="button" role="tab" aria-controls="kegg-pathway" aria-selected="false">KEGG Pathway</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="phosphoproteomic-expression-tab" data-bs-toggle="tab" data-bs-target="#phosphoproteomic-expression" type="button" role="tab" aria-controls="phosphoproteomic-expression" aria-selected="false">Phosphoproteomic Expression</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="phospho-kegg-pathway-tab" data-bs-toggle="tab" data-bs-target="#phospho-kegg-pathway" type="button" role="tab" aria-controls="phospho-kegg-pathway" aria-selected="false">Phospho KEGG Pathway</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="protein-interaction-tab" data-bs-toggle="tab" data-bs-target="#protein-interaction" type="button" role="tab" aria-controls="protein-interaction" aria-selected="false">Protein Interaction</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="protein-expression" role="tabpanel" aria-labelledby="protein-expression-tab">
                        <?php
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        fetchTable($conn, 'protein_expression', ['time_interval', 'upregulated_proteins', 'downregulated_proteins', 'upregulated_proteins_greater_than_1_5_fold', 'downregulated_proteins_less_than_1_5_fold']);
                        $conn->close();
                        ?>
                    </div>
                    <div class="tab-pane fade" id="pathogen" role="tabpanel" aria-labelledby="pathogen-tab">
                        <?php
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            fetchTable($conn, 'pathogen', ['pathogen_id', 'species', 'strain']);
                            $conn->close();
                        ?>
                    </div>
                    <div class="tab-pane fade" id="go-analysis" role="tabpanel" aria-labelledby="go-analysis-tab">
                        <?php
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            fetchTable($conn, 'go_analysis', ['go_id', 'time_interval', 'upregulated_go_terms', 'downregulated_go_terms']);
                            $conn->close();
                        ?>
                    </div>
                    <div class="tab-pane fade" id="kegg-pathway" role="tabpanel" aria-labelledby="kegg-pathway-tab">
                    <?php
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        fetchTable($conn, 'kegg_pathway_analysis', ['pathway_id', 'pathway_name', 'hits', 'fdr']);
                        $conn->close();
                        ?>
                    </div>
                    
                    <div class="tab-pane fade" id="phosphoproteomic-expression" role="tabpanel" aria-labelledby="phosphoproteomic-expression-tab">

                    </div>
                    <div class="tab-pane fade" id="phospho-kegg-pathway" role="tabpanel" aria-labelledby="phospho-kegg-pathway-tab">
                        <!-- Placeholder for phospho KEGG pathway table content -->
                    </div>
                    <div class="tab-pane fade" id="protein-interaction" role="tabpanel" aria-labelledby="protein-interaction-tab">
                        <!-- Placeholder for protein interaction table content -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
