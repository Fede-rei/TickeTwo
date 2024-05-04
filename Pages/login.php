<?php
$rootPath = '../'
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>TikeTwo</title>
        <link rel="stylesheet" href="<?= $rootPath ?>Styles/login.css">
        <link rel="stylesheet" href="<?= $rootPath ?>Styles/header-footer.css">
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <link href="<?= $rootPath ?>Images/ticketwoW.png" rel="icon" type="image/png">
    </head>

    <body>
        <?php include '../include/header.php'; ?>

        <div id="chest">
            <form method="post">
                <label for="p1">Username: </label>
                <input type="text" id="p1" name="username" placeholder="Username"><br>
                <label for="p2">Password: </label>
                <input type="password" name="pw" id="p2" placeholder="Password"><br>
                <button type="submit">Submit</button>
            </form>
            <a href="signup.php">Registrati...</a>
        </div>

        <?php include '../include/footer.php'; ?>
    </body>
</html>
