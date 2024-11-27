<?php
ob_start();
session_start();
// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    // Redirect to the login page if not logged in
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
  <script>
    function closeForm_buttons_account_consilier() {
      // Închide fereastra curentă
      window.close();

      // Redirecționează către pagina "aprobare_studenti.php"
      window.location.href = "aprobare_studenti.php";
    }
    </script>
<body>


<style>

    @media only screen and (max-width: 768px) {
      table {
        font-size: 14px;
      }
      button {
        font-size: 12px;
      }
    }
    @media only screen and (max-width: 480px) {
      table {
        font-size: 12px;
      }
      th, td {
        padding: 5px;
      }
      button {
        font-size: 10px;
        padding: 3px 6px;
      }
    }
    /* Style for form label */
form label {
  display: block;
  margin-bottom: 5px;
}

/* Style for form input fields */
form input[type="nume"],
form input[type="prenume"],
form input[type="email"],
form input[type="tel"],
form input[type="facultate"],
form input[type="specializare"],
form input[type="matricol"] {
  display: block;
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-bottom: 10px;
}

/* Style for form submit buttons */
form button[type="submit"],
form button[type="button"] {
  background-color: #4CAF50;
  color: white;
  padding: 8px 16px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-right: 10px;
}

/* Style for success button */
form button.success[type="submit"] {
  background-color: #4CAF50;
}

/* Style for close button */
form button.success[type="button"] {
  background-color: #aaaaaa;
}

/* Style for form errors */
form .error {
  color: red;
}

/* Style for form heading */
form h2 {
  margin-top: 0;
}

/* Style for form container */
form .grid-container {
  margin-top: 20px;
}

/* Style for form button container */
form .button-container {
  text-align: right;
  margin-top: 20px;
}

/* Style for small screens */
@media only screen and (max-width: 768px) {
  form table {
    font-size: 14px;
  }
  form button[type="submit"] {
    font-size: 12px;
  }
}

@media only screen and (max-width: 480px) {
  form table {
    font-size: 12px;
  }
  form th, form td {
    padding: 5px;
  }
  form button[type="submit"],
  form button[type="button"] {
    font-size: 10px;
    padding: 3px 6px;
  }
}

  </style>

<div class="grid-container">
    <div class="grid-x grid-padding-x">
      <div class="large-12 cell">
        <h2>Adaugă un student</h3>
          <form name="adaugare" id="adaugare" method="post" action="">
    
            <label style="text-align: left;"><b>Nume:</b></label>
            <input type="text"  id="nume" placeholder="Last name"   name="nume">
            <p class="hide"><input type="text" name="mode" value="adaugare" ></p>
            <label style="text-align: left;"><b>Prenume:</b></label>
            <input type="text" id="prenume" placeholder="First name"  name="prenume" >
           <label style="text-align: left;"><b>Email:</b></label>
            <input type="email" id="email"   name="email" placeholder="email@yahoo.com" >
            <label style="text-align: left;"><b>Nr. telefon:</b></label>
            <input type="tel" id="telefon"  name="telefon" >
            <label style="text-align: left;"><b>Facultate:</b></label>
            <input type="text"  id="facultate"   name="facultate">
            <label style="text-align: left;"><b>Specializare:</b></label>
            <input type="text" id="specializare" name="specializare">
            <label style="text-align: left;"><b>Număr matricol:</b></label>
            <input type="text" id="matricol" name="nr_matricol">
            <label style="text-align: left;"><b>Parolă:</b></label>
            <input type="password" id="parola" name="parola">
          
<br>
      <div >
         <button type="submit" class="button success" name="submit" >Add</button>
         <button type="button" class="button success" onclick="closeForm_buttons_account_consilier()">Close</button>
      </div> 
           </form>
      </div>
    </div>

</div>
<br>
<?php
$db=mysqli_connect("127.0.0.1","root","");
mysqli_select_db($db,"webd");
$nume = $prenume = $facultate = $telefon = $specializare = $nr_matricol = $email = "";

$mode="";

if (isset($_POST['mode']))
{
$mode = $_POST['mode'];
}

if ($mode == "adaugare") {

if ((empty($_POST["nume"]))&&(empty($_POST["prenume"]))&&(empty($_POST["email"]))&&(empty($_POST["telefon"]))&&(empty($_POST["facultate"]))&& (empty($_POST["specializare"]))&&(empty($_POST["nr_matricol"]))&&(empty($_POST["parola"]))) {
    $nameErr = "Este necesar sa introduceti datele cerute!";
    echo $nameErr;
  } else {
    $nume = $_POST["nume"];
    $prenume = $_POST["prenume"];
    $email = $_POST["email"];
    $telefon = $_POST["telefon"];
    $facultate = $_POST["facultate"];
    $specializare = $_POST["specializare"];
    $nr_matricol = $_POST["nr_matricol"];
    $parola = $_POST["parola"];


    $hashed_password = hash('sha256', $parola);
    
    $sqlUtilizatori = "INSERT INTO utilizatori (nume_utilizator, email, parola,tip_utilizator_id,tip_utilizator_meniu_id) VALUES ('$nume $prenume', '$email', '$hashed_password','1','4')";
    $resultUtilizatori = mysqli_query($db, $sqlUtilizatori);


    if (!$resultUtilizatori) {
        die('Eroare la inserarea în tabela "utilizatori": ' . mysqli_error($db));
    }


    $utilizatorId = mysqli_insert_id($db);


    $sqlStudent = "INSERT INTO student (nume, prenume, email, telefon, facultate, specializare, nr_matricol, parola, utilizatori_id) VALUES ('$nume', '$prenume', '$email', '$telefon', '$facultate', '$specializare', '$nr_matricol', '$hashed_password', $utilizatorId)";
    $resultStudent = mysqli_query($db, $sqlStudent);

    
    if (!$resultStudent) {
        die('Eroare la inserarea în tabela "student": ' . mysqli_error($db));
    }

echo "</br>";

$results= mysqli_query($db,$sql);
if (!$results)
 die('Invalid querry:' .mysqli_error($db));
 else 
 {
  echo "Inregistrarea a fost adaugata.</br>";
 }
}
}
?>




    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
  
  </body>
</html>
