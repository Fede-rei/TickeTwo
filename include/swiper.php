<?php
// Includi il file di configurazione del database
include 'include/db_inc.php';

if (isset($db)) {
    $events = $db->query('select * from evento');
    $eventsarray = $events->fetchall();
}
?>
<div class="swiper-container">
    <div class="swiper-wrapper">
        <?php foreach ($eventsarray as $item): ?>
            <a href="../Pages/eventPage.php?eventId=<?= $item['id_evento'] ?>">
                <div class="swiper-slide">
                    <?= $item['nome'] ?>
                    <img class="event-image" src="../Images/<?= $item['image'] ?>">
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>
