<?php
session_start();

$rootPath = '../';
?>
<!doctype html>
<html lang="en">
<head>
    <title>TickeTwo - Risultato Eventi</title>
    <!-- Metadati -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Collegamenti ai fogli di stile -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="../Images/ticketwoW.png" rel="icon" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Collegamenti agli script JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Collegamenti ai fogli di stile personalizzati -->
    <link rel="stylesheet" href="../Styles/header-footer.css">
    <link rel="stylesheet" href="../Styles/index.css">
    <!--<script src="Scripts/search.js" defer ></script>-->

    <link rel="stylesheet" href="../Styles/swiperStyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.4/swiper-bundle.min.css">


    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.4/swiper-bundle.min.js"></script>
    <script src="../Scripts/swiper.js" defer></script>

    <link rel="stylesheet" href="../Styles/search_results.css">
</head>
<body>

    <?php
    include '../include/header.php';
    ?>

    <?php
    $type = 'mysql';
    $server = 'localhost';
    $dbn = 'ticketwo';
    $port = '3306';
    $charset = 'utf8mb4';
    $username = 'root';
    $password = '';

    $options = [
        PDO::ATTR_ERRMODE               =>  PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE    =>  PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES      =>  false,
    ];

    $dsn = "$type:host=$server;dbname=$dbn;port=$port;charset=$charset";

    try{
        $db = new PDO($dsn, $username, $password, $options);

        $sql = "SELECT * FROM Evento WHERE nome LIKE CONCAT(:valore, '%')";

        $stmt = $db->prepare($sql);

        $stmt->bindParam(":valore", $_GET["searchQueryInput"]);
        $stmt->execute();

        $risultati = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($risultati as $riga) {
            echo "<section class='sr_card'>";
                echo "<div class='sr_card_content'>";
                    // Aggiungi l'immagine qui con il link fornito nel campo "image"
                    echo "<div class='img_sr_card'>";
                        echo "<img src='" . $riga["image"] . "' alt='Immagine evento'>";
                    echo "</div>";

                    echo "<div class='text_sr_card'>";
                        // Stampa il resto delle informazioni dell'evento
                        echo "<h2>" . $riga["nome"] . "</h2>";
                        echo "<p>" . $riga["descrizione"] . "</p>";
                        echo "<p>Data: " . $riga["data"] . "</p>";
                        echo "<p>Luogo: " . $riga["luogo"] . "</p>";
                        echo "<p>Posti disponibili: " . $riga["posti"] . "</p>";

                        //form per reindirizzare alla pagina dell'evento cliccando sul bottone..
                        echo "<form>";
                            echo "<input class='button' type='submit' value='Vai'>";
                        echo "</form>";
                    echo "</div>";
                echo "</div>";
            echo "</section>";
        }


    }
    catch(PDOException $e){
        throw new PDOException($e->getMessage(), $e->getCode());
    }

    ?>

    <section class="sr_card">
        <div class="sr_card_content">
            <div class="img_sr_card"></div>
            <div class="text_sr_card"></div>
        </div>
    </section>


    <?php
    include '../include/footer.php';
    ?>



</body>
</html>