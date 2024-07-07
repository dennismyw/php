<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Host-Pathogen Interaction Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="style.css"> <!-- Custom CSS -->
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container mt-4">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="?page=activation_of_genes">Activation/Inhibition of Genes</a></li>
                        <li class="nav-item"><a class="nav-link" href="?page=posttranslational_modification">Posttranslational Modification</a></li>
                        <li class="nav-item"><a class="nav-link" href="?page=induced_gene_expression">Induced Gene/Protein Expression</a></li>
                        <li class="nav-item"><a class="nav-link" href="?page=protein_interaction">Protein-Protein Interaction</a></li>
                        <li class="nav-item"><a class="nav-link" href="?page=altered_transport">Altered Transport</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="mt-4">
            <?php
            $page = isset($_GET['page']) ? $_GET['page'] : 'home';

            switch ($page) {
                case 'home':
                    include 'pages/home.php';
                    break;
                case 'about':
                    include 'pages/about.php';
                    break;
                case 'contact':
                    include 'pages/contact.php';
                    break;
                case 'signin':
                    include 'pages/signin.php';
                    break;
                case 'login':
                    include 'pages/login.php';
                    break;
                case 'activation_of_genes':
                    include 'pages/activation_of_genes.php';
                    break;
                case 'posttranslational_modification':
                    include 'pages/posttranslational_modification.php';
                    break;
                case 'induced_gene_expression':
                    include 'pages/induced_gene_expression.php';
                    break;
                case 'protein_interaction':
                    include 'pages/protein_interaction.php';
                    break;
                case 'altered_transport':
                    include 'pages/altered_transport.php';
                    break;
                case 'search':
                    include 'pages/search.php';
                    break;
                default:
                    echo '<h1 class="text-center">Welcome to the Host-Pathogen Interaction Database</h1>';
                    break;
            }
            ?>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap JS -->
</body>
</html>
