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
  <style>
  .grid-container {
    margin-left: 20vh;
    margin-right: 20vh;
  }
  .center {
    text-align: center;
  }
</style>

<body>
   
<br>
<br>
<br>
<a href="istoric_add.php" class="button1" style="margin:170px;"><i class="fa fa-plus"></i></a>
  <br>
  <br>
  <?php

$sql = "SELECT it.*, u.nume_utilizator AS nume_student, t.nume 
        FROM istoric_teste it
        INNER JOIN utilizatori u ON it.utilizatori_id = u.id
        INNER JOIN teste t ON it.teste_id = t.id";

$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table class='grid-container'>
            <tr>
                <th>Nume student</th>
                <th>Test</th>
                <th>Punctaj</th>
                <th>Feedback</th>
            </tr>";


    while ($row = mysqli_fetch_assoc($result)) {
        $nume_student = $row['nume_student'];
        $test = $row['nume'];
        $punctaj = $row['punctaj_final'];
        $feedback = $row['feedback'];

        echo "<tr>
                <td class='center'>$nume_student</td>
                <td class='center'>$test</td>
                <td class='center'>$punctaj</td>
                <td class='center'>$feedback</td>
                <td class='center'>
                <button onclick='openEditWindow(".$row["id"].")'><i class='fa fa-pen' style='cursor:pointer;color:#4CAF50;'></i></button>
              
                </td>
                <td class='center'>
                <button onclick='confirmDelete(".$row["id"].")'><i class='fa fa-trash' style='color:red;cursor:pointer;'></i></button>
                </td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "Nu există rezultate disponibile.";
}


?>

<section class="footer">

  <div class="box-container">

     <div class="box">
      <br>
        <h3>quick links</h3>
        <a href="dash_consilieri.php"> <i class="fas fa-angle-right"></i> Acasă</a>
        <a href="teste.php"> <i class="fas fa-angle-right"></i> Teste</a>
        <a href="resurse.php"> <i class="fas fa-angle-right"></i> Resurse</a>
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
  var selectedId;

  function openEditWindow(istoricId) {
   
    selectedId = istoricId;


    window.location.href = "edit_istoric.php?selectedId=" + selectedId;
  }

  function confirmDelete(istoricId) {
    var confirmDelete = confirm("Sunteți sigur că doriți să ștergeți?");

    if (confirmDelete) {
     
      selectedId = istoricId;

   
      window.location.href = "delete_istoric.php?id=" + selectedId;
    }
  }
</script>
  </body>
</html>
