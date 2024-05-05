<?php
session_start();
$rootPath = '../';

$emailR = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
$passwordR = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
$vError = '';

if(isset($_POST['username'], $_POST['email'], $_POST['pw'], $_POST['cpw']) && ($_POST['username'] !== '' || $_POST['email'] !== '' || $_POST['pw'] !== '' || $_POST['cpw'] !== '')){
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['pw'];
    $cPass = $_POST['cpw'];

    include '../include/db_inc.php';

    if (isset($db)) {
        $emailsQ = $db->query('select * from utente where mail = "' . $email . '"');
    }
    $emails = $emailsQ->fetch();
    $usersQ = $db->query('select * from utente where username = "' . $user . '"');
    $users = $usersQ->fetch();

    if(preg_match($emailR, $email)){
        if(!isset($emails['mail'])) {
            if(!isset($users['username'])) {
                if (preg_match($passwordR, $pass)) {
                    if ($pass === $cPass) {
                        $qp = $db->prepare('insert into utente(username, password, tipo, mail) values(:u, :p, 0, :e)');
                        $qp->execute(['u' => $user, 'p' => base64_encode($pass), 'e' => $email]);

                        $uIdQ = $db->query('select * from utente where username = "' . $user . '"');
                        $uId = $uIdQ->fetch();

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
        <title>TikeTwo</title>
        <link rel="stylesheet" href="<?= $rootPath ?>Styles/signup.css">
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
                <label for="p1">Username: </label>
                <input type="text" id="p1" name="username" placeholder="Username"><br>
                <label for="p2">Email: </label>
                <input type="email" id="p2" name="email" placeholder="Email"><br>
                <label for="p3">Password: </label>
                <input type="password" name="pw" id="p3" placeholder="Password"><br>
                <label for="p4">Conferma Password: </label>
                <input type="password" name="cpw" id="p4" placeholder="Password"><br>
                <button type="submit">Submit</button>
                <p class="vError"><?= $vError ?></p>
            </form>
            <a href="login.php">Accedi...</a>
        </div>


        <?php include '../include/footer.php'; ?>
    </body>
</html>
