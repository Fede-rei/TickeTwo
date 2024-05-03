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
        <script src="<?= $rootPath ?>Scripts/counter.js" defer></script>
    </head>

    <body>
    <?php include 'header.php'; ?>

    <div class="imgEvent" style="background-image: url('../Images/<?= $infoE['image'] ?>')">
        <a href="<?= $rootPath ?>index.php"><div class="back">
            <span class="material-symbols-outlined">
                keyboard_backspace
            </span>
        </div></a>
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
            I biglietti verranno inviati all'email verificata</p>

            <div class="quantity">
                <label for="counter">Qta</label>
                <div id="counter">
                    <span class="down" onClick='decreaseCount(event, this)'>-</span>
                    <input type="text" min="1" value="1">
                    <span class="up" onClick='increaseCount(event, this)'>+</span>
                </div>
            </div>

            <button>Aggiungi al carrello</button>
            <button>Acquista ora</button>
        </div>
    </div>

    <footer>
        wsedrftvgybhunj
    </footer>
    </body>
</html>