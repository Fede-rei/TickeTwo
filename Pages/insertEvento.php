<?php
session_start();

// Imposta il percorso radice del sito
$rootPath = '../';

// Controlla se l'utente è loggato e ha il tipo corretto
if (!isset($_SESSION['user']) || !isset($_SESSION['tipo']) || $_SESSION['tipo'] != 1) {
    // Se l'utente non è loggato o non ha il tipo corretto, reindirizza alla pagina di login
    header('Location: ' . $rootPath . 'login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>TickeTwo - Aggiungi evento</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../Styles/insertEvento.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="<?= $rootPath ?>Images/ticketwoW.png" rel="icon" type="image/png">
    <link rel="stylesheet" href="../Styles/header-footer.css">
    <script src="../Scripts/search.js" defer></script>
</head>
<?php include $rootPath . 'include/header.php' ?>
<body>
<form id="container">
    <div id="locandina">
        <div>
            <label for="bF">Locandina evento: </label> <br><br>
            <label id="bF">
                Seleziona il file
                <input type="file" accept="image/jpeg, image/png, image/jpg, image/gif" name="pic" id="pic" title="Inserisci un' immagine">
            </label>
        </div>
    </div><br>
    <br>
    <br>
    <label for="p1" id="titolo">Titolo:
        <input type="text" name="titolo" id="p1" class="li"> <br> <br>
        <button type="button" id="submit" class="butt">Aggiungi</button>
    </label>
    <label for="p2" id="luogo">Luogo:
        <input type="text" id="p2" class="li">
    </label>
    <div id="date">
        <label for="p3">Data Inizio:
            <input type="date" id="p3" class="li">
        </label>
        <label for="p4">Data Fine:
            <input type="date" id="p4" class="li">
        </label>
    </div>
    <label for="textarea" id="desc"> Descrizione:
        <textarea name="desc" maxlength="500"></textarea>
    </label>

</form>
</body>
<?php include $rootPath . 'include/footer.php' ?>
</html>
