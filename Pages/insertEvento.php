<?php
$rootPath = '../';
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
    <input type="file" name="locandina" id="locandina"><br>
    <br>
    <br>
    <label for="p1" id="titolo">Titolo:
    <input type="text" name="titolo" id="p1">
    </label>
    <label for="textarea" id="desc"> Descrizione:
    <textarea name="desc">
    </textarea>
    </label>
</form>
</body>
<?php include $rootPath . 'include/footer.php' ?>
</html>
