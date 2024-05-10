<?php
// Avvia la sessione
session_start();

// Cancella le variabili di sessione
unset($_SESSION['user']);
unset($_SESSION['pic']);

// Imposta il percorso radice del sito
$rootPath = '../';

// Espressioni regolari per la validazione dell'email e della password
$emailR = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
$passwordR = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
$vError = '';

// Gestione del modulo di registrazione
if(isset($_POST['username'], $_POST['email'], $_POST['pw'], $_POST['cpw']) && ($_POST['username'] !== '' || $_POST['email'] !== '' || $_POST['pw'] !== '' || $_POST['cpw'] !== '')){
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['pw'];
    $cPass = $_POST['cpw'];

    // Includi il file di configurazione del database
    include '../include/db_inc.php';

    // Verifica se l'email è già presente nel database
    if(isset($db)) {
        $emailsQ = $db->prepare('select * from utente where mail = :e');
        $emails = $emailsQ->execute(['e' => $email]);
        $emails = $emailsQ->fetch();
    }
    // Verifica se l'username è già presente nel database
    $usersQ = $db->prepare('select * from utente where username = :u');
    $users = $usersQ->execute(['u' => $user]);
    $users = $usersQ->fetch();

    // Controlla se l'email è valida
    if(preg_match($emailR, $email)){
        // Controlla se l'email non è già in uso
        if(!isset($emails['mail'])) {
            // Controlla se l'username non è già in uso
            if(!isset($users['username'])) {
                // Controlla se la password è valida
                if (preg_match($passwordR, $pass)) {
                    // Controlla se le password coincidono
                    if ($pass === $cPass) {
                        // Esegui l'inserimento dell'utente nel database
                        $qp = $db->prepare('insert into utente(username, password, tipo, mail, pfp) values(:u, :p, 0, :e, "0.png")');
                        $qp->execute(['u' => $user, 'p' => password_hash($pass, PASSWORD_DEFAULT), 'e' => $email]);

                        // Ottieni l'ID dell'utente appena registrato
                        $uIdQ = $db->prepare('select * from utente where username = :u');
                        $uId = $uIdQ->execute(['u' => $user]);
                        $uId = $uIdQ->fetch();

                        // Imposta l'ID dell'utente nella sessione e reindirizza alla homepage
                        $_SESSION['user'] = $uId['id_utente'];
                        header('Location:../index.php');
                    } else {
                        $vError = 'Password non combaciano';
                    }
                } else {
                    $vError = 'Password invalida';
                }
            } else {
                $vError = 'Username già in uso';
            }
        } else {
            $vError = 'Email già in uso';
        }
    } else {
        $vError = 'Email invalida';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TickeTwo - Signup</title>
    <link rel="stylesheet" href="../Styles/signup.css">
    <link rel="stylesheet" href="../Styles/header-footer.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="../Images/ticketwoW.png" rel="icon" type="image/png">
    <script src="../Scripts/search.js" defer></script>
</head>

<body>
<?php include '../include/header.php'; ?>

<div id="chest">
    <!-- Form per la registrazione -->
    <form method="post" class="signup">
        <label for="p1">Username: </label>
        <input type="text" id="p1" name="username" placeholder="Username"><br>
        <label for="p2">Email: </label>
        <input type="email" id="p2" name="email" placeholder="Email"><br>
        <label for="p3">Password: </label>
        <input type="password" name="pw" id="p3" placeholder="Password"><br>
        <label for="p4">Conferma Password: </label>
        <input type="password" name="cpw" id="p4" placeholder="Password"><br>
        <button type="submit">Submit</button>
        <!-- Visualizza gli eventuali errori di validazione -->
        <p class="vError"><?= $vError ?></p>
    </form>
    <!-- Link per accedere alla pagina di login -->
    <a href="login.php">Accedi...</a>
</div>

<?php include '../include/footer.php'; ?>
</body>
</html>
