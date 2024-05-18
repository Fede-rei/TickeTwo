<?php
// Includi il file di configurazione del database
if (isset($db)) {
    $events = $db->query('select * from evento');
    $eventsarray = $events->fetchall(PDO::FETCH_ASSOC);
}
?>
<div class="swiper-container">
    <div class="swiper-wrapper">
        <?php foreach ($eventsarray as $item): ?>
            <div class="swiper-slide">
                <a class="sCL" href="Pages/eventPage.php?eventId=<?= $item['id_evento'] ?>">
                    <div class="cardItem">
                        <p><?= $item['nome'] ?></p>
                        <img class="event-image" src="Images/<?= $item['image'] ?>">
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>
