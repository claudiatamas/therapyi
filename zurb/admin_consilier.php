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
  <script>
    function closeForm_buttons_account_consilier() {

      window.close();

      window.location.href = "aprobare_consilier.php";
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
form input[type="specialitate"],
form input[type="nr_diploma"],
form input[type="descriere"] {
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
        <h2>Adaugă un consilier</h3>
          <form name="adaugare" id="adaugare" method="post" action="">
    
            <label style="text-align: left;"><b>Nume:</b></label>
            <input type="nume"  id="nume" placeholder="Last name"   name="nume">
            <p class="hide"><input type="text" name="mode" value="adaugare" ></p>
            <label style="text-align: left;"><b>Prenume:</b></label>
            <input type="prenume" id="prenume" placeholder="First name"  name="prenume" >
           <label style="text-align: left;"><b>Email:</b></label>
            <input type="email" id="email"   name="email" placeholder="email@yahoo.com" >
            <label style="text-align: left;"><b>Nr. telefon:</b></label>
            <input type="tel" id="telefon"  name="telefon" >
            <label style="text-align: left;"><b>Facultatea absolvită:</b></label>
            <input type="facultate"  id="facultate"   name="facultate">
            <label style="text-align: left;"><b>Specialitate:</b></label>
            <input type="specialitate" id="specialitate" name="specialitate">
            <label style="text-align: left;"><b>Număr diplomă:</b></label>
            <input type="nr_diploma" id="nr_diploma" name="nr_diploma">
            <label style="text-align: left;"><b>Descriere:</b></label>
            <input type="descriere" id="descriere"  id="descriere" name="descriere">
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
$nume = $prenume = $facultate = $telefon = $descriere = $email = $specialitate = $nr_diploma = "";

$mode="";

if (isset($_POST['mode']))
{
$mode = $_POST['mode'];
}

if ($mode == "adaugare") {

if ((empty($_POST["nume"]))&&(empty($_POST["prenume"]))&&(empty($_POST["email"]))&&(empty($_POST["telefon"]))&&(empty($_POST["facultate"]))&&(empty($_POST["specialitate"]))&&(empty($_POST["nr_diploma"]))&&(empty($_POST["descriere"]))&&(empty($_POST["parola"]))) {
    $nameErr = "Este necesar sa introduceti datele cerute!";
    echo $nameErr;
  } else {
    $nume = $_POST["nume"];
    $prenume = $_POST["prenume"];
    $email = $_POST["email"];
    $telefon = $_POST["telefon"];
    $facultate = $_POST["facultate"];
    $specialitate = $_POST["specialitate"];
    $nr_diploma = $_POST["nr_diploma"];
    $descriere = $_POST["descriere"];
    $parola = $_POST["parola"];

 
    $hashed_password = hash('sha256', $parola);
    
    $sqlUtilizatori = "INSERT INTO utilizatori (nume_utilizator, email, parola,tip_utilizator_id,tip_utilizator_meniu_id) VALUES ('$nume $prenume', '$email', '$hashed_password','2','5')";
    $resultUtilizatori = mysqli_query($db, $sqlUtilizatori);


    if (!$resultUtilizatori) {
        die('Eroare la inserarea în tabela "utilizatori": ' . mysqli_error($db));
    }

   
    $utilizatorId = mysqli_insert_id($db);


    $sqlStudent = "INSERT INTO consilier (nume, prenume, email, telefon, facultate, specialitate, nr_diploma,descriere, parola, utilizatori_id) VALUES ('$nume', '$prenume', '$email', '$telefon', '$facultate', '$specialitate', '$nr_diploma','$descriere', '$hashed_password', $utilizatorId)";
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
    





<script>
function openForm_create() {
  document.getElementById("myForm_view").style.display = "none";
  document.getElementById("myForm_update").style.display = "none";
  document.getElementById("myForm_delete").style.display = "none";
  document.getElementById("myForm_create").style.display = "block";
}

function openForm_view() {
  document.getElementById("myForm_create").style.display = "none";
  document.getElementById("myForm_update").style.display = "none";
  document.getElementById("myForm_delete").style.display = "none";
  document.getElementById("myForm_view").style.display = "block";
}

function openForm_update() {
  document.getElementById("myForm_create").style.display = "none";
  document.getElementById("myForm_view").style.display = "none";
  document.getElementById("myForm_delete").style.display = "none";
  document.getElementById("myForm_update").style.display = "block";
}

function openForm_delete() {
  document.getElementById("myForm_create").style.display = "none";
  document.getElementById("myForm_view").style.display = "none";
  document.getElementById("myForm_update").style.display = "none";
  document.getElementById("myForm_delete").style.display = "block";
}

function openForm() {
  document.getElementById("myForm_create").style.display = "none";
  document.getElementById("myForm_view").style.display = "none";
  document.getElementById("myForm_update").style.display = "none";
  document.getElementById("myForm_delete").style.display = "none";
  document.getElementById("crud_buttons").style.display = "block";
}


function openForm_workout_create() {
  document.getElementById("myForm_workout_view").style.display = "none";
  document.getElementById("myForm_workout_update").style.display = "none";
  document.getElementById("myForm_workout_delete").style.display = "none";
  document.getElementById("myForm_workout_create").style.display = "block";
}

function openForm_workout_view() {
  document.getElementById("myForm_workout_create").style.display = "none";
  document.getElementById("myForm_workout_update").style.display = "none";
  document.getElementById("myForm_workout_delete").style.display = "none";
  document.getElementById("myForm_workout_view").style.display = "block";
}

function openForm_workout_update() {
  document.getElementById("myForm_workout_create").style.display = "none";
  document.getElementById("myForm_workout_view").style.display = "none";
  document.getElementById("myForm_workout_delete").style.display = "none";
  document.getElementById("myForm_workout_update").style.display = "block";
}

function openForm_workout_delete() {
  document.getElementById("myForm_workout_create").style.display = "none";
  document.getElementById("myForm_workout_view").style.display = "none";
  document.getElementById("myForm_workout_update").style.display = "none";
  document.getElementById("myForm_workout_delete").style.display = "block";
}


function openForm_WORKOUT() {
  document.getElementById("myForm_workout_create").style.display = "none";
  document.getElementById("myForm_workout_view").style.display = "none";
  document.getElementById("myForm_workout_update").style.display = "none";
  document.getElementById("myForm_workout_delete").style.display = "none";
  document.getElementById("crud_buttons_workout").style.display = "block";
}

function openForm_schedule_create() {
  document.getElementById("myForm_schedule_view").style.display = "none";
  document.getElementById("myForm_schedule_update").style.display = "none";
  document.getElementById("myForm_schedule_delete").style.display = "none";
  document.getElementById("myForm_schedule_create").style.display = "block";
}

function openForm_schedule_view() {
  document.getElementById("myForm_schedule_create").style.display = "none";
  document.getElementById("myForm_schedule_update").style.display = "none";
  document.getElementById("myForm_schedule_delete").style.display = "none";
  document.getElementById("myForm_schedule_view").style.display = "block";
}

function openForm_schedule_update() {
  document.getElementById("myForm_schedule_create").style.display = "none";
  document.getElementById("myForm_schedule_view").style.display = "none";
  document.getElementById("myForm_schedule_delete").style.display = "none";
  document.getElementById("myForm_schedule_update").style.display = "block";
}

function openForm_schedule_delete() {
  document.getElementById("myForm_schedule_create").style.display = "none";
  document.getElementById("myForm_schedule_view").style.display = "none";
  document.getElementById("myForm_schedule_update").style.display = "none";
  document.getElementById("myForm_schedule_delete").style.display = "block";
}


function openForm_SCHEDULE() {
  document.getElementById("myForm_schedule_create").style.display = "none";
  document.getElementById("myForm_schedule_view").style.display = "none";
  document.getElementById("myForm_schedule_update").style.display = "none";
  document.getElementById("myForm_schedule_delete").style.display = "none";
  document.getElementById("crud_buttons_schedule").style.display = "block";
}


function openForm_account_create_user() {
  document.getElementById("myForm_account_view_user").style.display = "none";
  document.getElementById("myForm_account_update_user").style.display = "none";
  document.getElementById("myForm_account_delete_user").style.display = "none";
  document.getElementById("myForm_account_create_user").style.display = "block";
}

function openForm_account_view_user() {
  document.getElementById("myForm_account_create_user").style.display = "none";
  document.getElementById("myForm_account_update_user").style.display = "none";
  document.getElementById("myForm_account_delete_user").style.display = "none";
  document.getElementById("myForm_account_view_user").style.display = "block";
}

function openForm_account_update_user() {
  document.getElementById("myForm_account_create_user").style.display = "none";
  document.getElementById("myForm_account_view_user").style.display = "none";
  document.getElementById("myForm_account_delete_user").style.display = "none";
  document.getElementById("myForm_account_update_user").style.display = "block";
}

function openForm_account_delete_user() {
  document.getElementById("myForm_account_create_user").style.display = "none";
  document.getElementById("myForm_account_view_user").style.display = "none";
  document.getElementById("myForm_account_update_user").style.display = "none";
  document.getElementById("myForm_account_delete_user").style.display = "block";
}


function openForm_account_create_nutritionist() {
  document.getElementById("myForm_account_view_nutritionist").style.display = "none";
  document.getElementById("myForm_account_update_nutritionist").style.display = "none";
  document.getElementById("myForm_account_delete_nutritionist").style.display = "none";
  document.getElementById("myForm_account_create_nutritionist").style.display = "block";
}

function openForm_account_view_nutritionist() {
  document.getElementById("myForm_account_create_nutritionist").style.display = "none";
  document.getElementById("myForm_account_update_nutritionist").style.display = "none";
  document.getElementById("myForm_account_delete_nutritionist").style.display = "none";
  document.getElementById("myForm_account_view_nutritionist").style.display = "block";
}

function openForm_account_update_nutritionist() {
  document.getElementById("myForm_account_create_nutritionist").style.display = "none";
  document.getElementById("myForm_account_view_nutritionist").style.display = "none";
  document.getElementById("myForm_account_delete_nutritionist").style.display = "none";
  document.getElementById("myForm_account_update_nutritionist").style.display = "block";
}

function openForm_account_delete_nutritionist() {
  document.getElementById("myForm_account_create_nutritionist").style.display = "none";
  document.getElementById("myForm_account_view_nutritionist").style.display = "none";
  document.getElementById("myForm_account_update_nutritionist").style.display = "none";
  document.getElementById("myForm_account_delete_nutritionist").style.display = "block";
}


function openForm_ACCOUNT() {
  document.getElementById("myForm_account_create_user").style.display = "none";
  document.getElementById("myForm_account_view_user").style.display = "none";
  document.getElementById("myForm_account_update_user").style.display = "none";
  document.getElementById("myForm_account_delete_user").style.display = "none";
  document.getElementById("myForm_account_create_nutritionist").style.display = "none";
  document.getElementById("myForm_account_view_nutritionist").style.display = "none";
  document.getElementById("myForm_account_update_nutritionist").style.display = "none";
  document.getElementById("myForm_account_delete_nutritionist").style.display = "none";
  document.getElementById("myForm_account_delete_nutritionist").style.display = "none";
  document.getElementById("crud_buttons_user_account").style.display = "none";
  document.getElementById("crud_buttons_nutritionist_account").style.display = "none";
  document.getElementById("buttons_user_nutri_account").style.display = "block";
}


function openForm_user() {
  document.getElementById("myForm_account_create_user").style.display = "none";
  document.getElementById("myForm_account_view_user").style.display = "none";
  document.getElementById("myForm_account_update_user").style.display = "none";
  document.getElementById("myForm_account_delete_user").style.display = "none";
  document.getElementById("crud_buttons_user_account").style.display = "block";
}

function openForm_nutritionist() {
  document.getElementById("myForm_account_create_nutritionist").style.display = "none";
  document.getElementById("myForm_account_view_nutritionist").style.display = "none";
  document.getElementById("myForm_account_update_nutritionist").style.display = "none";
  document.getElementById("myForm_account_delete_nutritionist").style.display = "none";
  document.getElementById("crud_buttons_nutritionist_account").style.display = "block";
}


function closeForm() {
  document.getElementById("myForm_create").style.display = "none";
  document.getElementById("myForm_view").style.display = "none";
  document.getElementById("myForm_update").style.display = "none";
  document.getElementById("myForm_delete").style.display = "none";
  document.getElementById("crud_buttons").style.display = "none";
}

function closeForm_workout(){
  document.getElementById("myForm_workout_create").style.display = "none";
  document.getElementById("myForm_workout_view").style.display = "none";
  document.getElementById("myForm_workout_update").style.display = "none";
  document.getElementById("myForm_workout_delete").style.display = "none";
  document.getElementById("crud_buttons_workout").style.display = "none";
}

function closeForm_schedule(){
  document.getElementById("myForm_schedule_create").style.display = "none";
  document.getElementById("myForm_schedule_view").style.display = "none";
  document.getElementById("myForm_schedule_update").style.display = "none";
  document.getElementById("myForm_schedule_delete").style.display = "none";
  document.getElementById("crud_buttons_schedule").style.display = "none";
}

function closeForm_account(){
  document.getElementById("myForm_account_create_user").style.display = "none";
  document.getElementById("myForm_account_view_user").style.display = "none";
  document.getElementById("myForm_account_update_user").style.display = "none";
  document.getElementById("myForm_account_delete_user").style.display = "none";
  document.getElementById("crud_buttons_user_account").style.display = "none";


  document.getElementById("myForm_account_create_nutritionist").style.display = "none";
  document.getElementById("myForm_account_view_nutritionist").style.display = "none";
  document.getElementById("myForm_account_update_nutritionist").style.display = "none";
  document.getElementById("myForm_account_delete_nutritionist").style.display = "none";
  document.getElementById("crud_buttons_nutritionist_account").style.display = "none";

  document.getElementById("buttons_user_nutri_account").style.display = "none";
}

function closeForm_buttons() {
  document.getElementById("myForm_create").style.display = "none";
  document.getElementById("myForm_view").style.display = "none";
  document.getElementById("myForm_update").style.display = "none";
  document.getElementById("myForm_delete").style.display = "none";
}

function closeForm_buttons_workout(){
  document.getElementById("myForm_workout_create").style.display = "none";
  document.getElementById("myForm_workout_view").style.display = "none";
  document.getElementById("myForm_workout_update").style.display = "none";
  document.getElementById("myForm_workout_delete").style.display = "none";
}

function closeForm_buttons_schedule(){
  document.getElementById("myForm_schedule_create").style.display = "none";
  document.getElementById("myForm_schedule_view").style.display = "none";
  document.getElementById("myForm_schedule_update").style.display = "none";
  document.getElementById("myForm_schedule_delete").style.display = "none";
}

function closeForm_buttons_account_user(){
  document.getElementById("myForm_account_create_user").style.display = "none";
  document.getElementById("myForm_account_view_user").style.display = "none";
  document.getElementById("myForm_account_update_user").style.display = "none";
  document.getElementById("myForm_account_delete_user").style.display = "none";

}

function closeForm_buttons_account_nutritionist(){
  document.getElementById("myForm_account_create_nutritionist").style.display = "none";
  document.getElementById("myForm_account_view_nutritionist").style.display = "none";
  document.getElementById("myForm_account_update_nutritionist").style.display = "none";
  document.getElementById("myForm_account_delete_nutritionist").style.display = "none";
}

function closeForm_special() {
  document.getElementById("myForm_account_create_nutritionist").style.display = "none";
  document.getElementById("myForm_account_view_nutritionist").style.display = "none";
  document.getElementById("myForm_account_update_nutritionist").style.display = "none";
  document.getElementById("myForm_account_delete_nutritionist").style.display = "none";
  document.getElementById("myForm_account_create_user").style.display = "none";
  document.getElementById("myForm_account_view_user").style.display = "none";
  document.getElementById("myForm_account_update_user").style.display = "none";
  document.getElementById("myForm_account_delete_user").style.display = "none";
  document.getElementById("crud_buttons_user_account").style.display = "none";
  document.getElementById("crud_buttons_nutritionist_account").style.display = "none";
}

function closeForm_account_user_special() {
  document.getElementById("myForm_account_create_user").style.display = "none";
  document.getElementById("myForm_account_view_user").style.display = "none";
  document.getElementById("myForm_account_update_user").style.display = "none";
  document.getElementById("myForm_account_delete_user").style.display = "none";
  document.getElementById("crud_buttons_user_account").style.display = "none";
}

function closeForm_account_nutritionist_special() {
  document.getElementById("myForm_account_create_nutritionist").style.display = "none";
  document.getElementById("myForm_account_view_nutritionist").style.display = "none";
  document.getElementById("myForm_account_update_nutritionist").style.display = "none";
  document.getElementById("myForm_account_delete_nutritionist").style.display = "none";
  document.getElementById("crud_buttons_nutritionist_account").style.display = "none";
}

</script>



    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
  
  </body>
</html>
