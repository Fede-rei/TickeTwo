<?php
session_start();

$rootPath = '../';

include '../include/db_inc.php';

$sql = "SELECT * FROM Evento WHERE nome LIKE CONCAT(:valore, '%')";

if(isset($db)){
    $stmt = $db->prepare('SELECT * FROM Evento WHERE nome LIKE CONCAT(:valore, "%")');
    $stmt->execute(['valore' => $_GET["searchQueryInput"]]);
}


$risultati = $stmt->fetchAll();

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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Collegamenti agli script JavaScript -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!-- Collegamenti ai fogli di stile personalizzati -->
        <link rel="stylesheet" href="../Styles/header-footer.css">
        <link rel="stylesheet" href="../Styles/index.css">
        <!--<script src="Scripts/search.js" defer ></script>-->

        <link rel="stylesheet" href="../Styles/swiperStyle.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.4/swiper-bundle.min.css">


        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
                integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
                integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.4/swiper-bundle.min.js"></script>
        <script src="../Scripts/swiper.js" defer></script>

        <link rel="stylesheet" href="../Styles/search_results.css">
    </head>
    <body>

        <?php
        include '../include/header.php';
        ?>

        <?php foreach ($risultati as $riga) { ?>
                <section class='sr_card'>;
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
        <?php } ?>


        <?php include '../include/footer.php'; ?>
    </body>
</html>