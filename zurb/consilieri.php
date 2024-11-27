<?php
ob_start();
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {

    header("Location: login.php");
    exit();
}

?>
<?php
  include("navbar_student.php");
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
  
<?php 

$db = mysqli_connect("127.0.0.1", "root", "");
mysqli_select_db($db, "webd");

$query = "SELECT * FROM consilier";
$result = mysqli_query($db, $query);


while ($row = mysqli_fetch_assoc($result)) {
    $nume = $row['nume'];
    $prenume = $row['prenume'];
    $telefon = $row['telefon'];
    $descriere = $row['descriere'];
    $imagine = $row['imagine'];

    echo '
    <div class="media-object">
        <div class="media-object-section">
            <div class="thumbnail">
                <img src="' . $imagine . '" width="170px">
            </div>
        </div>
        <div class="media-object-section">
            <h4>' . $nume . ' ' . $prenume . '</h4>
            <a href="#" style="color:black;"><i class="fas fa-phone" style="color:black;"></i>'.' '  . $telefon . '</a>
            <p>' . $descriere . '</p>
            <button class="button1"><i class="fa fa-comments"></i><span> Chat</span></button>
        </div>
    </div>';
}

mysqli_free_result($result);
mysqli_close($db);
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
  
  </body>
</html>