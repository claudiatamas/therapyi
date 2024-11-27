<?php
  include("navbar_student.php");
?>
<?php
ob_start();
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {

    header("Location: login.php");
    exit();
}

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
    

<div class="container-results">
    <h2 class="title">Rezultatele Tale</h2>
    <div class="content">
        <p class="subtitle">Stres Acut (daca nu este tratat poate deveni 'stres cronic')</p>
        <p>Această categorie este cel mai bine descrisa ca Stres Acut. Daca simptomele care cauzează stresul rămân activate mai mult de cateva saptamani, stresul ar putea deveni cronic, iar stresul cronic poate afecta și sanatatea ta fizica. Este normal sa avem un nivel ridicat de stres la un moment dat in viata noastra, din cauza multor scenarii si factori de stres. Dar fluxul cronic de hormoni de stres (inclusiv cortizolul) poate avea un impact negativ asupra corpului tau, facandu-te sa imbatranesti mai rapid si sa fii predispus la boli. Pentru a preveni orice probleme de sanatate, este cel mai bine sa vezi un profesional medical pentru tratament. Acest test nu este un substitut pentru un diagnostic adecvat. Te incurajăm sa programezi o consultatie cu medicul tau sau cu un alt specialist in domeniul sanatatii mintale acum.</p>
    </div>
</div>


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