<?php
ob_start();
session_start();

// Verificați dacă utilizatorul este autentificat
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    // Redirecționați către pagina de autentificare dacă nu sunteți autentificat
    header("Location: login.php");
    exit();
}

include("navbar_consilier.php");
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
  <script>
    function closeForm_buttons_account_consilier() {

      window.close();

    
      window.location.href = "resurse.php";
    }
    </script>
</head>
<body>
  <br>
  <br>
  
  <?php
  ob_start();

  $db = mysqli_connect("127.0.0.1", "root", "");
  mysqli_select_db($db, "webd");

  $row = null;
  
  if (isset($_GET['selectedId'])) {
    $selectedUserId = $_GET['selectedId'];
    $selectedUserId = mysqli_real_escape_string($db, $selectedUserId); 
    $sql = "SELECT * FROM resurse WHERE id = '$selectedUserId'";
    $result = mysqli_query($db, $sql);

    if (!$result || mysqli_num_rows($result) == 0) {

      echo "Eroare: Nu s-au putut obține datele resursei.";
    } else {
      $row = mysqli_fetch_assoc($result);
      
      if (isset($_POST["save"])) {
        $nume = mysqli_real_escape_string($db, $_POST["fname"]);
        $descriere = mysqli_real_escape_string($db, $_POST["descriere"]);
      

        $updateSql = "UPDATE resurse SET nume = '$nume', descriere = '$descriere' WHERE id = '$selectedUserId'";

        mysqli_query($db, $updateSql);

        
        header("Location: resurse.php");
        exit;
      }
    }
  }
  
  ob_end_flush();
  ?>

  <h2>Editare - Resurse</h2>
  <form class="form-edit" enctype="multipart/form-data" method="POST">
    <div class="row2">
      <div class="column2">
        <label for="fname" aria-required="true">Nume:</label><br>
        <?php
        if ($row && isset($row["nume"])) {
          echo '<input type="text" id="fname" name="fname" value="'.$row["nume"].'"><br>';
        } else {
          echo '<input type="text" id="fname" name="fname" value=""><br>';
        }
        ?>
      </div>
      <div class="column2">
        <label for="descriere" aria-required="true">Descriere:</label><br>
        <?php
        if ($row && isset($row["descriere"])) {
          echo '<input type="text" id="descriere" name="descriere" value="'.$row["descriere"].'">';
        } else {
          echo '<input type="text" id="descriere" name="descriere" value="">';
        }
        ?>
      </div>
    </div>

   
    <div class="row2">
      <div class="column2">
        <label for="url_resursa" aria-required="true">URL Resursă:</label><br>
        <?php
        if ($row && isset($row["url_resursa"])) {
          echo '<input type="text" id="url_resursa" name="url_resursa" value="'.$row["url_resursa"].'">';
        } else {
          echo '<input type="text" id="url_resursa" name="url_resursa" value="">';
        }
        ?>
      </div>
    </div>
    
    <div class="row2">
      <button type="submit" class="button2" name="save">Save</button>
      <button type="button" onclick="closeForm_buttons_account_consilier()" style="padding:10px;">Close</button>
    </div>
    
  </form>

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
