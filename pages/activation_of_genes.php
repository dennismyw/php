<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activation of Gene</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="style.css"> <!-- Custom CSS -->
    <style>
        .iframe-container {
            display: flex;
            flex-wrap: wrap;
        }
        .iframe-container iframe {
            flex: 1;
            height: 100vh;
            border: none;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Activation of Gene</h1>
            </div>
        </div>
        <div class="row iframe-container">
            <div class="col-12 col-md-6 p-0">
                <iframe src="pages/search.php" name="searchFrame"></iframe>
            </div>
            <div class="col-12 col-md-6 p-0">
                <iframe src="pages/barchart.php" name="chartFrame"></iframe>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap JS -->
</body>
</html>
