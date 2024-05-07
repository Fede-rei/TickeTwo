<?php


// Rimuove un elemento dal carrello
function removeFromCart($index) {
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Riordina gli indici
    }
}

// Visualizza il carrello
function displayCart() {
    include '../include/db_inc.php';
    if (isset($db)) {
        $carrelloUq = $db->query("select * from carrello c inner join biglietto b on c.id_biglietto = b.id_biglietto inner join evento e on b.id_event = e.id_evento where id_utente = " . $_SESSION['user']);
        $carrelloU = $carrelloUq->fetchAll();

        ?> <div class="items"> <?php
        if (count($carrelloU) > 0) {
            foreach ($carrelloU as $bE) { ?>
                <div class="cartItem">
                    <h1 class="itemName"><?= $bE['nome'] ?> <?= $bE['prezzo'] ?>€</h1>

                    <div class="qD">
                        <p class="itemQ">
                            <label for="<?= $bE['id_carrello'] ?>">Quantità:</label>
                            <input class='q' id='<?= $bE['id_carrello'] ?>' value="<?= $bE['quantità'] ?>" min="1">
                        </p>

                        <span class="material-symbols-outlined">
                            delete
                        </span>
                    </div>
                </div>
            <?php }
        } else { ?>
            <p>Il carrello è vuoto.</p>
        <?php }
        ?> </div> <?php
    }
}

function total() {
    include '../include/db_inc.php';
    if (isset($db)) {
        $carrelloUq = $db->query("select * from carrello c inner join biglietto b on c.id_biglietto = b.id_biglietto inner join evento e on b.id_event = e.id_evento where id_utente = " . $_SESSION['user']);
        $carrelloU = $carrelloUq->fetchAll();
        $t = 0;
            if (count($carrelloU) > 0) {
                foreach ($carrelloU as $bE) {
                    $t += $bE['prezzo'] * $bE['quantità'];
                }
            }
        ?>
        <div class="total">
            <h1>Totale: <?= $t ?>€</h1>
        </div>
        <?php
    }
}