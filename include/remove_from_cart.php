<?php

if (isset($_GET['index'])) {
    $index = $_GET['index'];
    unset($_SESSION['cart'][$index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Riordina gli indici
}

header("Location: cart.php"); // Reindirizza alla pagina del carrello
exit();
?>
