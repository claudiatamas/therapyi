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
  </style>


<div class="grid-container">
    <div class="grid-x grid-padding-x">
      <div class="large-12 cell">
        <h2>Aprobare conturi studenți</h3>
          <a href="admin_student.php" class="button"><i class="fa fa-plus"></i></a>
          <form class="form-search">
            <input type="text" placeholder="Search..."  class="search-bar"> 
            <button type="button" class="button-search"><i class="fa fa-search" style="color: black;"></i></button>
          </form>
          <?php
$db = mysqli_connect("127.0.0.1", "root", "");
mysqli_select_db($db, "webd");

$name = $email = "";
$start = 0;
$limit = 20;
$id = 1;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $start = ($id - 1) * $limit;
}

$sqlv = "SELECT * FROM student LIMIT $start, $limit";
$resultv = mysqli_query($db, $sqlv);
if (!$resultv)
    die('Invalid query:' . mysqli_error($db));
else {
    echo "<table class=\"unstriped\">";
    echo "  <thead><tr><th width=\"50\"><b>Id</b></th><th width=\"100\"><b>Nume</b></th><th width=\"100\"><b>Prenume</b></th><th width=\"150\"><b>Email</b></th><th width=\"100\"><b>Nr. telefon</b></th><th width=\"150\"><b>Facultate</b></th><th width=\"150\"><b>Specializare</b></th><th width=\"100\"><b>Nr. matricol</b></th><th width=\"50\"></th><th width=\"50\"></th></tr></thead> <tbody>";
    while ($myrow = mysqli_fetch_array($resultv, MYSQLI_ASSOC)) {
        echo "<tr><td>";
        echo $myrow["id"];
        echo "</td><td>";
        echo $myrow["nume"];
        echo "</td><td>";
        echo $myrow["prenume"];
        echo "</td><td>";
        echo $myrow["email"];
        echo "</td><td>";
        echo $myrow["telefon"];
        echo "</td><td>";
        echo $myrow["facultate"];
        echo "</td><td>";
        echo $myrow["specializare"];
        echo "</td><td>";
        echo $myrow["nr_matricol"];
        echo "</td>";
        echo '</td><td><button onclick="openEditWindow(' . $myrow["id"] . ')"><i class="fa fa-pen" style="cursor:pointer;color:#4CAF50;"></i></button></td>';
        echo '<td><button onclick="confirmDelete(' . $myrow["id"] . ')"><i class="fa fa-trash" style="color:red;cursor:pointer;"></i></button></td>';
        
        echo "</tr>";
    }
    echo " </tbody></table>";

   
}
?>
<script>
  var selectedUserId;

  function openEditWindow(userId) {

    selectedUserId = userId;


    window.location.href = "edit_user.php?selectedUserId=" + selectedUserId;


  }

  function confirmDelete(userId) {
    var confirmDelete = confirm("Sunteți sigur că doriți să ștergeți utilizatorul cu ID-ul " + userId + "?");

    if (confirmDelete) {
     
      selectedUserId = userId;

   
      window.location.href = "delete_user.php?id=" + selectedUserId;
    }
  }
</script>



<script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
  
</body>
</html>