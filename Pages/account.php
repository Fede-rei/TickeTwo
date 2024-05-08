<?php
session_start();
include '../include/db_inc.php';
$rootPath = '../';

unset($_SESSION['eventId']);

if (!isset($_SESSION['user'])) {
    header('Location:login.php');
}
if (isset($db)) {
    $q = $db->query('SELECT * FROM utente WHERE id_utente=' . $_SESSION['user']);
    $info = $q->fetch();
    $_SESSION['pic'] = $info['pfp'];
}


if(isset($_FILES['pic']) && $_FILES['pic'] != NULL && $_FILES["pic"]["error"] == 0){
    $originalFileName = explode(".", $_FILES['pic']['name']);
    $imagename = $_SESSION['user'] . '.' . $originalFileName[count($originalFileName) - 1];
    //Stores the filetype e.g image/jpeg
    $imagetype = $_FILES['pic']['type'];
    //Stores any error codes from the upload.
    $imageerror = $_FILES['pic']['error'];
    //Stores the tempname as it is given by the host when uploaded.
    $imagetemp = $_FILES['pic']['tmp_name'];

    //The path you wish to upload the image to
    $imagePath = $rootPath . 'pfp/';

    if(is_uploaded_file($imagetemp)) {
        if(move_uploaded_file($imagetemp, $imagePath . $imagename)) {
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
</head>
<body>
<?php include '../include/header.php' ?>


<div id="container">
    <div id="pfp">
        <img src="../pfp/<?= $_SESSION['pic'] ?>" id="accImg">
    </div>
    <div id="data">
        <label for="p1">Username: </label>
        <h3 id="p1"><?= $info['username'] ?></h3>
        <label for="p2">Mail:</label>
        <h3 id="p2"> <?= $info['mail'] ?></h3>
    </div>
    <div id="new">
        Modifica Profilo<br>
        <form method='post' enctype="multipart/form-data">
            <label for="pic">Foto profilo: </label>
            <input type="file" accept="image/jpeg image/png image/jpg image/gif" name="pic" id="pic" title="Inserisci un' immagine"><br>
            <label for="p1">Username: </label>
            <input type="text" id="p1" name="us"> <br>
            <label for="p2">Mail:</label>
            <input type="text" id="p2" name="pa"> <br>
            <input type="submit">
        </form>
    </div>
</div>
<?php include '../include/footer.php' ?>
</body>
</html>
