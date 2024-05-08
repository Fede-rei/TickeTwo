<?php
// Avvia la sessione per gestire le informazioni di sessione dell'utente
session_start();

// Includi il file di configurazione del database
include '../include/db_inc.php';

// Imposta il percorso radice del sito
$rootPath = '../';


// Verifica se l'utente è autenticato, altrimenti reindirizzalo alla pagina di login
if (!isset($_SESSION['user'])) {
    header('Location:login.php');
}

// Recupera le informazioni dell'utente dal database
if (isset($db)) {
    $q = $db->query('SELECT * FROM utente WHERE id_utente=' . $_SESSION['user']);
    $info = $q->fetch();
    $_SESSION['pic'] = $info['pfp'];
}

// Gestisci l'upload dell'immagine del profilo se è stata inviata tramite il modulo di caricamento
if(isset($_FILES['pic']) && $_FILES['pic'] != NULL && $_FILES["pic"]["error"] == 0){
    // Ottieni il nome del file immagine originale
    $originalFileName = explode(".", $_FILES['pic']['name']);
    $imagename = $_SESSION['user'] . '.' . $originalFileName[count($originalFileName) - 1];

    // Memorizza il percorso dell'immagine precedente
    $previousImagePath = $rootPath . 'pfp/' . $_SESSION['pic'];

    // Controlla se esiste un'immagine precedente e rimuovila
    if(file_exists($previousImagePath)&&$_SESSION['pic']!="0.png") {
        unlink($previousImagePath);
    }

    // Ottieni il tipo, l'errore e il percorso temporaneo dell'immagine caricata
    $imagetype = $_FILES['pic']['type'];
    $imageerror = $_FILES['pic']['error'];
    $imagetemp = $_FILES['pic']['tmp_name'];

    // Percorso in cui si desidera caricare l'immagine
    $imagePath = $rootPath . 'pfp/';

    // Sposta l'immagine caricata nella directory desiderata
    if(is_uploaded_file($imagetemp)) {
        if(move_uploaded_file($imagetemp, $imagePath . $imagename)) {
            // Aggiorna il percorso dell'immagine nel database
            $db->query('UPDATE utente SET pfp = "' . $imagename . '" WHERE id_utente = "' . $_SESSION['user'] . '";');
            $_SESSION['pic'] = $imagename;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>TickeTwo - Account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../Styles/account.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="<?= $rootPath ?>Images/ticketwoW.png" rel="icon" type="image/png">
    <link rel="stylesheet" href="../Styles/header-footer.css">
    <script src="../Scripts/search.js" defer></script>
</head>
<body>
<?php include '../include/header.php' ?>


<div id="container">
    <div id="pfp">
        <!-- Visualizza l'immagine del profilo dell'utente -->
        <img src="../pfp/<?= $_SESSION['pic'] ?>" id="accImg">
    </div>
    <div id="data">
        <!-- Visualizza le informazioni dell'utente -->
        <label for="p1">Username: </label>
        <h3 id="p1"><?= $info['username'] ?></h3>
        <label for="p2">Mail:</label>
        <h3 id="p2"> <?= $info['mail'] ?></h3>
    </div>
    <div id="new">
        <!-- Form per la modifica del profilo -->
        Modifica Profilo<br>
        <form method='post' enctype="multipart/form-data">
            <label for="pic">Foto profilo: </label>
            <input type="file" accept="image/jpeg image/png image/jpg image/gif" name="pic" id="pic" title="Inserisci un' immagine"><br>
            <label for="p1">Username: </label>
            <input type="text" id="p1" name="us"> <br>
            <label for="p2">Mail:</label>
            <input type="text" id="p2" name="pa"> <br>
            <button type="submit">Invia</button>
        </form>
    </div>
</div>
<?php include '../include/footer.php' ?>
</body>
</html>
