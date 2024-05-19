<?php

include '../include/db_inc.php';

if(isset($db)) {
    $in = $db->prepare('select * from carrello c where id_utente = ' . $_GET['user'] . ' and id_biglietto = ' . $_GET['biglietto']);
    $inCart = $in->execute();
    $inCart = $in->fetch();
}
if(!isset($inCart['id_utente'])) {
    $add = $db->prepare('insert into carrello(id_biglietto, id_utente, quantita) values(:b, :u, :c)');
    $add->execute(['b' => $_GET['biglietto'], 'u' => $_GET['user'], 'c' => $_GET['c']]);


    echo json_encode(1);
} else {
    $add = $db->prepare('update carrello set quantita = :q where id_utente = :u and id_biglietto = :b');
    $add->execute(['q' => ($inCart['quantita'] + $_GET['c']), 'u' => $_GET['user'], 'b' => $_GET['biglietto']]);


    echo json_encode(1);
}