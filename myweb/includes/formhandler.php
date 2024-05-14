<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);
    $favouritepet = htmlspecialchars($_POST["favouritepet"]);

    echo "<div class='cyber-container'>";
    echo "<h2 class='cyber-heading'>Submission Details</h2>";
    echo "<p class='cyber-text'>First Name: $firstname</p>";
    echo "<p class='cyber-text'>Last Name: $lastname</p>";
    echo "<p class='cyber-text'>Favorite Pet: $favouritepet</p>";
    echo "</div>";
}
else {
    header('Location: ../index.php');
}
?>
