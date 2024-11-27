<?php
session_start();

include("navbar_initial.php");
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consiliere Studenți</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
  </head>
  <style>
    .error {
      color: red;
    }
    </style>
<body>

<div class="row1">
  <div class="column1">
    <form class="log-in-form" method="POST" action="login.php" id="loginForm">
      <h4 class="text-center"><b>Log in</b></h4>
      <label><b>Email</b>
        <input type="text" placeholder="email@yahoo.com" name="email" id="email">
      </label>
      <span class="error" id="emailError"></span>
      <label><b>Password</b>
        <input type="password" placeholder="Password" name="password" id="password">
      </label>
      <span class="error" id="passwordError"></span>
      <input id="show-password" type="checkbox" onchange="togglePasswordVisibility()"><label for="show-password">Show password</label>
      <p><button type="submit" class="button expanded" name="login">Log in</button></p>
      <p><a href="register_student.php" class="button expanded">Sign up</a></p>
    </form>
  </div>
  <div class="column1">
    <img src="images/3874157.jpg" style="max-width: 100%; height: 400px;">
  </div>
</div>

<?php
$db = mysqli_connect("127.0.0.1", "root", "");
mysqli_select_db($db, "webd");


if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * from utilizatori WHERE email = '$email'";
    $result = mysqli_query($db, $sql);


    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['parola'];
        $tip_utilizator = $row['tip_utilizator_id'];
        $user_id = $row['id'];
        if (password_verify($password, $storedPassword)) {
          if (password_verify($password, $storedPassword)) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['logged_in'] = true;
          switch ($tip_utilizator) {
              case "1":
              
                  header("Location: dash_students.php");
                  exit(); 
              case "2":
                 
                  header("Location: dash_consilieri.php");
                  exit(); 
              case "3":
             
                  header("Location: dash_admin.php");
                  exit(); 
              default:
                  echo "Tipul de utilizator nu este valid.";
          }
        } else {
            echo "Parola introdusă nu este corectă.";
        }
    } else {
        echo "Parolă sau email incorect.";
    }
}
}
?>

<script src="js/vendor/jquery.js"></script>
<script src="js/vendor/what-input.js"></script>
<script src="js/vendor/foundation.js"></script>
<script src="js/app.js"></script>
<script>

  function validateForm() {
    var emailInput = document.getElementById('email');
    var passwordInput = document.getElementById('password');
    var emailError = document.getElementById('emailError');
    var passwordError = document.getElementById('passwordError');


    emailError.textContent = '';
    passwordError.textContent = '';

  
    if (emailInput.value.trim() === '') {
      emailError.textContent = 'Please enter your email.';
      return false;
    }
    if (!emailInput.value.includes('@')) {
      emailError.textContent = 'Invalid email format.';
      return false;
    }


    if (passwordInput.value.trim() === '') {
      passwordError.textContent = 'Please enter your password.';
      return false;
    }

    return true;
  }


  function togglePasswordVisibility() {
    var passwordInput = document.getElementById('password');
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
    } else {
      passwordInput.type = 'password';
    }
  }


  var loginForm = document.getElementById('loginForm');
  loginForm.addEventListener('submit', function(event) {
    if (!validateForm()) {
      event.preventDefault();
    }
  });
</script>
</body>
</html>
