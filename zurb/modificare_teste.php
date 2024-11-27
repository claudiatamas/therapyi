<?php
ob_start();
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {

    header("Location: login.php");
    exit();
}

include("navbar_consilier.php");
$test_id = $_GET['test_id'];
$sql = "SELECT * FROM teste WHERE id = $test_id";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    $test = $result->fetch_assoc();
    
    $nume = $test['nume'];
    $descriere = $test['descriere'];
    $imagine = '';

    if (isset($test['imagine'])) {
        $imagine = $test['imagine'];
    }
} else {
    echo "Nu s-a găsit testul.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    $test_id = $_GET['test_id'];
    $nume = $_POST['nume'];
    $descriere = $_POST['descriere'];
    $imagine = '';

    if (isset($test['imagine']) && !empty($test['imagine'])) {
        $imagine = $test['imagine'];
    }

    if ($_FILES['imagine']['tmp_name']) {
        $image_tmp = $_FILES['imagine']['tmp_name'];
        $image_name = $_FILES['imagine']['name'];
        $image_path = 'images/' . basename($image_name);

    
        move_uploaded_file($image_tmp, $image_path);

        
        $imagine = $image_path;
    }

    $sql = "UPDATE teste SET nume = '$nume', descriere = '$descriere', imagine = '$imagine' WHERE id = $test_id";
    $result = $db->query($sql);

    if ($result) {
        header("Location: teste.php");
    } else {
        echo "Eroare la salvarea modificărilor.";
    }
}

$sql = "SELECT * FROM rezultate WHERE test_id = $test_id";
$result = $db->query($sql);

$rezultate = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
       
        $rezultate[] = $row;
    }
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
    function closeForm_buttons_account_consilier() {
    
      window.close();

    
      window.location.href = "teste.php";
    }
    </script>
    <style>
       .addtest {
    margin: 50px auto;
    max-width: 800px;
    padding: 20px;
}

.form-row {
    margin-bottom: 20px;
}


input[type="text"],
textarea {
    width: 750px;
    margin-bottom: 30px;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
    height: 100%;
}

input[type="radio"],
input[type="punctaj"][name^="punctaj"],label {
    float: left;
}

input[type="radio"],
input[type="punctaj"][name^="punctaj"]:disabled {
    pointer-events: none;
}

input[type="punctaj"][name^="punctaj"] {
    width: 50px;
    margin-right:10px;
}

button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

.addtest img {
    max-width: 100%;
    height: auto;
    display: block;
    margin-bottom: 10px;
}

.form-row .inline-elements {
        display: inline-block;
    }
    </style>
  </head>
<body>

<form class="addtest" method="POST" enctype="multipart/form-data">

<h2 style="text-align: center;    margin-top:20px;">Modifică testul:</h2>

<div id="image-preview">
    <?php if ($imagine) { ?>
        <img src="<?php echo $imagine; ?>" width="300px">

    <?php } ?>
</div>
<input type="file" id="imagine" name="imagine" accept="image/*" onChange="showPreview(this)">




<div class="form-row">
    <label for="nume">Nume:</label>
    <input type="text" id="nume" name="nume" value="<?php echo $nume; ?>">
</div>

<div class="form-row">
    <label for="descriere">Descriere:</label>
    <textarea id="descriere" name="descriere"><?php echo $descriere; ?></textarea>
</div>

<?php

$sql = "SELECT intrebari.id AS intrebare_id, intrebari.intrebare, raspunsuri.id AS raspuns_id, raspunsuri.raspuns, raspunsuri.punctaj FROM intrebari LEFT JOIN raspunsuri ON intrebari.id = raspunsuri.intrebare_id WHERE intrebari.test_id = $test_id";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    $intrebari = array();
    while ($row = $result->fetch_assoc()) {
        $intrebare_id = $row['intrebare_id'];
        $intrebari[$intrebare_id]['intrebare'] = $row['intrebare'];
        $intrebari[$intrebare_id]['raspunsuri'][$row['raspuns_id']] = array(
            'raspuns' => $row['raspuns'],
            'punctaj' => $row['punctaj']
        );
    }
}
?>
<ol>
<?php
 
foreach ($intrebari as $intrebare_id => $intrebare) {
    $intrebare_text = $intrebare['intrebare'];
    $raspunsuri = $intrebare['raspunsuri'];
    ?>
    <li>
        <div class="form-row">
            <label for="intrebare_<?php echo $intrebare_id; ?>">
                <input type="text" id="intrebare_<?php echo $intrebare_id; ?>" name="intrebare[<?php echo $intrebare_id; ?>]" value="<?php echo $intrebare_text; ?>">
            </label>
        </div>
        <div class="form-row">
            <?php
            foreach ($raspunsuri as $raspuns_id => $raspuns) {
                $raspuns_text = $raspuns['raspuns'];
                $punctaj = $raspuns['punctaj'];
                ?>
                <div>
                    <input type="radio" id="raspuns_<?php echo $raspuns_id; ?>" name="raspuns[<?php echo $intrebare_id; ?>]" value="<?php echo $raspuns_id; ?>" disabled>
                    <label for="raspuns_<?php echo $raspuns_id; ?>"><?php echo $raspuns_text; ?></label>
                    <input type="punctaj" id="punctaj_<?php echo $raspuns_id; ?>" name="punctaj[<?php echo $raspuns_id; ?>]" value="<?php echo $punctaj; ?>" > 
                    <br>
                </div>
                
                <?php
            }
            ?>
             

        </div>
    </li>
    <?php
}
?>
   
</ol>
<?php foreach ($rezultate as $rezultat) { ?>
    <div class="form-row">
        <label for="scor_start_<?php echo $rezultat['id']; ?>">Între <span class="inline-elements"><input type="number" id="scor_start_<?php echo $rezultat['id']; ?>" name="scor_start[<?php echo $rezultat['id']; ?>]" value="<?php echo $rezultat['scor_start']; ?>" required></span> și <span class="inline-elements"><input type="number" id="scor_end_<?php echo $rezultat['id']; ?>" name="scor_end[<?php echo $rezultat['id']; ?>]" value="<?php echo $rezultat['scor_end']; ?>" required></span> puncte:</label>
        <input type="text" id="descriere_<?php echo $rezultat['id']; ?>" name="descriere[<?php echo $rezultat['id']; ?>]" value="<?php echo $rezultat['descriere']; ?>" required>
        <input type="hidden" name="rezultat_id[]" value="<?php echo $rezultat['id']; ?>">
    </div><br>
<?php } ?>



<div class="form-row">
    <button type="submit" name="save">Salvează</button>
    <button type="button" onclick="closeForm_buttons_account_consilier()" style="padding:10px;">Close</button>
</div>
<div><button type="button" onclick="confirmDelete(<?php echo $test_id; ?>)" style="padding:10px;"><i class="fa fa-trash" style="color:red;cursor:pointer;"></i></button>                      
</div>
</form>


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
 function confirmDelete(test_id) {
        var result = confirm("Sunteți sigur că doriți să ștergeți acest test?");
        if (result) {
            window.location.href = 'delete_test.php?test_id=' + test_id;
        }
    }
    function showPreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#image-preview').html('<img src="' + e.target.result + '" width="300px">');

            var changeImageOption = '<button type="button" onclick="changeImage()">Schimbă imaginea</button>';
            $('#image-preview').append(changeImageOption);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function changeImage() {
    var newImage = prompt("Introduceți URL-ul noii imagini:");

    if (newImage) {
        $('#image-preview img').attr('src', newImage);
    }
}

  
</script>

</body>
</html>
