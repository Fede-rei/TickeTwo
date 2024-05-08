<?php
// Avvia la sessione
session_start();

// Imposta il percorso radice del sito
$rootPath = '../';

// Verifica se l'utente ha effettuato l'accesso e se ha selezionato un evento
if(!isset($_SESSION['eventId'])) {
    // Se l'utente non ha selezionato un evento, reindirizza alla pagina di login
    if(!isset($_SESSION['user'])) {
        header('Location: login.php');
    } else {
        // Se l'utente ha effettuato l'accesso ma non ha selezionato un evento, reindirizza alla homepage
        header('Location: ..');
    }
}

// Includi il file di configurazione del database
include '../include/db_inc.php';

// Recupera le informazioni sull'evento selezionato dal database
if (isset($db)) {
    $infoEq = $db->query('select * from Evento e inner join Biglietto b on e.id_evento = b.id_event where id_evento = ' . $_SESSION['eventId']);
    $infoE = $infoEq->fetch();
}

// Se l'utente ha effettuato l'accesso ma non ha ancora un'immagine del profilo nella sessione, recupera l'immagine dal database
if(!isset($_SESSION['pic']) && isset($_SESSION['user'])) {
    $pfpq = $db->query('select pfp from utente where id_utente = ' . $_SESSION['user']);
    $_SESSION['pic'] = $pfpq->fetch()['pfp'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TickeTwo - <?= $infoE['nome'] ?></title>
    <!-- Includi i fogli di stile -->
    <link rel="stylesheet" href="../Styles/header-footer.css">
    <link rel="stylesheet" href="../Styles/eventPage.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="../Images/ticketwoW.png" rel="icon" type="image/png">
    <!-- Includi lo script per il contatore dei biglietti -->
    <script src="../Scripts/counter.js" defer></script>
    <script src="../Scripts/search.js" defer></script>
</head>

<body>
<?php include '../include/header.php'; ?>

<div class="imgEvent" style="background-image: url('<?= $infoE['image'] ?>')">
    <!-- Link per tornare indietro -->
    <a href="..">
        <div class="back">
            <!-- Icona per tornare indietro -->
            <span class="material-symbols-outlined">
                keyboard_backspace
            </span>
        </div>
    </a>
</div>

<div class="deets">
    <div class="desc">
        <!-- Nome dell'evento -->
        <h1><?= $infoE['nome'] ?></h1>
        <!-- Descrizione, luogo e data dell'evento -->
        <p>
            Descrizione: <?= $infoE['descrizione'] ?>
            <br> Location: <?= $infoE['luogo'] ?>
            <br> Quando: <?= $infoE['data'] ?>
        </p>
    </div>
    <div class="payment">
        <!-- Prezzo del biglietto -->
        <p><?= $infoE['prezzo'] ?> €<br>
            I biglietti verranno inviati all'email verificata</p>

        <!-- Quantità dei biglietti -->
        <div class="quantity">
            <label for="counter">Qta</label>
            <div id="counter">
                <span class="down" onClick='decreaseCount(event, this)'>-</span>
                <input type="text" min="1" value="1">
                <span class="up" onClick='increaseCount(event, this)'>+</span>
            </div>
        </div>

        <!-- Pulsanti per aggiungere al carrello o acquistare ora -->
        <button>Aggiungi al carrello</button>
        <button>Acquista ora</button>
    </div>
</div>

<?php include '../include/footer.php'; ?>
</body>
</html>
