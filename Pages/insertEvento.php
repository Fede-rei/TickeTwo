<?php
session_start();

// Imposta il percorso radice del sito
$rootPath = '../';

// Controlla se l'utente è loggato e ha il tipo corretto
if (!isset($_SESSION['user']) || !isset($_SESSION['tipo']) || $_SESSION['tipo'] != 1) {
    // Se l'utente non è loggato o non ha il tipo corretto, reindirizza alla pagina di login
    header('Location: ..');
    exit();
}

include '../include/db_inc.php';


if (isset($_POST['titolo'], $_POST['luogo'], $_POST['data'], $_POST['desc'], $_POST['posti'], $_POST['prezzo'])) {
    $nome = $_POST['titolo'];
    $luogo = $_POST['luogo'];
    $data = str_replace('T', ' ', $_POST['data']) . ':00';
    $desc = $_POST['desc'];
    $posti = $_POST['posti'];
    $prezzo = $_POST['prezzo'];

    if (isset($_FILES['pic']) && $_FILES['pic'] != NULL && $_FILES["pic"]["error"] == 0) {
        // Ottieni il nome del file immagine originale
        $originalFileName = explode(".", $_FILES['pic']['name']);
        $tmpimagename = 'temp.' . $originalFileName[count($originalFileName) - 1];

        // Ottieni il tipo, l'errore e il percorso temporaneo dell'immagine caricata
        $imagetype = $_FILES['pic']['type'];
        $imageerror = $_FILES['pic']['error'];
        $imagetemp = $_FILES['pic']['tmp_name'];

        // Percorso in cui si desidera caricare l'immagine
        $imagePath = $rootPath . 'Images/';

        // Sposta l'immagine caricata nella directory desiderata
        if (is_uploaded_file($imagetemp)) {
            if (move_uploaded_file($imagetemp, $imagePath . $tmpimagename)) {
                if (strlen($nome) <= 50) {
                    if (strlen($luogo) <= 50) {
                        if (strlen($desc) <= 500) {
                            if (isset($db)) {
                                $insert = $db->prepare('insert into evento(nome, descrizione, data, luogo, posti) values(:n, :de, :da, :l, :p)');
                                $insert->execute(['n' => $nome, 'de' => $desc, 'da' => $data, 'l' => $luogo, 'p' => $posti]);
                            }

                            $sel = $db->prepare('select * from evento order by id_evento desc');
                            $selR = $sel->execute();
                            $selR = $sel->fetch();

                            $newimagename = $selR['id_evento'] . '.' . $originalFileName[count($originalFileName) - 1];
                            rename('../Images/' . $tmpimagename, '../Images/' . $newimagename);

                            $upd = $db->prepare('update evento set image = :i where nome = :n and descrizione = :de and data = :da and luogo = :l');
                            $upd->execute(['i' => $newimagename, 'n' => $nome, 'de' => $desc, 'da' => $data, 'l' => $luogo]);

                            $insertB = $db->prepare('insert into biglietto(id_event, prezzo) values(:i, :p)');
                            $insertB->execute(['i' => $selR['id_evento'], 'p' => $prezzo]);

                            header('Location: eventPage.php?eventId=' . $selR['id_evento']);
                        }
                    }
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>TickeTwo - Aggiungi evento</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../Styles/insertEvento.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="<?= $rootPath ?>Images/ticketwoW.png" rel="icon" type="image/png">
    <link rel="stylesheet" href="../Styles/header-footer.css">
</head>
<body>
<?php include $rootPath . 'include/header.php' ?>

<form id="container" method="post" enctype="multipart/form-data">
    <div id="locandina">
        <div>
            <label for="bF">Locandina evento: </label> <br><br>
            <label id="bF">
                Seleziona il file
                <input type="file" accept="image/jpeg, image/png, image/jpg, image/gif" name="pic" id="pic"
                       title="Inserisci un' immagine">
            </label>
        </div>
    </div>
    <br><br><br>

    <label for="p1" id="titolo">Titolo:
        <input type="text" name="titolo" id="p1" class="li">
    </label>

    <label for="p2" id="luogo">Luogo:
        <input type="text" id="p2" class="li" name="luogo">
    </label>

    <label for="p3" id="date">Data:
        <input type="datetime-local" id="p3" class="li" name="data">
    </label>
    <label for="p4" id="posti">Posti Disponibili:
        <input id="p4" type="number" name="posti" class="li">
    </label>
    <label for="p5" id="prezzo"> Prezzo:
        <input id="p5" type="number" name="prezzo" class="li">
    </label>
    <button type="submit" id="submit" class="butt">Aggiungi</button>
    <label for="textarea" id="desc"> Descrizione:
        <textarea name="desc" maxlength="500"></textarea>
    </label>
</form>

<?php include $rootPath . 'include/footer.php' ?>
</body>
</html>
