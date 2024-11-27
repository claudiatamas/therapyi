<?php
ob_start();
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {

    header("Location: login.php");
    exit();
}

  include("navbar_student.php");
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
    



<div class="hero-section">
  <div class="hero-section-text">
    <h1>THERAPYi for College Students</h1>
    <h5>Consiliere gratuită pentru tinerii studenți</h5>
    <a href="login.php" class=" button" style="text-transform: uppercase;">learn more</a>
  </div>
</div>



<div class="callout primary">
  <h5>Verifică-ți nivelul de stres, depresie sau anxietate cu ajutorul următoarelor quiz-uri destinate studenților!</h5>
  <a href="consilieri.html">Dacă ai nevoie să vorbești cu cineva, apasă aici!</a>
</div>
<br>
<br>
<div class="grid-container">
  <div class="grid-x grid-margin-x small-up-2 medium-up-3">
    <div class="cell">
      <div class="card">
        <img src="images/stres.jpg">
        <div class="card-section">
        <h4>Test - Stres</h4>
          <p style="text-align: justify;">Viața studenților este plină de provocări și surprize, cea mai des întâlnită fiind stresul. Componentă inevitabilă a vieții cotidiene, stresul nu „discriminează” pe nimeni, indiferent de vârstă, ocupație sau opinie.</p>
          <a href="quiz.html"> <button type="button" class="button">Start quiz</button></li></a>
        </div>
      </div>
    </div>
    <div class="cell">
      <div class="card">
        <img src="images/depresie.jpg">
        <div class="card-section">
          <h4>Test - Depresie</h4>
          <p style="text-align: justify;">Mai mulți studenți se confruntă cu depresie decât au făcut-o acum un deceniu, odată cu diagnosticarea mai mare a depresiei, a apărut o creștere legată a numărului de studenți la medicamente psihiatrice. </p>
          <a href="quiz.html"> <button type="button" class="button">Start quiz</button></li></a>
        </div>
      </div>
    </div>
    <div class="cell">
      <div class="card">
        <img src="images/anxiety.jpg">
        <div class="card-section">
          <h4>Test - Anxietate</h4>
          <p style="text-align: justify;">Anxietatea crește dacă cauza anxietății e evitată sau amânată. Neliniștea și teama nu dispar dacă le ocolim sau acoperim.  Studiile arată că peste 60% dintre studenți se confruntă cu anxietatea.</p>
          <a href="quiz.html"> <button type="button" class="button">Start quiz</button></li></a>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
<br>
<br>
<div class="row">
  <div class="columns">
    <div class="orbit" role="region" aria-label="Favorite Text Ever" data-orbit>
      <ul class="orbit-container">
        <button class="orbit-previous" aria-label="previous"><span class="show-for-sr">Previous Slide</span>&#9664;</button>
        <button class="orbit-next" aria-label="next"><span class="show-for-sr">Next Slide</span>&#9654;</button>
        <li class="is-active orbit-slide">
          <div class="docs-example-orbit-slide">
            <p><Strong>Stresul </Strong>  poate deveni o problemă importantă la orice vârstă, deoarece suntem expuși în fața acestuia zilnic. Astfel, pentru a ne menține pe linia de plutire, trebuie să ne adaptăm și să încercăm diferite metode de a îi face față. Metodele există în număr mare și sunt diverse, astfel, le putem personaliza și le putem adapta nevoilor noastre proprii.</p>
          </div>
        </li>
        <li class="orbit-slide">
          <div class="docs-example-orbit-slide">
            <p>Adaptarea la facultate poate fi o provocare care poate lua mulți studenți și familiile lor prin surprindere. Navigarea cu succes prin responsabilitățile asemănatoare adulților, creșterea stresului academic și presiunea socială necesită maturitate cognitivă și abilități de viață pe care mulți din această grupă de vârstă încă nu le stăpanesc extrem de bine.</p>
          </div>
        </li>
        <li class="orbit-slide">
          <div class="docs-example-orbit-slide">
            <p>Universitățile raportează un numar tot mai mare de studenți care solicită ajutor la centrele de consiliere ale facultăților, uneori ajungându-se chiar până la suprasolicitarea acestor servicii și la imposibilitatea de a putea lua sub observație toate cererile. De aceea, suntem aici pentru voi ca să vă ajutăm să treceți peste această etapa din viața voastră</p>
          </div>
        </li>
        <li class="orbit-slide">
          <div class="docs-example-orbit-slide">
            <p><strong>Anxietatea</strong> este un răspuns firesc al corpului la stres. Când lumea ta exterioară se modifică brusc, deși asta îți doreai, va dura să te adaptezi noului mediu și cerințelor sale. Așa că anxietatea te poate însoți în perioada de adaptare și aceasta poate dura ceva vreme. Alege să discuți cu cineva despre asta!</p>
          </div>
        </li>
      </ul>
      <nav class="orbit-bullets">
        <button class="is-active" data-slide="0"><span class="show-for-sr">First slide details.</span><span class="show-for-sr">Current Slide</span></button>
        <button data-slide="1"><span class="show-for-sr">Second slide details.</span></button>
        <button data-slide="2"><span class="show-for-sr">Third slide details.</span></button>
        <button data-slide="3"><span class="show-for-sr">Fourth slide details.</span></button>
      </nav>
    </div>
  </div>
