<?php
// Avvia la sessione
session_start();

// Cancella l'ID dell'evento dalla sessione
unset($_SESSION['eventId']);

// Se l'utente non ha effettuato l'accesso, reindirizza alla pagina di login
if(!isset($_SESSION['user'])) {
    header('Location: login.php');
}

// Imposta il percorso radice del sito
$rootPath = '../';

// Includi il file di configurazione del database e le operazioni del carrello
include '../include/db_inc.php';
include '../include/operazioni_cart.php';

// Se l'utente ha effettuato l'accesso ma non ha ancora un'immagine del profilo nella sessione, recupera l'immagine dal database
if(!isset($_SESSION['pic']) && isset($_SESSION['user'])) {
    if (isset($db)) {
        $pfpq = $db->query('select pfp from utente where id_utente = ' . $_SESSION['user']);
        $pfp = $pfpq->fetch()['pfp'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TikeTwo - Carrello</title>
    <!-- Includi i fogli di stile -->
    <link rel="stylesheet" href="../Styles/header-footer.css">
    <link rel="stylesheet" href="../Styles/cart.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="../Images/ticketwoW.png" rel="icon" type="image/png">
    <!-- Includi lo script per il contatore dei biglietti -->
    <script src="../Scripts/counter.js" defer></script>
    <script src="../Scripts/search.js" defer></script>
</head>

<body>
<?php include '../include/header.php'; ?>

<div class="carrello">
    <!-- Titolo della pagina -->
    <h1>Carrello</h1>
    <!-- Linea divisoria -->
    <hr>
    <div class="cart">
        <!-- Visualizza il contenuto del carrello -->
        <?php displayCart() ?>
        <!-- Visualizza il totale del carrello -->
        <?php total() ?>
    </div>
</div>

<?php include '../include/footer.php'; ?>
</body>
</html>
