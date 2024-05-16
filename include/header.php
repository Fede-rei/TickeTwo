<?php
include "$rootPath/include/db_inc.php";
// Se l'utente ha effettuato l'accesso ma non ha ancora un'immagine del profilo nella sessione, recupera l'immagine dal database
if(!isset($_SESSION['pic']) && isset($_SESSION['user'])) {
    if (isset($db)) {
        $pfpq = $db->prepare('select pfp from utente where id_utente = :u');
        $_SESSION['pic'] = $pfpq->execute(['u' => $_SESSION['user']]);
        $_SESSION['pic'] = $pfpq->fetch()['pfp'];
    }
}
elseif(!isset($_SESSION['user']))
    $_SESSION['pic'] = "0.png";
?>

<header>
    <!-- Link all'homepage del sito -->
    <a href="<?= $rootPath ?>" id="ticketImg">
        <!-- Immagine del logo del sito -->
        <img src="<?= $rootPath ?>Images/ticketwo.png" class="tI">
    </a>
    <!-- Barra di ricerca -->
    <div class="searchBar">
        <form method="get" action="<?= $rootPath ?>Pages/search_Results.php" class="cerca">
            <input id="searchQueryInput" type="text" name="searchQueryInput" placeholder="Search" value=""/>
            <button type="submit" id="searchQuerySubmit">
                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                    <path fill="#666666" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z"/>
                </svg>
            </button>
        </form>


    </div>
    <!-- Menu di navigazione -->
    <div id="menu">
        <!-- Link al carrello o alla pagina di login a seconda dello stato dell'utente -->
        <a href="<?php

        if (isset($_SESSION['user'])) {
            echo $rootPath . "Pages/cart.php";
        } else {
            echo $rootPath . "Pages/login.php";
        }

        ?>">
            <!-- Icona del carrello -->
            <span class="material-symbols-outlined">
                shopping_cart
            </span>
        </a>
        <!-- Icona dell'utente -->
        <div class='uIcon'>
            <?php if (isset($_SESSION['user'])) { ?>
                <!-- Link al profilo utente -->
                <a href="<?= $rootPath ?>Pages/account.php">
                    <!-- Immagine del profilo utente -->
                    <img class='user' value="<?= $rootPath ?>" src='<?= $rootPath ?>pfp/<?= $_SESSION['pic'] ?>'>
                </a>
            <?php } else { ?>
                <!-- Link alla pagina di login -->
                <a href="<?= $rootPath ?>Pages/login.php">
                    <!-- Immagine del profilo utente -->
                    <img class='user' value="<?= $rootPath ?>" src='<?= $rootPath ?>pfp/<?= $_SESSION['pic'] ?>'>
                </a>
            <?php } ?>
        </div>
    </div>
</header>

<!--
<input id="searchQueryInput" type="text" name="searchQueryInput" placeholder="Search" value=""/>

<button id="searchQuerySubmit" type="submit" name="searchQuerySubmit">
    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
        <path fill="#666666"
              d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z"/>
    </svg>
</button>-->


