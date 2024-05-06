<?php
session_start();

unset($_SESSION['eventId']);

if(!isset($_SESSION['user'])) {
    header('Location: login.php');
}



$rootPath = '../';

include '../include/db_inc.php';
include '../include/operazioni_cart.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>TikeTwo</title>
        <link rel="stylesheet" href="<?= $rootPath ?>Styles/header-footer.css">
        <link rel="stylesheet" href="<?= $rootPath ?>Styles/cart.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <link href="<?= $rootPath ?>Images/ticketwoW.png" rel="icon" type="image/png">
        <script src="<?= $rootPath ?>Scripts/counter.js" defer></script>
    </head>

    <body>
        <?php include '../include/header.php'; ?>

        <div class="carrello">
            <h1>Carrello</h1>
            <hr>
            <?php displayCart() ?>
        </div>

        <?php include '../include/footer.php'; ?>
    </body>
</html>
