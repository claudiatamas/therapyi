<?php
ob_start();
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {

    header("Location: login.php");
    exit();
}

$db = mysqli_connect("127.0.0.1", "root", "");
mysqli_select_db($db, "webd");

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $sql = "DELETE consilier, utilizatori
            FROM consilier
            JOIN utilizatori ON consilier.utilizatori_id = utilizatori.id
            WHERE consilier.id = $userId";

    mysqli_query($db, $sql);

    echo "Utilizatorul cu ID-ul $userId a fost șters cu succes.";
} else {
    echo "ID-ul utilizatorului nu a fost furnizat.";
}
?>
