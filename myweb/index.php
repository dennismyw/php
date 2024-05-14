<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main>
        <!-- <h3>signup</h3>
        <form action= "includes/formhandler.inc.php" method="POST">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <input type="text" name="email" placeholder="E-mail">
            <button>Signup</button>
        </form>
        <h3>Change account</h3>
        <form action= "includes/userupdate.inc.php" method="POST">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <input type="text" name="email" placeholder="E-mail">
            <button>Updatee</button>
        </form>
        <h3>Delete account</h3> -->
        <!-- <form action= "includes/userdelete.inc.php" method="POST">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <button>Delete</button>
        </form> -->

    <form class="Searchform" action = "search.php" method="POST">
        <label >Search for user:</label>
        <input id="search" type="text" name="usersearch" placeholder = "Search...">
        <button>Search</button>

    </form>


    </main>
</body>

</html>