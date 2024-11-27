<?php
ob_start();
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {

    header("Location: login.php");
    exit();
}

if (isset($_POST['save'])) {

    $db = mysqli_connect("127.0.0.1", "root", "");
    mysqli_select_db($db, "webd");

    $nume = $_POST['nume'];
    $descriere = $_POST['descriere'];
    $uploadPath = '';

    if (isset($_FILES["imagine"]) && $_FILES["imagine"]["error"] == UPLOAD_ERR_OK) {
 
        $tempFilePath = $_FILES["imagine"]["tmp_name"];
        $fileName = $_FILES["imagine"]["name"];
        $fileSize = $_FILES["imagine"]["size"];
        $fileType = $_FILES["imagine"]["type"];

     
        $uniqueFileName = uniqid() . "_" . $fileName;

       
        $uploadPath = "images/" . $uniqueFileName;
        move_uploaded_file($tempFilePath, $uploadPath);
    }

    $sql = "INSERT INTO teste (imagine, nume, descriere) VALUES ('$uploadPath', '$nume', '$descriere')";
    $db->query($sql);


    $test_id = $db->insert_id;

    for ($i = 1; $i <= 10; $i++) {
        $intrebare = $_POST['intrebare_' . $i];
   
        $raspuns_niciodata = "Niciodată " . $_POST['raspuns_' . $i . '_1'];
        $raspuns_uneori = "Uneori " . $_POST['raspuns_' . $i . '_2'];
        $raspuns_des = "Des " . $_POST['raspuns_' . $i . '_3'];
        $raspuns_foarte_des = "Foarte des " . $_POST['raspuns_' . $i . '_4'];
    
        $punctaj_niciodata = $_POST['punctaj_' . $i . '_1'];
        $punctaj_uneori = $_POST['punctaj_' . $i . '_2'];
        $punctaj_des = $_POST['punctaj_' . $i . '_3'];
        $punctaj_foarte_des = $_POST['punctaj_' . $i . '_4'];
   
        $sql = "INSERT INTO intrebari (test_id, intrebare) VALUES ('$test_id', '$intrebare')";
        $db->query($sql);
    
   
        $intrebare_id = $db->insert_id;
    

        $sql = "INSERT INTO raspunsuri (intrebare_id, raspuns, punctaj) VALUES ('$intrebare_id', '$raspuns_niciodata', '$punctaj_niciodata')";
        $db->query($sql);
    
        $sql = "INSERT INTO raspunsuri (intrebare_id, raspuns, punctaj) VALUES ('$intrebare_id', '$raspuns_uneori', '$punctaj_uneori')";
        $db->query($sql);
    
        $sql = "INSERT INTO raspunsuri (intrebare_id, raspuns, punctaj) VALUES ('$intrebare_id', '$raspuns_des', '$punctaj_des')";
        $db->query($sql);
    
        $sql = "INSERT INTO raspunsuri (intrebare_id, raspuns, punctaj) VALUES ('$intrebare_id', '$raspuns_foarte_des', '$punctaj_foarte_des')";
        $db->query($sql);
    }
    for($i = 1; $i <= 3; $i++) {
        $scor_start = $_POST['scor_start_'.$i];
        $scor_end = $_POST['scor_end_'.$i];
        $descriere_rezultat = $_POST['descriere_rezultat_'.$i];
        
     
        $sql = "INSERT INTO rezultate (test_id, scor_start, scor_end, descriere) VALUES ('$test_id', '$scor_start', '$scor_end', '$descriere_rezultat')";
        $db->query($sql);
    }


    $db->close();

    header("Location: teste.php");
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
        input[type="punctaj"][name^="punctaj"],
        label {
            float: left;
        }

        input[type="radio"],
        input[type="punctaj"][name^="punctaj"]:disabled {
            pointer-events: none;
        }

        input[type="punctaj"][name^="punctaj"] {
            width: 50px;
            margin-right: 10px;
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
        .form-row input[type="number"] {
        width:50px;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .form-row .inline-elements {
        display: inline-block;
    }

    </style>
</head>
<body>

<form class="addtest" method="POST" enctype="multipart/form-data">

    <h2 style="text-align: center;    margin-top:20px;">Adaugă un test nou:</h2>

    <div class="form-row">
        <label for="nume">Nume:</label>
        <input type="text" id="nume" name="nume" required>
    </div>

    <div class="form-row">
        <label for="descriere">Descriere:</label>
        <textarea id="descriere" name="descriere" required></textarea>
    </div>

    <div class="upload-form">
             <label for="imagine">Imagine:</label>
        <input type="file" id="imagine" name="imagine"  required>
     
    </div>

    <div class="form-row">
        <ol>
            <?php for ($i = 1; $i <= 10; $i++) { ?>
                <li>
                    <label for="intrebare_<?php echo $i; ?>">Intrebare <?php echo $i; ?>:</label>
                    <input type="text" id="intrebare_<?php echo $i; ?>" name="intrebare_<?php echo $i; ?>" required>
                    <br>
                    <label>Răspuns:</label>
                        <input type="radio" id="raspuns_<?php echo $i; ?>_1" name="raspuns_<?php echo $i; ?>_1">
                        <label for="raspuns_<?php echo $i; ?>_1">Niciodată</label> 
                        <input type="punctaj" id="punctaj_<?php echo $i; ?>_1" name="punctaj_<?php echo $i; ?>_1" required>
                        <input type="radio" id="raspuns_<?php echo $i; ?>_2" name="raspuns_<?php echo $i; ?>_2">
                        <label for="raspuns_<?php echo $i; ?>_2">Uneori</label>
                        <input type="punctaj" id="punctaj_<?php echo $i; ?>_2" name="punctaj_<?php echo $i; ?>_2" required>
                        <input type="radio" id="raspuns_<?php echo $i; ?>_3" name="raspuns_<?php echo $i; ?>_3">
                        <label for="raspuns_<?php echo $i; ?>_3">Des</label> 
                        <input type="punctaj" id="punctaj_<?php echo $i; ?>_3" name="punctaj_<?php echo $i; ?>_3" required>
                        <input type="radio" id="raspuns_<?php echo $i; ?>_4" name="raspuns_<?php echo $i; ?>_4">
                        <label for="raspuns_<?php echo $i; ?>_4">Foarte des</label> 
                        <input type="punctaj" id="punctaj_<?php echo $i; ?>_4" name="punctaj_<?php echo $i; ?>_4" required>

                    <br>
                   <br>
                </li>
            <?php } ?>
        </ol>
    </div>
   

    <div class="form-row">
        <label for="scor_start_1">Între <span class="inline-elements"><input type="number" id="scor_start_1" name="scor_start_1" required></span> și <span class="inline-elements"><input type="number" id="scor_end_1" name="scor_end_1" required></span> puncte:</label>
        <textarea id="descriere_rezultat_1" name="descriere_rezultat_1" required></textarea>
    </div>
    
    <div class="form-row">
        <label for="scor_start_2">Între <span class="inline-elements"><input type="number" id="scor_start_2" name="scor_start_2" required></span> și <span class="inline-elements"><input type="number" id="scor_end_2" name="scor_end_2" required></span> puncte:</label>
        <textarea id="descriere_rezultat_2" name="descriere_rezultat_2" required></textarea>
    </div>
    
    <div class="form-row">
        <label for="scor_start_3">Între <span class="inline-elements"><input type="number" id="scor_start_3" name="scor_start_3" required></span> și <span class="inline-elements"><input type="number" id="scor_end_3" name="scor_end_3" required></span> puncte:</label>
        <textarea id="descriere_rezultat_3" name="descriere_rezultat_3" required></textarea>
    </div>




    <div class="form-row">
        <button type="submit" name="save">Salvează</button>
        <button type="button" onclick="closeForm_buttons_account_consilier()" style="padding:10px;">Close</button>
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

</body>
</html>
