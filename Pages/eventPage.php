<?php
$rootPath = '../';

include 'db_inc.php';

$infoE = $db->query('select * from Evento where id_evento = ' . 0 . ';');
$infoE = $infoE->fetch();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>TikeTwo</title>
        <link rel="stylesheet" href="<?= $rootPath ?>Styles/header.css">
        <link rel="stylesheet" href="<?= $rootPath ?>Styles/eventPage.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <link href="<?= $rootPath ?>Images/ticketwoW.png" rel="icon" type="image/png">
    </head>

    <body>
    <?php include 'header.php'; ?>

    <div class="imgEvent" style="background-image: url('../Images/<?= $infoE['image'] ?>');">

    </div>


    <footer></footer>
    </body>
</html>