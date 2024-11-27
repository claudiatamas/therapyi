<?php
ob_start();
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {

    header("Location: login.php");
    exit();
}


include("navbar_consilier.php");
$db = mysqli_connect("127.0.0.1", "root", "");
mysqli_select_db($db, "webd");


$sql = "SELECT a.id AS id_articol, a.nume AS nume_articol, a.imagine, a.descriere, a.url, c.nume, c.prenume
        FROM articole AS a
        INNER JOIN consilier AS c ON a.consilier_id = c.id";
$result = $db->query($sql);

?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consiliere Studenți</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
  </head>
<body>
<br><br><br>
<a href="articole_add.php" class="button1" style="margin-left:180px;"><i class="fa fa-plus"></i></a>
<?php

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        $numeConsilier = $row['nume'] . " " . $row['prenume'];
        echo '
        <div class="media-object stack-for-small">
            <div class="media-object-section">
                <div class="thumbnail">
                    <img src="' . $row['imagine'] . '" width="400px">
                </div>
            </div>
            <div class="media-object-section">
                <h4>' . $row['nume_articol'] . '</h4><br>
                <p>' . $row['descriere'] . '</p>
                <p>Adăugat de: ' . $numeConsilier .'</p><br>
                <a href="' . $row['url'] . '" class="button1" target="_blank">Citește mai mult...</a>
            </div>
            <div class="media-object-section" style="margin-left:auto;margin-top:260px;">
                <button onclick="openEditWindow('.$row['id_articol'].')"><i class="fa fa-pen" style="cursor:pointer;color:#4CAF50;"></i></button>
                <button onclick="confirmDelete('.$row['id_articol'].')"><i class="fa fa-trash" style="color:red;cursor:pointer;"></i></button>
            </div>
        </div>
        <br>';
    }
} else {
    echo "Nu există articole disponibile.";
}

?>
<section class="footer">
<div class="box-container">
      <div class="box">
        <br>
        <h3>quick links</h3>
        <a href="dash_students.php"> <i class="fas fa-angle-right"></i> Acasă</a>
        <a href="quiz.php"> <i class="fas fa-angle-right"></i> Teste</a>
        <a href="consilieri.php"> <i class="fas fa-angle-right"></i> Consilieri</a>
      </div>

      <div class="box">
        <br>
        <h3>extra links</h3>
        <a href="about.php"> <i class="fas fa-angle-right"></i> about </a>
        <a href="#"> <i class="fas fa-angle-right"></i> privacy policy</a>
        <a href="#"> <i class="fas fa-angle-right"></i> terms of use</a>
      </div>

      <div class="box">
        <br>
        <h3>contact info</h3>
        <a href="#"> <i class="fas fa-phone"></i> +40745780410 </a>
        <a href="#"> <i class="fas fa-envelope"></i> claudiatamas28@gmail.com </a>
        <a href="#"> <i class="fas fa-map"></i> Baia Mare, Maramureș </a>
      </div>
    </div>

    <div class="credit"> created by <span>Claudia Tămaș</span> | all rights reserved! </div><br>
</section>

<script src="js/vendor/jquery.js"></script>
<script src="js/vendor/what-input.js"></script>
<script src="js/vendor/foundation.js"></script>
<script src="js/app.js"></script>
<script>
  var selectedUserId;

  function openEditWindow(id_articol) {
   
    selectedId = id_articol;

    window.location.href = "edit_articol.php?selectedId=" + selectedId;


  }

  function confirmDelete(id_articol) {
    var confirmDelete = confirm("Sunteți sigur că doriți să ștergeți articolul cu ID-ul " + id_articol + "?");

    if (confirmDelete) {
    
      selectedId = id_articol;

     
      window.location.href = "delete_articol.php?id=" + selectedId;
    }
  }
</script>
</body>
</html>
