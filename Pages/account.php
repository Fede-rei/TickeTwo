<?php
session_start();
$rootPath = '../';

unset($_SESSION['eventId']);

if(!isset($_SESSION['user'])){
    header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>TickeTwo - Account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../Styles/account.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="<?= $rootPath ?>Images/ticketwoW.png" rel="icon" type="image/png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../Styles/header-footer.css">
</head>
<body>
<?php include '../include/header.php'?>
<div id="container">
    <div id="pfp">
        <img src="../Images/blu.jpg" id="accImg">
    </div>
    <div id="data">

    </div>
</div>
<?php include '../include/footer.php'?>
</body>
</html>
