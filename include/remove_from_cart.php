<?php

include '../include/db_inc.php';

if(isset($db)) {
    $in = $db->prepare('delete from carrello where id_carrello = :id');
    $in->execute(['id' => $_GET['carrello']]);

    echo json_encode(1);
}