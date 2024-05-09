<?php

include '../include/db_inc.php';

if(isset($db)) {
    $in = $db->prepare('select * from acquisti where id_ticket = :t and id_cliente = :u');
    $i = $in->execute(['t' => $_GET['bigletto'], 'u' => $_GET['user']]);
    $i = $in->fetch();
}

if(isset($i['id_cliente'])) {
    $in = $db->prepare('update acquisti set q = :q where id_cliente = :u and id_ticket = :t');
    $i = $in->execute(['q' => ($_GET['c'] + $i['q']), 'u' => $_GET['user'], 't' => $_GET['bigletto']]);

    echo json_encode(1);
} else {
    $in = $db->prepare('insert into acquisti(q, id_cliente, id_ticket) values(:q, :u, :t)');
    $i = $in->execute(['q' => ($_GET['c'] + $i['q']), 'u' => $_GET['user'], 't' => $_GET['bigletto']]);
    $in = $db->prepare('delete from carrello where id_biglietto = :b and id_utente = :u');
    $i = $in->execute(['b' => $_GET['bigletto'], 'u' => $_GET['user']]);

    echo json_encode(1);
}
