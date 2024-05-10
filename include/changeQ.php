<?php

include '../include/db_inc.php';

if(isset($db)) {
    $in = $db->prepare('update carrello set quantita = :q where id_carrello = :c');
    $in->execute(['q' => $_GET['c'], 'c' => $_GET['carrello']]);

    echo json_encode(1);
}