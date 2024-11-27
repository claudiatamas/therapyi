<?php
ob_start();
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {

    header("Location: login.php");
    exit();
}

?>
<?php
  include("navbar_consilier.php");
  $sql = "SELECT * FROM teste";
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
<br>
<br>
<br>
<a href="adaugare_test.php" class="button1" style="margin-left:170px;"><i class="fa fa-plus"></i></a>
<a href="istoric_test.php" class="button1" ><i class="fa fa-history"></i></a>
  <br>
  <br>
  <div class="grid-container">
    <div class="grid-x grid-margin-x small-up-2 medium-up-3">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $imagine = $row['imagine'];
                $nume = $row['nume'];
                $descriere = $row['descriere'];
      
        ?>
                <div class="cell">
                    <div class="card">
                        <img src="<?php echo $imagine; ?>">
                        <div class="card-section">
                            <h4><?php echo $nume; ?></h4>
                            <p style="text-align: justify;"><?php echo $descriere; ?></p>
                            <a href="modificare_teste.php?test_id=<?php echo $id; ?>">
                                <button type="button1" class="button1"><i class="fa fa-pen"></i></button>
                                
                            </a>
                         
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>
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
  
  </body>
</html>