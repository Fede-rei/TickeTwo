<?php
// Includi il file di configurazione del database

if (isset($db)) {
    $events = $db->query('SELECT * FROM evento');
    $eventsArray = $events->fetchAll();
}

// Crea un array con i numeri da 1 a n
$carEventN = range(0, count($eventsArray) - 1);

// Mescola l'array
shuffle($carEventN);

// Seleziona i primi $count numeri
$carEventN = array_slice($carEventN, 0, 3);

$carEvents = array($eventsArray[$carEventN[0]], $eventsArray[$carEventN[1]], $eventsArray[$carEventN[2]]);
?>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <!-- Immagini del carosello -->
    <div class="carousel-inner">
        <?php foreach ($carEvents as $key => $item): ?>
            <div class="carousel-item <?php echo $key === 0 ? 'active' : ''; ?>">
                <a href="Pages/eventPage.php?eventId=<?= $item['id_evento'] ?>">
                <img class="d-block w-100" id="imgHeight" src="Images/<?= $item['image']?>" alt="<?= $item['nome'] ?>">
                </a>
                <div class="carousel-caption d-none d-md-block">
                    <h3 class="eventText"><?= $item['nome'] ?></h3>
                </div>
            </div>
        <?php endforeach; ?>
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
