<?php
session_start();

// Aggiunge un elemento al carrello
function addToCart($item) {
    $_SESSION['cart'][] = $item;
}

// Rimuove un elemento dal carrello
function removeFromCart($index) {
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Riordina gli indici
    }
}

// Visualizza il carrello
function displayCart() {
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        echo "<ul>";
        foreach ($_SESSION['cart'] as $index => $item) {
            echo "<li>$item <a href='remove_from_cart.php?index=$index'>Rimuovi</a></li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Il carrello è vuoto.</p>";
    }
}

addToCart("Biglietto 1");
addToCart("Nigger");
addToCart("Ultranigger");


?>

