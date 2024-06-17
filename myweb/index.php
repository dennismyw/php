<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Host-Pathogen Interaction Database</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

   
    <nav class="align-items-center section-priority-nav js-nav-processed priority-nav active priority-nav-has-dropdown" instance="0">
        <ul class="section-links align-items-center">
            <li><a href="?page=activation_of_genes">Activation/Inhibition of Genes</a></li>
            <li><a href="?page=posttranslational_modification">Posttranslational Modification</a></li>
            <li><a href="?page=induced_gene_expression">Induced Gene/Protein Expression</a></li>
            <li><a href="?page=protein_interaction">Protein-Protein Interaction</a></li>
            <li><a href="?page=altered_transport">Altered Transport</a></li>
           
    </nav>

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
            echo '<h1>Welcome to the Host-Pathogen Interaction Database</h1>';
            break;
    }

    include 'includes/footer.php';
    ?>
</body>
</html>
