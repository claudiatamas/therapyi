<?php
ob_start();
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
   
    header("Location: login.php");
    exit();
}

?>

<!doctype html>
<html>
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
  
  <div class="quiz-container">
    <div class="start-container">
      <button id="start-btn">Start Quiz</button>
    </div>

    <div class="question-container">
      <h2>1. Ai probleme în a rămâne concentrat pe momentul prezent?</h2>
      <form>
        <label>
          <input type="radio" name="q1" value="a">
          Niciodată
        </label>
        <br>
        <label>
          <input type="radio" name="q1" value="b">
          Uneori
        </label>
        <br>
        <label>
          <input type="radio" name="q1" value="c">
          Des
        </label>
        <br>
        <label>
          <input type="radio" name="q1" value="d">
          Foarte des
        </label>
      </form>
   
      <button class="next-btn">Next</button>
    
    </div>

    <div class="question-container">
      <h2>2. Cât de des te simți copleșit de viața ta?</h2>
      <form>
        <label>
          <input type="radio" name="q2" value="a">
          Niciodată
        </label>
        <br>
        <label>
          <input type="radio" name="q2" value="b">
          Uneori
        </label>
        <br>
        <label>
          <input type="radio" name="q2" value="c">
          Des
        </label>
        <br>
        <label>
          <input type="radio" name="q2" value="d">
          Foarte des
        </label>
      </form>
      <button class="next-btn">Next</button>
      <button class="prev-btn">Prev</button>
    </div>

    <div class="question-container">
      <h2>3. Ai dificultăți în a adormi noaptea?</h2>
      <form>
        <label>
          <input type="radio" name="q3" value="a">
          Niciodată
        </label>
        <br>
        <label>
          <input type="radio" name="q3" value="b">
          Uneori
        </label>
        <br>
        <label>
          <input type="radio" name="q3" value="c">
          Des
        </label>
        <br>
        <label>
          <input type="radio" name="q3" value="d">
          Foarte des
        </label>
      </form>
      <button class="next-btn">Next</button>
      <button class="prev-btn">Prev</button>
    </div>
    <div class="question-container">
      <h2>4. În mod obișnuit, dormi mai puțin de 7-8 ore pe noapte?</h2>
      <form>
        <label>
          <input type="radio" name="q4" value="a">
          Niciodată
        </label>
        <br>
        <label>
          <input type="radio" name="q4" value="b">
          Uneori
        </label>
        <br>
        <label>
          <input type="radio" name="q4" value="c">
          Des
        </label>
        <br>
        <label>
          <input type="radio" name="q4" value="d">
          Foarte des
        </label>
     
      </form>
      <button class="next-btn">Next</button>
      <button class="prev-btn">Prev</button>
    </div>
    <div class="question-container">
      <h2>5. Recurgi la alimentația nesănătoasă, cum ar fi consumul de alimente fast-food, consumul excesiv de băuturi alcoolice sau de alimente bogate în zahăr, atunci când te simți copleșit?</h2>
      <form>
        <label>
          <input type="radio" name="q5" value="a">
          Niciodată
        </label>
        <br>
        <label>
          <input type="radio" name="q5" value="b">
          Uneori
        </label>
        <br>
        <label>
          <input type="radio" name="q5" value="c">
          Des
        </label>
        <br>
        <label>
          <input type="radio" name="q5" value="d">
          Foarte des
        </label>
      </form>
      <button class="next-btn">Next</button>
      <button class="prev-btn">Prev</button>
    </div>
    <div class="question-container">
      <h2>6. Ai dureri de cap sau tensiune musculară?</h2>
      <form>
        <label>
          <input type="radio" name="q6" value="a">
          Niciodată
        </label>
        <br>
        <label>
          <input type="radio" name="q6" value="b">
          Uneori
        </label>
        <br>
        <label>
          <input type="radio" name="q6" value="c">
          Des
        </label>
        <br>
        <label>
          <input type="radio" name="q6" value="d">
          Foarte des
        </label>
      </form>
      <button class="next-btn">Next</button>
      <button class="prev-btn">Prev</button>
    </div>
    <div class="question-container">
      <h2>7. În timpul orelor de studiu, ai probleme în a rămâne concentrat și concentrat pe sarcina de lucru?</h2>
      <form>
        <label>
          <input type="radio" name="q7" value="a">
          Niciodată
        </label>
        <br>
        <label>
          <input type="radio" name="q7" value="b">
          Uneori
        </label>
        <br>
        <label>
          <input type="radio" name="q7" value="c">
          Des
        </label>
        <br>
        <label>
          <input type="radio" name="q7" value="d">
          Foarte des
        </label>
      </form>
      <button class="next-btn">Next</button>
      <button class="prev-btn">Prev</button>
    </div>
    <div class="question-container">
      <h2>8. Simți dureri sau tensiune în stomac, mușchi, piept sau cap?</h2>
      <form>
        <label>
          <input type="radio" name="q8" value="a">
          Niciodată
        </label>
        <br>
        <label>
          <input type="radio" name="q8" value="b">
          Uneori
        </label>
        <br>
        <label>
          <input type="radio" name="q8" value="c">
          Des
        </label>
        <br>
        <label>
          <input type="radio" name="q8" value="d">
          Foarte des
        </label>
      </form>
      <button class="next-btn">Next</button>
      <button class="prev-btn">Prev</button>
    </div>
    <div class="question-container">
      <h2>9. Simțiți iritare, enervare sau furie din cauza problemelor minore?</h2>
      <form>
        <label>
          <input type="radio" name="q9" value="a">
          Niciodată
        </label>
        <br>
        <label>
          <input type="radio" name="q9" value="b">
          Uneori
        </label>
        <br>
        <label>
          <input type="radio" name="q9" value="c">
          Des
        </label>
        <br>
        <label>
          <input type="radio" name="q9" value="d">
          Foarte des
        </label>
      </form>
      <button class="next-btn">Next</button>
      <button class="prev-btn">Prev</button>
    </div>
    <div class="question-container">
      <h2>10. Simți nevoia de a te retrage din familie, prieteni și de a te izola?</h2>
      <form>
        <label>
          <input type="radio" name="q10" value="a">
          Niciodată
        </label>
        <br>
        <label>
          <input type="radio" name="q10" value="b">
          Uneori
        </label>
        <br>
        <label>
          <input type="radio" name="q10" value="c">
          Des
        </label>
        <br>
        <label>
          <input type="radio" name="q10" value="d">
          Foarte des
        </label>
      </form>
      <button class="prev-btn">Prev</button>
      <button class="submit-btn">Submit</button>
    </div>


    <div class="result-container" style="display:none;">
      <h2>Quiz Result</h2>
      <p>Your score is: <span id="score"></span></p>
      <button class="restart-btn">Restart Quiz</button>
      <a href="rezultate.php" class="button2">Analiza rezultatelor</a>
    </div>

    <div class="progress-bar-container">
      <div class="progress-bar"></div>
    </div>
  </div>
  <script src="js/vendor/jquery.js"></script>
  <script src="js/vendor/what-input.js"></script>
  <script src="js/vendor/foundation.js"></script>
  <script src="js/app.js"></script>

</body>
</html>