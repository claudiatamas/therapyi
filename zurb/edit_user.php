<?php
ob_start();
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
 
    header("Location: login.php");
    exit();
}
include("navbar_admin.php");
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
      <?php
      ob_start();
 
      $db = mysqli_connect("127.0.0.1", "root", "");
      mysqli_select_db($db, "webd");

      if (isset($_GET['selectedUserId'])) {
        $selectedUserId = $_GET['selectedUserId'];
        $selectedUserId = mysqli_real_escape_string($db, $selectedUserId); 
        $sql = "SELECT s.nume, s.prenume, s.email AS student_email, s.facultate, s.specializare, s.nr_matricol
          FROM student s WHERE s.id = $selectedUserId";

        $result = mysqli_query($db, $sql);

        if (!$result || mysqli_num_rows($result) == 0) {

          echo "Error: Failed to fetch user data.";
        } else {
          $row = mysqli_fetch_assoc($result);

          if (isset($_POST["save"])) {
      
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $email = $_POST["email"];
            $matricol = $_POST["matricol"];
            $facultate = $_POST["facultate"];
            $specializare = $_POST["specializare"];

    
            $updateSql = "UPDATE student SET nume = '$fname', prenume = '$lname', email = '$email', nr_matricol = '$matricol', facultate = '$facultate', specializare = '$specializare' WHERE id = $selectedUserId";
            mysqli_query($db, $updateSql);
            $updateUtilizatoriSql = "UPDATE utilizatori u
            INNER JOIN student s ON u.id = s.utilizatori_id
            SET u.nume_utilizator = CONCAT('$fname', ' ', '$lname'), u.email = '$email'
            WHERE s.id = $selectedUserId";
            mysqli_query($db, $updateUtilizatoriSql);
       
            header("Location: aprobare_studenti.php");

            exit;
          }
        }
      }
      ob_end_flush(); 
      ?>
 


  <h2>Editare -  student</h3>
  <form class="form-edit" enctype="multipart/form-data"  method="POST">
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
        <label for="lname" aria-required="true">Prenume:</label><br>
        <?php
        if ($row && isset($row["prenume"])) {
          echo '<input type="text" id="lname" name="lname" value="'.$row["prenume"].'">';
        } else {
          echo '<input type="text" id="lname" name="lname" value="">';
        }
        ?>
      </div>
    </div>

    <div class="row2">
      <div class="column2">
        <label for="email" aria-required="true">Email:</label><br>
        <?php
        if ($row && isset($row["student_email"])) {
          echo '<input type="email" id="email" name="email" value="'.$row["student_email"].'"><br>';
        } else {
          echo '<input type="email" id="email" name="email" value=""><br>';
        }
        ?>
      </div>
      <div class="column2">
        <label for="matricol" aria-required="true">Nr. matricol:</label><br>
        <?php
        if ($row && isset($row["nr_matricol"])) {
          echo '<input type="text" id="matricol" name="matricol" value="'.$row["nr_matricol"].'">';
        } else {
          echo '<input type="text" id="matricol" name="matricol" value="">';
        }
        ?>
      </div>
    </div>

    <div class="row2">
      <div class="column2">
        <label for="facultate" aria-required="true">Facultate:</label><br>
        <?php
        if ($row && isset($row["facultate"])) {
          echo '<input type="text" id="facultate" name="facultate" value="'.$row["facultate"].'"><br>';
        } else {
          echo '<input type="text" id="facultate" name="facultate" value=""><br>';
        }
        ?>
      </div>
      <div class="column2">
        <label for="specializare" aria-required="true">Specializare:</label><br>
        <?php
        if ($row && isset($row["specializare"])) {
          echo '<input type="text" id="specializare" name="specializare" value="'.$row["specializare"].'">';
        } else {
          echo '<input type="text" id="specializare" name="specializare" value="">';
        }
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
