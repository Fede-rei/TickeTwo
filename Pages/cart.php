<?php
session_start();

unset($_SESSION['eventId']);

if(!isset($_SESSION['user'])) {
    header('Location: login.php');
}



$rootPath = '../';

include '../include/db_inc.php';
include '../include/operazioni_cart.php';

if(!isset($_SESSION['pic'])&&isset($_SESSION['user'])) {
    if (isset($db)) {
        $pfpq = $db->query('select pfp from utente where id_utente = ' . $_SESSION['user']);
        $pfp = $pfpq->fetch()['pfp'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>TikeTwo - Carrello</title>
        <link rel="stylesheet" href="../Styles/header-footer.css">
        <link rel="stylesheet" href="../Styles/cart.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <link href="../Images/ticketwoW.png" rel="icon" type="image/png">
        <script src="../Scripts/counter.js" defer></script>
    </head>

    <body>
        <?php include '../include/header.php'; ?>

        <div class="carrello">
            <h1>Carrello</h1>
            <hr>
            <div class="cart">
                <?php displayCart() ?>
                <?php total() ?>
            </div>
        </div>

        <?php include '../include/footer.php'; ?>
    </body>
</html>