</div>
<br>


<div class="media-object">
  <div class="media-object-section">
    <div class="thumbnail">
      <img src="https://www.marketingtool.online/en/face-generator/img/faces/avatar-115737a167c66398726bc20d6ca091b4.jpg" width="170px">
    </div>
  </div>
  <div class="media-object-section">
    <h4>Adina Tomulescu</h4>
    <a href="#" style="color:black;"> <i class="fas fa-phone" style="color:black;"></i> +40747329531 </a>
    <p>„Viața este un drum anevoios, însă putem alege să facem un pas spre propria persoană. Putem să împărtășim greutatea care ne apasă. O durere împărtășită este pe jumătate mai ușoară.“</p>
    <button class="button">
      <i class="fa fa-heart"></i>
      <span>Book</span>
    </button>
  </div>
</div>
<div class="media-object">
  <div class="media-object-section">
    <div class="thumbnail">
      <img src="images/Alex.jpg" width="170px">
    </div>
  </div>
  <div class="media-object-section">
    <h4>Alex Moșescu</h4>
    <a href="#" style="color:black;"> <i class="fas fa-phone" style="color:black;"></i> +40720385174</a>
    <p>„În relația terapeutică pe care o co-construim identificăm semnificații multiple și opțiuni pentru gestionarea diferitelor situații de viață cu care te confrunți.“</p>
    <button class="button">
      <i class="fa fa-heart"></i>
      <span>Book</span>
    </button>
  </div>
</div>
<div class="media-object">
  <div class="media-object-section">
    <div class="thumbnail">
      <img src="images/Ciprian.jpg" width="170px">
    </div>
  </div>
  <div class="media-object-section">
    <h4>Ciprian Pop</h4>
    <a href="#" style="color:black;"> <i class="fas fa-phone" style="color:black;"></i> +40728143967</a>
    <p>”Investesc răbdare şi mă dedic pentru a construi relaţia terapeutică, conexiunea dintre terapeut şi client, o relaţie care vindeca!”</p>
    <button class="button">
      <i class="fa fa-heart"></i>
      <span>Book</span>
    </button>
  </div>
</div>
<div class="media-object">
  <div class="media-object-section">
    <div class="thumbnail">
      <img src="images/Andreea.jpg" width="170px">
    </div>
  </div>
  <div class="media-object-section">
    <h4>Andreea Mateaș</h4>
    <a href="#" style="color:black;"> <i class="fas fa-phone" style="color:black;"></i> +40756825891</a>
    <p>”Terapia este o altfel de relație interpersonală. O relație centrată pe pacient, pe modul în care acesta intră în relație. Rolul meu este să creez mediul în care să te desfășori.”</p>
    <button class="button">
      <i class="fa fa-heart"></i>
      <span>Book</span>
    </button>
  </div>

 
  
</div>
<section class="footer">

  <div class="box-container">

     <div class="box">
      <br>
        <h3>quick links</h3>
        <a href="dash_students.html"> <i class="fas fa-angle-right"></i> Acasă</a>
        <a href="quiz.html"> <i class="fas fa-angle-right"></i> Teste</a>
        <a href="consilieri.html"> <i class="fas fa-angle-right"></i> Consilieri</a>
     </div>

     <div class="box">
      <br>
        <h3>extra links</h3>
        <a href="about.html"> <i class="fas fa-angle-right"></i> about </a>
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