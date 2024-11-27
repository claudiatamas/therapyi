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
    $selectedId = $_GET['id'];

    $sql = "DELETE FROM articole WHERE id = $selectedId";

    mysqli_query($db, $sql);

    header("Location: articole_consilieri.php");
} else {
    echo "ID-ul articolului nu a fost furnizat.";
}
?>
