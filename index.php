<?php
// Avvia la sessione
session_start();


// Includi il file di configurazione del database
include 'include/db_inc.php';

// Se l'utente ha effettuato l'accesso ma non ha ancora un'immagine del profilo nella sessione, recupera l'immagine dal database
if(!isset($_SESSION['pic']) && isset($_SESSION['user'])) {
    if (isset($db)) {
        $pfpq = $db->query('select pfp from utente where id_utente = ' . $_SESSION['user']);
        $_SESSION['pic'] = $pfpq->fetch()['pfp'];
    }
}
elseif(!isset($_SESSION['user']))
    $_SESSION['pic'] = "0.png";

// Imposta il percorso radice del sito
$rootPath = './';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TickeTwo - Home</title>
    <!-- Metadati -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Collegamenti ai fogli di stile -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="Images/ticketwoW.png" rel="icon" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Collegamenti agli script JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Collegamenti ai fogli di stile personalizzati -->
    <link rel="stylesheet" href="Styles/header-footer.css">
    <link rel="stylesheet" href="Styles/index.css">
    <script src="Scripts/search.js" defer ></script>

    <link rel="stylesheet" href="Styles/swiperStyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.4/swiper-bundle.min.css">
</head>
<body>
<?php include 'include/header.php'; ?>

<div>
    <!-- Carosello -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <!-- Indicatori di navigazione -->
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <!-- Immagini del carosello -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" id="imgHeight" src="Images/ticketwo.png" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <h3 class="eventText">BO</h3>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" id="imgHeight" src="Images/0.png" alt="Second slide">
                <div class="carousel-caption d-none d-md-block">
                    <h3 class="eventText">BO</h3>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" id="imgHeight" src="Images/blu.jpg" alt="Third slide">
                <div class="carousel-caption d-none d-md-block">
                    <h3 class="eventText">BO</h3>
                </div>
            </div>
        </div>
        <!-- Controlli del carosello -->
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

        <p class="text-center text-3 mt-3">Eventi Sportivi: </p>
        <?php include 'include/swiper.php'; ?>

        <p class="text-center text-3 mt-3">Concerti: </p>
        <?php include 'include/swiper.php'; ?>

        <p class="text-center text-3 mt-3">Fiere: </p>
        <?php include 'include/swiper.php'; ?>



        <?php include 'include/footer.php'; ?>
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
        <script src="script.js"></script>
    </div>
</body>

<?php include 'include/footer.php'; ?>
</body>
</html>
