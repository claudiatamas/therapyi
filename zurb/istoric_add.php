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

$query = "SELECT id, nume_utilizator FROM utilizatori WHERE tip_utilizator_id = 1";
$result = mysqli_query($db, $query);
$utilizatori = mysqli_fetch_all($result, MYSQLI_ASSOC);

$query_teste = "SELECT id, nume FROM teste";
$result_teste = mysqli_query($db, $query_teste);
$teste = mysqli_fetch_all($result_teste, MYSQLI_ASSOC);
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

     
      window.location.href = "istoric_test.php";
    }
  </script>
</head>
<body>
  <br>
  <br>

  <?php
  ob_start();

  if (isset($_POST["save"])) {
    $nume = mysqli_real_escape_string($db, $_POST["teste"]);

    $punctaj = mysqli_real_escape_string($db, $_POST["punctaj"]);
    $feedback = mysqli_real_escape_string($db, $_POST["feedback"]);
    $utilizator_id = mysqli_real_escape_string($db, $_POST["utilizator"]);
    $insertSql = "INSERT INTO istoric_teste (teste_id, punctaj_final, feedback, utilizatori_id) VALUES ('$nume', '$punctaj', '$feedback', '$utilizator_id')";

    mysqli_query($db, $insertSql);

    header("Location: istoric_test.php");
    exit;
  }

  ob_end_flush();
  ?>

  <h2>Adăugare - Istoric Teste</h2>
  <form class="form-edit" enctype="multipart/form-data" method="POST">
    <div class="row2">
      <div class="column2">
        <label for="utilizator" aria-required="true">Utilizator:</label><br>
        <select id="utilizator" name="utilizator" required>
          <?php foreach ($utilizatori as $utilizator) { ?>
            <option value="<?php echo $utilizator['id']; ?>"><?php echo $utilizator['nume_utilizator']; ?></option>
          <?php } ?>
        </select><br>
      </div>
      <div class="column2">
        <label for="teste" aria-required="true">Test:</label><br>
        <select id="teste" name="teste" required>
          <?php foreach ($teste as $test) { ?>
            <option value="<?php echo $test['id']; ?>"><?php echo $test['nume']; ?></option>
          <?php } ?>
        </select><br>
      </div>
    </div>

    <div class="row2">
      <div class="column2">
        <label for="punctaj" aria-required="true">Punctaj:</label><br>
        <input type="number" id="punctaj" name="punctaj" required>
      </div>
      <div class="column2">
        <label for="feedback" aria-required="true">Feedback:</label><br>
        <input type="text" id="feedback" name="feedback" required>
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
