<?php
session_start();

unset($_SESSION['eventId']);


$rootPath = './';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>TikeTwo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="<?= $rootPath ?>Images/ticketwoW.png" rel="icon" type="image/png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="Styles/header-footer.css">
    <style>
        .carousel-inner img {
            width: 100%;
            height: 100%;
        }

        .carousel-slide{
            height: 500px;
            width 250px;
        }

        .item-active{
            height: 600px;
            width 50px;
        }

        .img-carousel{
            height: 600px;
            width 50px;
        }
    </style>
</head>

    <body>
        <?php include 'include/header.php'; ?>

        <div>
            <div id="myCarousel" class="carousel-slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item-active">
                        <img src="Images/0.png" class="img-carousel">
                    </div>

                    <div class="item">
                        <img src="Images/ticketwoN.png" class="img-carousel">
                    </div>

                    <div class="item">
                        <img src=Images/ticketwoN1.png" class="img-carousel">
                    </div>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
<?php include 'include/footer.php'; ?>
</body>
</html>