<?php

include '../include/db_inc.php';

$idCarr = explode(',', $_GET['carrello']);

foreach ($idCarr as $item) {
    if (isset($db)) {
        $in = $db->prepare('select * from acquisti a inner join carrello c on a.id_cliente = c.id_utente where id_carrello = :c and id_utente = :u and id_biglietto = id_ticket');
        $i = $in->execute(['c' => $item, 'u' => $_GET['user']]);
        $i = $in->fetch();
    }

    if (isset($i['id_acquisto'])) {
        $update = $db->prepare('update acquisti set q = :q where id_cliente = :u and id_ticket = :t');
        $update->execute(['q' => ($i['quantita'] + $i['q']), 'u' => $_GET['user'], 't' => $i['id_biglietto']]);
        $delete = $db->prepare('delete from carrello where id_biglietto = :b and id_utente = :u');
        $delete->execute(['b' => $i['id_biglietto'], 'u' => $_GET['user']]);
    } else {
        $idBq = $db->prepare('select * from carrello where id_carrello = :c');
        $idB = $idBq->execute(['c' => $item]);
        $idB = $idBq->fetch();

        $insert = $db->prepare('insert into acquisti(q, id_cliente, id_ticket) values(:q, :u, :t)');
        $insert->execute(['q' => ($idB['quantita']), 'u' => $_GET['user'], 't' => $idB['id_biglietto']]);
        $delete = $db->prepare('delete from carrello where id_biglietto = :b and id_utente = :u');
        $delete->execute(['b' => $idB['id_biglietto'], 'u' => $_GET['user']]);
    }
}
echo json_encode(1);