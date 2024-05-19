<?php

include '../include/db_inc.php';

if(isset($db)) {
    $selq = $db->prepare('select * from carrello c inner join biglietto b on c.id_biglietto = b.id_Biglietto inner join evento e on b.id_event = e.id_evento where id_carrello = :c');
    $sel = $selq->execute(['c' => $_GET['carrello']]);
    $sel = $selq->fetch();

}

if($_GET['c'] > $sel['posti']) {
    $q = $sel['posti'];
} else {
    $q = $_GET['c'];
}

$in = $db->prepare('update carrello set quantita = :q where id_carrello = :c');
$in->execute(['q' => $q, 'c' => $_GET['carrello']]);

echo json_encode(1);