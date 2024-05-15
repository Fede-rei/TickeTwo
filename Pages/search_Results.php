<?php
session_start();

$rootPath = '../';

include '../include/db_inc.php';


if(isset($db)){
    $stmt = $db->prepare('SELECT * FROM Evento WHERE nome LIKE CONCAT(:valore, "%")');
    $stmt->execute(['valore' => $_GET["searchQueryInput"]]);
    $risultati = $stmt->fetchAll();
}

if(isset($_SERVER['HTTP_REFERER'])) {
    $previousPage = $_SERVER['HTTP_REFERER'];
} else {
    $previousPage = '';
}


?>
<!doctype html>
<html lang="en">
    <head>
        <title>TickeTwo - Risultato Eventi</title>
        <!-- Metadati -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Collegamenti ai fogli di stile -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <link href="../Images/ticketwoW.png" rel="icon" type="image/png">
        <!-- Collegamenti ai fogli di stile personalizzati -->
        <link rel="stylesheet" href="../Styles/header-footer.css">
        <link rel="stylesheet" href="../Styles/search_results.css">
    </head>
    <body>

        <?php
        include '../include/header.php';
        ?>

        <div class="sRes">
            <!-- Link per tornare indietro -->
            <div class="back">
                <a href="<?= $previousPage ?>">
                    <!-- Icona per tornare indietro -->
                    <span class="material-symbols-outlined">
                keyboard_backspace
            </span>
                </a>
            </div>
            <?php if(isset($risultati[0])) {
                foreach ($risultati as $riga) { ?>
                    <section class='sr_card'>
                        <a href="eventPage.php?eventId=<?= $riga['id_evento'] ?>">
                            <div class='sr_card_content'>
                                <!-- Aggiungi l'immagine qui con il link fornito nel campo "image" -->
                                <div class='img_sr_card'>
                                    <img src='<?=$rootPath."/Images/". $riga['image']?>' alt='Immagine evento'>
                                </div>

                                <div class='text_sr_card'>
                                    <!-- Stampa il resto delle informazioni dell'evento -->
                                    <h2><?= $riga["nome"] ?></h2>
                                    <p><?= $riga["descrizione"] ?></p>
                                    <p>Data: <?= $riga["data"] ?></p>
                                    <p>Luogo: <?= $riga["luogo"] ?></p>
                                    <p>Posti disponibili: <?= $riga["posti"] ?></p>

                                </div>
                            </div>
                        </a>
                    </section>
            <?php }
            } else { ?>
                <p class="nEl">Nessun evento trovato</p>
            <?php } ?>
        </div>

        <?php include '../include/footer.php'; ?>
    </body>
</html>