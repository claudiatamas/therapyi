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


if (isset($_GET['selectedId'])) {

    $selectedId = $_GET['selectedId'];

    $sql = "SELECT * FROM articole WHERE id = $selectedId";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nume_articol = $row['nume'];
        $imagine = $row['imagine'];
        $descriere = $row['descriere'];
        $url = $row['url'];
    } else {

        header("Location: articole_consilieri.php");
        exit();
    }
} else {
 
    header("Location: articole_consilieri.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $nume_articol = $_POST['nume_articol'];
    $descriere = $_POST['descriere'];
    $url = $_POST['url'];


    if (isset($_FILES['imagine']) && $_FILES['imagine']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['imagine']['tmp_name'];
        $file_name = $_FILES['imagine']['name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_file_name = uniqid() . '.' . $file_ext;
        $new_file_path = 'images/' . $new_file_name;

 
        move_uploaded_file($file_tmp, $new_file_path);

    
        $imagine = $new_file_path;
    }


    $updateSql = "UPDATE articole SET nume = '$nume_articol', imagine = '$imagine', descriere = '$descriere', url = '$url' WHERE id = $selectedId";
    $db->query($updateSql);


    header("Location: articole_consilieri.php");
    exit();
}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editare Articol</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <script>
    function closeForm_buttons_account_consilier() {

      window.close();

 
      window.location.href = "articole_consilieri.php";
    }
  </script>
</head>
<body>
<br><br><br>

<h2>Modifică articolul:</h2>
<form class="form-edit" enctype="multipart/form-data" method="POST">
    <div class="row2">
        <div class="column2">
            <label for="nume_articol" aria-required="true">Nume articol:</label><br>
            <input type="text" id="nume_articol" name="nume_articol" value="<?php echo $nume_articol; ?>"><br>
        </div>
        <div class="column2">
            <label for="descriere" aria-required="true">Descriere:</label><br>
            <input type="text" id="descriere" name="descriere" value="<?php echo $descriere; ?>">
        </div>
    </div>
    <div class="row2">
    <div class="column2">
        <label for="imagine" aria-required="true">Imagine:</label><br>
        <input type="file" id="imagine" name="imagine" accept="image/*"><br>
        <?php if ($imagine): ?>
        <img src="<?php echo $imagine; ?>" alt="Imagine articol" width="200">
        <?php endif; ?>
    </div>
    <div class="column2">
        <label for="url" aria-required="true">URL articol:</label><br>
        <input type="text" id="url" name="url" value="<?php echo $url; ?>">
    </div>
</div>


    <div class="row2">
        <button type="submit" class="button1" name="save">Save</button>
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
