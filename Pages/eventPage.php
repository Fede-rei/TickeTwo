<?php
$rootPath = '../';

include 'db_inc.php';


if (isset($db)) {
    $infoEq = $db->query('select * from Evento where id_evento = 0;');
}

$infoE = $infoEq->fetch();

$prezzo = $db->query('select prezzo from Evento e inner join Biglietto b on e.id_evento = b.id_event where id_evento = 0;')->fetch()['prezzo'];

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
        <script src="<?= $rootPath ?>Scripts/redirect.js"></script>
    </head>

    <body>
    <?php include 'header.php'; ?>

    <div class="imgEvent" style="background-image: url('../Images/<?= $infoE['image'] ?>')">
    </div>
    <div class="deets">
        <div class="desc">
            <h1><?= $infoE['nome'] ?></h1>
            <p>
                Descrizione: <?= $infoE['descrizione'] ?>
                <br> Location: <?= $infoE['luogo'] ?>
                <br> Quando: <?= $infoE['data'] ?>
            </p>
        </div>
        <div class="payment">
            <p><?= $prezzo ?> €<br>
            I biglietti verranno inviati via email verificata</p>
        </div>
    </div>

    <footer>
        wsedrftvgybhunj
    </footer>
    </body>
</html>