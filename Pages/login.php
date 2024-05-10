<?php
// Avvia la sessione
session_start();

// Cancella le variabili di sessione
unset($_SESSION['user']);
unset($_SESSION['pic']);

// Imposta il percorso radice del sito
$rootPath = '../';

$vError = '';

// Includi il file di configurazione del database
include '../include/db_inc.php';

// Gestione del login
if(isset($_POST['ue'], $_POST['pw']) && $_POST['ue'] !== '' && $_POST['pw'] !== '') {
    $ue = $_POST['ue'];
    $pass = $_POST['pw'];

    // Verifica se il database è stato inizializzato correttamente
    if(isset($db)){
        // Esegui la query per trovare l'utente con l'username o l'email corrispondenti e la password corretta
        $userQ = $db->prepare('select * from utente where (username = :u or mail = :e) and password = :p');
        $user = $userQ->execute(['u' => $ue, 'e' => $ue]);
        $user = $userQ->fetch();
    }

    if(password_verify($user['password'], $pass)) {
        // Se l'utente è stato trovato, imposta la sessione e reindirizza alla homepage
        if (isset($user['id_utente'])) {
            $_SESSION['user'] = $user['id_utente'];
            header('Location: ..');
        } else {
            // Altrimenti, mostra un messaggio di errore
            $vError = 'Credenziali incorrette';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TickeTwo - Login</title>
    <!-- Includi i fogli di stile -->
    <link rel="stylesheet" href="../Styles/login.css">
    <link rel="stylesheet" href="../Styles/header-footer.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="../Images/ticketwoW.png" rel="icon" type="image/png">
    <script src="../Scripts/search.js" defer></script>
</head>

<body>
<?php include '../include/header.php'; ?>

<div id="chest">
    <!-- Form per il login -->
    <form method="post" class="login">
        <label for="p1">Username/Email: </label>
        <input type="text" id="p1" name="ue" placeholder="Username/Email"><br>
        <label for="p2">Password: </label>
        <input type="password" name="pw" id="p2" placeholder="Password"><br>
        <button type="submit">Submit</button>
        <!-- Visualizza gli eventuali errori di login -->
        <p class="vError"><?= $vError ?></p>
    </form>
    <!-- Link per accedere alla pagina di registrazione -->
    <a href="signup.php">Registrati...</a>
</div>

<?php include '../include/footer.php'; ?>
</body>
</html>
