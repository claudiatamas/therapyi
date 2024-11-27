<?php
session_start();
// Conectarea la baza de date
$db = mysqli_connect("127.0.0.1", "root", "");
mysqli_select_db($db, "webbd");

$user_id = $_SESSION['user_id'];
$utilizator_id = $_POST['utilizatorId'];

// Verifică dacă există o conversație între cei doi utilizatori
$query_conversatie = "SELECT id FROM conversatii WHERE (utilizator1_id = $user_id AND utilizator2_id = $utilizator_id) OR (utilizator1_id = $utilizator_id AND utilizator2_id = $user_id)";
$result_conversatie = mysqli_query($db, $query_conversatie);

if (mysqli_num_rows($result_conversatie) > 0) {
    $row_conversatie = mysqli_fetch_assoc($result_conversatie);
    $conversatie_id = $row_conversatie['id'];

    // Obține mesajele din conversație
    $query_mesaje = "SELECT m.mesaj, m.expeditor_id, u.nume_utilizator AS expeditor, m.data_ora
                     FROM mesaje m
                     INNER JOIN utilizatori u ON m.expeditor_id = u.id
                     WHERE m.id_conversatie = $conversatie_id
                     ORDER BY m.id ASC";
    $result_mesaje = mysqli_query($db, $query_mesaje);

    $mesaje = array();
    while ($row_mesaj = mysqli_fetch_assoc($result_mesaje)) {
        $mesaj = $row_mesaj['mesaj'];
        $expeditor = $row_mesaj['expeditor'];
        $data_ora = $row_mesaj['data_ora'];
        $expeditor_id = $row_mesaj['expeditor_id'];
        $mesaje[] = array('mesaj' => $mesaj, 'expeditor' => $expeditor, 'data_ora' => $data_ora, 'expeditor_id' => $expeditor_id);
    }

    // Afișează mesajele în formatul dorit
    foreach ($mesaje as $mesaj) {
        echo '<li class="chat-message">';
        echo '  <div class="chat-bubble">';
        echo '    <p>' . $mesaj['mesaj'] . '</p>';
        echo '    <span class="timestamp">' . $mesaj['expeditor'] . '</span>';
        echo '  </div>';
        echo '</li>';
    }
} else {
    echo '<div class="no-conversation">Start a new conversation.</div>';
}
?>
