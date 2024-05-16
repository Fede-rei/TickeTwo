<?php
// Avvia la sessione
session_start();

// Cancella le variabili di sessione
unset($_SESSION['user']);
unset($_SESSION['pic']);
unset($_SESSION['tipo']); // Also clear the 'tipo' session variable

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
        $userQ = $db->prepare('SELECT * FROM utente WHERE (username = :u OR mail = :e)');
        $userQ->execute(['u' => $ue, 'e' => $ue]);
        $user = $userQ->fetch(PDO::FETCH_ASSOC); // Use FETCH_ASSOC to get an associative array
    }

    if($user && password_verify($pass, $user['password'])) {
        // Se l'utente è stato trovato, imposta la sessione e reindirizza alla homepage
        if (isset($user['id_utente'])) {
            $_SESSION['user'] = $user['id_utente'];
            $_SESSION['tipo'] = $user['tipo']; // Store 'tipo' in session
            header('Location: ..');
        } else {
            // Altrimenti, mostra un messaggio di errore
            $vError = 'Credenziali incorrette';
        }
    } else {
        $vError = 'Credenziali incorrette'; // Show error if password verification fails
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TickeTwo - LogIn</title>
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
    <fieldset class="login">
        <legend>LogIn</legend>
        <form method="post">
            <label for="p1">Username/Email: </label>
            <input class="li" type="text" id="p1" name="ue" placeholder="Username/Email"><br>
            <label for="p2">Password: </label>
            <input class="li" type="password" name="pw" id="p2" placeholder="Password"><br>
            <button type="submit">Submit</button>
            <!-- Visualizza gli eventuali errori di login -->
            <p class="vError"><?= $vError ?></p>
        </form>
    </fieldset>
    <!-- Link per accedere alla pagina di registrazione -->
    <a href="signup.php">Registrati...</a>
</div>

<?php include '../include/footer.php'; ?>
</body>
</html>
