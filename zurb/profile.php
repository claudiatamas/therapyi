<?php
ob_start();
session_start();
// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    // Redirect to the login page if not logged in
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
  <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this picture?");
        }
    </script>
</head>
<body>

<div class="callout secondary">
  <nav aria-label="You are here:" role="navigation">
    <ul class="breadcrumbs">
      <li><a href="dash_students.php">Acasă</a></li>
      <li>
        <span class="show-for-sr">Current: </span> Edit profile
      </li>
    </ul>
  </nav>
  <br>
  <div class="media-object">
    <div>
    <?php
      ob_start();
  
      $db = mysqli_connect("127.0.0.1", "root", "");
      mysqli_select_db($db, "webd");

      $user_id = $_SESSION['user_id'];
      $sql = "SELECT s.nume, s.prenume, s.email AS student_email, s.imagine, s.facultate, s.specializare, s.nr_matricol
              FROM student s
              JOIN utilizatori u ON s.utilizatori_id = u.id
              WHERE u.id = $user_id";      

      $result = mysqli_query($db, $sql);

      if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo '<img src="'.$row["imagine"].'" class="edit-profil">';
        echo '<div class="media-object-section">';
        echo '<h3>'.$row["nume"], " " .$row["prenume"].'</h3>';
        echo '<p style="color: #ffffff;"><i class="fa fa-envelope" style="color: #ffffff;"></i> <span>'.$row["student_email"].'</span></p>';
        echo '</div>';
      }

      if (isset($_POST["upload-photo"])) {
     
        if (isset($_FILES["profile-pic"]) && $_FILES["profile-pic"]["error"] == UPLOAD_ERR_OK) {
     
            $tempFilePath = $_FILES["profile-pic"]["tmp_name"];
            $fileName = $_FILES["profile-pic"]["name"];
            $fileSize = $_FILES["profile-pic"]["size"];
            $fileType = $_FILES["profile-pic"]["type"];
    
 
            $uniqueFileName = uniqid() . "_" . $fileName;
    
      
            $uploadPath = "images/" . $uniqueFileName;
    
       
            if (move_uploaded_file($tempFilePath, $uploadPath)) {
         
                $updateSql = "UPDATE student s
                INNER JOIN utilizatori u ON s.utilizatori_id = u.id
                SET s.imagine = '$uploadPath', u.imagine = '$uploadPath'
                WHERE u.id = $user_id";
                
                mysqli_query($db, $updateSql);
               
              header("Location: ".$_SERVER['PHP_SELF']);
               exit;
            } 
        }
      }
  
      if (isset($_POST["delete-photo"])) {
    
          $updateSql = "UPDATE student AS s
          INNER JOIN utilizatori AS u ON s.utilizatori_id = u.id
          SET s.imagine = DEFAULT, u.imagine = DEFAULT
          WHERE u.id = $user_id";
          mysqli_query($db, $updateSql);
    
          header("Location: ".$_SERVER['PHP_SELF']);
          exit;
      }
    
  
      if (isset($_POST["save"])) {
        
          $fname = $_POST["fname"];
          $lname = $_POST["lname"];
          $email = $_POST["email"];
          $matricol = $_POST["matricol"];
          $facultate = $_POST["facultate"];
          $specializare = $_POST["specializare"];
    
        
          $updateSql = "UPDATE student SET nume = '$fname', prenume = '$lname', email = '$email', nr_matricol = '$matricol', facultate = '$facultate', specializare = '$specializare'  WHERE utilizatori_id = $user_id";
          mysqli_query($db, $updateSql);
    
          header("Location: ".$_SERVER['PHP_SELF']);
          exit;
      }
    
    
      ob_end_flush();
      ?>
    </div>
  </div>
</div>
<br>

<div class="row2">
  <div class="column2">
    <?php

    if ($row["imagine"]) {
        echo '<img src="'.$row["imagine"].'" width="100px" height="100px">';
    } else {
        echo '<img src="default-profile-pic.jpg" width="100px" height="100px">';
    }
    ?>
    <form class="upload-form" method="POST" enctype="multipart/form-data">
    <input type="file" name="profile-pic">
      <button type="submit" class="button4" name="upload-photo">Upload</button>
   
    </form>
    <BR>
    <form method="POST">
      <button type="submit" class="button5" name="delete-photo"  onclick="return confirmDelete();">Delete</button>
    </form>
  </div>
</div>

<form class="form-edit" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
  <div class="row2">
    <div class="column2">
      <label for="fname" aria-required="true">Nume:</label><br>
      <?php
      echo '<input type="text" id="fname" name="fname" value="'.$row["nume"].'"><br>';
      ?>
    </div>
    <div class="column2">
      <label for="lname" aria-required="true">Prenume:</label><br>
      <?php
      echo '<input type="text" id="lname" name="lname" value="'.$row["prenume"].'">';
      ?>
    </div>
  </div>

  <div class="row2">
    <div class="column2">
      <label for="email" aria-required="true">Email:</label><br>
      <?php
      echo '<input type="email" id="email" name="email" value="'.$row["student_email"].'"><br>';
      ?>
    </div>
    <div class="column2">
      <label for="matricol" aria-required="true">Nr. matricol:</label><br>
      <?php
      echo '<input type="text" id="matricol" name="matricol" value="'.$row["nr_matricol"].'">';
      ?>
    </div>
  </div>

  <div class="row2">
    <div class="column2">
      <label for="facultate" aria-required="true">Facultate:</label><br>
      <?php
      echo '<input type="text" id="facultate" name="facultate" value="'.$row["facultate"].'"><br>';
      ?>
    </div>
    <div class="column2">
      <label for="specializare" aria-required="true">Specializare:</label><br>
      <?php
      echo '<input type="text" id="specializare" name="specializare" value="'.$row["specializare"].'">';
      ?>
    </div>
  </div>

  <div class="row2">
    <button type="submit" class="button4" name="save">Save</button>
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