<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $db = mysqli_connect("127.0.0.1", "root", "", "webbd");
  mysqli_select_db($db,"webd");

  if (!$db) {
    die("Conexiunea la baza de date a eșuat: " . mysqli_connect_error());
  }

 
  $nume = $_POST["nume"];
  $prenume = $_POST["prenume"];
  $email = $_POST["email"];
  $telefon = $_POST["telefon"];
  $facultate = $_POST["facultate"];
  $specialitate = $_POST["specialitate"];
  $nr_diploma = $_POST["nr_diploma"];
  $descriere = $_POST["descriere"];
  $parola = $_POST["password"];
  $parola_repetata = $_POST["password-repeat"];


  if ($parola !== $parola_repetata) {
    echo "Parolele introduse nu coincid.";
    exit(); 
  }
 
   $email_query = "SELECT * FROM utilizatori WHERE email = '$email'";
   $email_result = mysqli_query($db, $email_query);
   if (mysqli_num_rows($email_result) > 0) {
     echo "Adresa de email există deja. Vă rugăm să utilizați o altă adresă de email.";
     exit();
   }
 
  $hashed_password = password_hash($parola, PASSWORD_DEFAULT);
  $sql_utilizator = "INSERT INTO utilizatori (nume_utilizator, email, parola, tip_utilizator_id,tip_utilizator_meniu_id) VALUES ('$nume', '$email', '$hashed_password', '2','5')";

  if (mysqli_query($db, $sql_utilizator)) {
   
    $utilizator_id = mysqli_insert_id($db);

    $sql_consilier = "INSERT INTO consilier  (utilizatori_id, nume, prenume, email, telefon, facultate, specialitate, nr_diploma,descriere, parola) VALUES ('$utilizator_id','$nume', '$prenume', '$email', '$telefon', '$facultate', '$specialitate', '$nr_diploma','$descriere', '$hashed_password')";

if (mysqli_query($db, $sql_consilier)) {

  header("Location: login.php");
  exit();
} else {
  echo "A apărut o eroare. Vă rugăm să încercați din nou.";
}
} else {
echo "A apărut o eroare. Vă rugăm să încercați din nou.";
}


mysqli_close($db);
}
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consiliere Studenți - Înregistrare Student</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
  </head>
  <style>
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
      background-color: #F1F2F3;
    }
    .container {
      max-width: 700px;
      margin: 0 auto;
      padding: 20px;
      background-color: white;
      border-radius: 5px;
    }

    .button-group {
      text-align: center;
      margin-bottom: 20px;
    }
 
    .button {
      margin-right: 10px;

    }

    .log-in-form {
      text-align: center;
      display: grid;
      grid-template-columns: 1fr 1fr;
      grid-gap: 10px;
    }

    .log-in-form label {
      display: block;
      margin-bottom: 5px;
      text-align: left;
    }

    .button.active {
      background-color: #8441E2;
      color: white;
    }
    .text-center{
        text-align: center;
    }
 
    .log-in-form input[type="text"],
    .log-in-form input[type="email"],
    .log-in-form input[type="telefon"],
    .log-in-form input[type="facultate"],
    .log-in-form input[type="specialitate"],
    .log-in-form input[type="nrmatricol"],
    .log-in-form input[type="password"] {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .log-in-form button {
      margin-top: 10px;
    }
  </style>
  <body>
  <div class="back-arrow">
    <a href="login.php"><i class="fa fa-arrow-left" style="color:black"></i></a>
  </div>
  <br>
    <div class="row">
      <div class="column small-centered">
        <div class="button-group">
          <a href="register_student.php" class="button">Student</a>
          <a href="register_consilier.php" class="button active">Consilier</a>
        </div>

        <div class="container">
          <form class="log-in-form" method="POST">
            <h4 class="text-center"><b>Counselor Registration</b></h4>
          <br>
            <div>
              <label><b>Nume</b></label>
              <input type="text" name="nume" required>
            </div>

            <div>
              <label><b>Prenume</b></label>
              <input type="text" name="prenume" required>
            </div>

            <div>
              <label><b>Email</b></label>
              <input type="email" placeholder="email@example.com" name="email" required>
            </div>

            <div>
              <label><b>Nr. telefon</b></label>
              <input type="telefon" name="telefon" required>
            </div>

            <div>
              <label><b>Facultate</b></label>
              <input type="facultate" name="facultate" required>
            </div>

            <div>
              <label><b>Specialitate</b></label>
              <input type="specialitate" name="specialitate" required>
            </div>

            <div>
              <label><b>Nr. diplomă</b></label>
              <input type="nrmatricol" name="nr_diploma" required>
            </div>

            <div>
              <label><b>Descriere</b></label>
              <input type="nrmatricol" name="descriere" >
            </div>

            <div>
              <label><b>Parolă</b></label>
              <input type="password" placeholder="Password" name="password" required>
            </div>

            <div>
              <label for="psw-repeat"><b>Repetă parola</b></label>
              <input type="password" placeholder="Repeat Password" name="password-repeat" required>
            </div>
           

            <button type="submit" class="button expanded">Register as Counselor</button>
          </form>
        </div>
      </div>
    </div>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
