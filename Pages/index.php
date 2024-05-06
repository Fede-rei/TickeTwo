<?php
$rootPath = '../'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TikeTwo</title>
    <link rel="stylesheet" href="<?= $rootPath ?>Styles/style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="<?= $rootPath ?>Images/ticketwoW.png" rel="icon" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .carousel-inner img {
            width: 100%;
            height: 100%;
        }

        .carousel-slide{
            height: 500px;
            width 250px;
        }

        .item{
            height: 100vw;
            width 50vw;
        }

        .end-page{
            width: 100%;
            height 200px;
            background-color: crimson;
        }
    </style>
</head>

<body>
<?php include 'header.php'; ?>


<?php include '../include/footer.php'; ?>
</body>
</html>