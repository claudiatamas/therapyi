<?php
ob_start();
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: login.php");
    exit();
}

$db = mysqli_connect("127.0.0.1", "root", "");
mysqli_select_db($db, "webd");

if (isset($_GET['test_id'])) {
    $test_id = $_GET['test_id'];

    // Mai întâi, ștergem rezultatele care se referă la test
    $delete_rezultate_sql = "DELETE FROM rezultate WHERE test_id = $test_id";
    $db->query($delete_rezultate_sql);

    // Ștergem răspunsurile asociate întrebărilor testului
    $delete_raspunsuri_sql = "DELETE FROM raspunsuri WHERE intrebare_id IN (SELECT id FROM intrebari WHERE test_id = $test_id)";
    $db->query($delete_raspunsuri_sql);

    // Apoi, ștergem întrebările asociate testului
    $delete_intrebari_sql = "DELETE FROM intrebari WHERE test_id = $test_id";
    $db->query($delete_intrebari_sql);
    
    // În final, ștergem testul
    $delete_test_sql = "DELETE FROM teste WHERE id = $test_id";
    $delete_test_result = $db->query($delete_test_sql);

    if ($delete_test_result) {
         header("Location: teste.php");
        exit();
    } else {
        echo "Eroare la ștergerea testului și a datelor asociate.";
    }
} else {
    echo "Nu s-a specificat un ID de test.";
}

?>
