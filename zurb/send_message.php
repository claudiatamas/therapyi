<?php

$db = mysqli_connect("127.0.0.1", "root", "");
mysqli_select_db($db, "webd");

$user_id = $_SESSION['user_id'];
$utilizator_id = $_POST['utilizatorId'];
$mesaj = $_POST['mesaj'];


$query_conversatie_existent = "SELECT id FROM conversatii WHERE (utilizator1_id = $user_id AND utilizator2_id = $utilizator_id) OR (utilizator1_id = $utilizator_id AND utilizator2_id = $user_id)";
$result_conversatie_existent = mysqli_query($db, $query_conversatie_existent);

if (mysqli_num_rows($result_conversatie_existent) > 0) {
 
    $row_conversatie_existent = mysqli_fetch_assoc($result_conversatie_existent);
    $conversatie_id = $row_conversatie_existent['id'];

    $query_inserare_mesaj = "INSERT INTO mesaje (id_conversatie, expeditor_id, mesaj, data_ora) VALUES ($conversatie_id, $user_id, '$mesaj', NOW())";
    mysqli_query($db, $query_inserare_mesaj);

 
    $query_informatii_expeditor = "SELECT nume_utilizator FROM utilizatori WHERE id = $user_id";
    $result_informatii_expeditor = mysqli_query($db, $query_informatii_expeditor);
    $row_informatii_expeditor = mysqli_fetch_assoc($result_informatii_expeditor);
    $nume_expeditor = $row_informatii_expeditor['nume_utilizator'];

   
    $message_html = '<li class="chat-message">';
    $message_html .= '  <div class="chat-bubble">';
    $message_html .= '    <p>' . $mesaj . '</p>';
    $message_html .= '    <span class="timestamp">' . $nume_expeditor . '</span>';
    $message_html .= '  </div>';
    $message_html .= '</li>';

    echo $message_html;
}
?>
