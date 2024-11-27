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
?>


<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consiliere Studenți</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
  </head>
<body>
   

<div class="twoColumns">
    <div class="left">
        <h3>ABOUT US</h3><BR>
        <h4>Această platformă are drept scop ajutarea studenților care au nevoie să discute cu cineva.</h4>
        <p>În ultimii ani, numărul studenților care solicită consiliere în domeniul sănătății mintale a crescut vertiginos. Cu toate acestea, majoritatea colegiilor s-au luptat să susțină sănătatea mintală a studenților. Acest lucru se datorează mai multor factori precum: cerere crescută,  lipsa accesului.</p>
    </div>
    <div class="right">
      <img src="images/login-img@2x.png"   class="responsive">
    </div>
</div>

<br>

<section class="product-feature-section">
  <div class="product-feature-section-outer">
    <h4 class="product-feature-section-headline">Trimite-ne un  <div> Feedback!</h4>

        <div class="columns contact-us-section-right">
            <form class="contact-us-form">
              <input type="text" placeholder="Full name">
              <input type="email" placeholder="Email">
              <textarea name="message" id="" rows="12" placeholder="Type your message here"></textarea>
              <div class="contact-us-form-actions">
                <input type="submit" class="button" value="Trimite" />
                <div>
                  <label for="FileUpload" class="button contact-us-file-button">Attach Files</label>
                  <input type="file" id="FileUpload" class="show-for-sr">
                </div>
              </div>
            </form>
          </div>

    </div>
</section>





<br>

<section class="footer">

  <div class="box-container">

     <div class="box">
      <br>
        <h3>quick links</h3>
        <a href="pagina1.php"> <i class="fas fa-angle-right"></i> Acasă</a>
        <a href="studenti.php"> <i class="fas fa-angle-right"></i> Studenți</a>
        <a href="psihologi.php"> <i class="fas fa-angle-right"></i> Psihologi</a>
        <a href="login.php"> <i class="fas fa-angle-right"></i> Login/Register</a>
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