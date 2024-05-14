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
            if(isset($db)) {
                $updateImg = $db->prepare('UPDATE utente SET pfp = :i WHERE id_utente = :u');
                $updateImg->execute(['i' => $imagename, 'u' => $_SESSION['user']]);
                $_SESSION['pic'] = $imagename;
            }
        }
    }
}

$vError = '';
if(isset($_POST['us']) && $_POST['us'] !== '') {
    $usersQ = $db->prepare('select * from utente where username = :u');
    $users = $usersQ->execute(['u' => $_POST['us']]);
    $users = $usersQ->fetch();

    if(!isset($users['username'])) {
        $updateImg = $db->prepare('UPDATE utente SET username = :u WHERE id_utente = :ui');
        $updateImg->execute(['u' => $_POST['us'], 'ui' => $_SESSION['user']]);
    } else {
        if($users['id_utente'] !== $_SESSION['user'])
            $vError .= 'Username già in uso';
    }
}


$emailR = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
if(isset($_POST['ma']) && $_POST['ma'] !== '') {
    $emailsQ = $db->prepare('select * from utente where mail = :e');
    $emails = $emailsQ->execute(['e' => $_POST['ma']]);
    $emails = $emailsQ->fetch();

    if (!isset($emails['mail'])) {
        if (preg_match($emailR, $_POST['ma'])) {
            $updateMail = $db->prepare('UPDATE utente SET mail = :m WHERE id_utente = :u');
            $updateMail->execute(['m' => $_POST['ma'], 'u' => $_SESSION['user']]);
        } else {
            $vError .= '<br>Email invalida';
        }
    }
    else {
        if($emails['id_utente'] !== $_SESSION['user'])
            $vError .= '<br>Email già in uso';
    }
}


$q = $db->prepare('SELECT * FROM utente WHERE id_utente = :u');
$info = $q->execute(['u' => $_SESSION['user']]);
$info = $q->fetch();
$_SESSION['pic'] = $info['pfp'];
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
        <form action="logout.php">
            <button type="submit" class="accB">Logout</button>
        </form>
    </div>
    <!-- Form per la modifica del profilo -->
    <fieldset id="new">
        <legend>Modifica Profilo</legend>
        <form method='post' enctype="multipart/form-data">
            <div>
            <label for="bF">Foto profilo: </label>
            <label id="bF">
                Seleziona il file
                <input type="file" accept="image/jpeg image/png image/jpg image/gif" name="pic" id="pic" title="Inserisci un' immagine">
            </label>
            </div><br>
            <label for="p1">Username: </label>
            <input class="li" type="text" id="p1" name="us" placeholder="<?= $info['username'] ?>"><br>
            <label for="p2">Mail:</label>
            <input class="li" type="text" id="p2" name="ma" placeholder="<?= $info['mail'] ?>"> <br>
            <button type="submit" class="accB">Invia</button>
            <p class="errorM"><?= $vError ?></p>
        </form>
    </fieldset>
</div>
<?php include '../include/footer.php' ?>
</body>
</html>
