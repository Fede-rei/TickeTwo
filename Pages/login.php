<?php
session_start();

unset($_SESSION['user']);
unset($_SESSION['eventId']);


$rootPath = '../';

$vError = '';

include '../include/db_inc.php';

if(isset($_POST['ue'], $_POST['pw']) && $_POST['ue'] !== '' && $_POST['pw'] !== '') {
    $ue = $_POST['ue'];
    $pass = base64_encode($_POST['pw']);

    if(isset($db)){
        $userQ = $db->query('select * from utente where (username = "' . $ue . '" or mail = "' . $ue . '") and password = "' . $pass . '"');
        $user = $userQ->fetch();
    }

    if(isset($user['id_utente'])) {
        $_SESSION['user'] = $user['id_utente'];

        header('Location: ..');
    } else {
        $vError = 'Credenziali incorrette';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>TikeTwo</title>
        <link rel="stylesheet" href="<?= $rootPath ?>Styles/login.css">
        <link rel="stylesheet" href="<?= $rootPath ?>Styles/header-footer.css">
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <link href="<?= $rootPath ?>Images/ticketwoW.png" rel="icon" type="image/png">
    </head>

    <body>
        <?php include '../include/header.php'; ?>

        <div id="chest">
            <form method="post">
                <label for="p1">Username/Email: </label>
                <input type="text" id="p1" name="ue" placeholder="Username/Email"><br>
                <label for="p2">Password: </label>
                <input type="password" name="pw" id="p2" placeholder="Password"><br>
                <button type="submit">Submit</button>
                <p class="vError"><?= $vError ?></p>
            </form>
            <a href="signup.php">Registrati...</a>
        </div>

        <?php include '../include/footer.php'; ?>
    </body>
</html>
