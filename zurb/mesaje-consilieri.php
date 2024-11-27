<?php
ob_start();
session_start();
// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
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
  </head>
<body>
 

      <div class="container-messages">
        <div class="people-list">
          <ul class="list">
            <li class="person active">
              <div class="user-image"><img src="https://www.marketingtool.online/en/face-generator/img/faces/avatar-115737a167c66398726bc20d6ca091b4.jpg" class="chat-bubble"></div>
              <div class="user-info">
                <span class="username">Adina Tomulescu</span>
              </div>
            </li>
            <li class="person">
              <div class="user-image"><img src="images/Alex.jpg" class="chat-bubble"></div>
              <div class="user-info">
                <span class="username">Alex Moșescu</span>
              </div>
            </li>
            <li class="person">
              <div class="user-image"><img src="images/Andreea.jpg" class="chat-bubble"></div>
              <div class="user-info">
                <span class="username">Andreea Mateaș</span>
              </div>
            </li>
          </ul>
        </div>
        <div class="chat">
          <button type="button" class="video-call"><i class="fas fa-phone"></i></button>
          <button type="button" class="video-call"><i class="fas fa-video"></i></button>
          <ul class="chat-list">
            <li class="chat-message">
              <div class="chat-bubble">
                <p>Bună ziua! Cum te mai simți?</p>
                <span class="timestamp">12:30 PM</span>
              </div>
            </li>
            <li class="chat-message-from-me">
              <div class="chat-bubble">
                <p>Bună ziua! Mă simt mai bine, mulțumesc!</p>
                <span class="timestamp">12:31 PM</span>
              </div>
            </li>
            <li class="chat-message">
              <div class="chat-bubble">
                <p>Pe când dorești să programăm următoarea întâlnire?</p>
                <span class="timestamp">12:32 PM</span>
              </div>
            </li>
            <li class="chat-message-from-me">
              <div class="chat-bubble">
                <p>Miercuri după ora 16 dacă puteți și dumneavoastră.</p>
                <span class="timestamp">12:33 PM</span>
              </div>
            </li>
          </ul>
          <div class="chat-input">
            <input type="text" placeholder="Type your message here...">
            <button type="button" class="send-button">Send</button>
          </div>
        </div>
      </div>





    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
  
  </body>
</html>