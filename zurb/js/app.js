$(document).foundation();

$(function() {
  $('.button-like')
    .bind('click', function(event) {
      $(".button-like").toggleClass("liked");
    })
});

//More (Expand) or Less (Collapse)
$('.categories-menu.menu.nested').each(function(){
  var filterAmount = $(this).find('li').length;
  if( filterAmount > 5){    
    $('li', this).eq(4).nextAll().hide().addClass('toggleable');
    $(this).append('<li class="more">More</li>');    
  }  
});

$('.categories-menu.menu.nested').on('click','.more', function(){
  if( $(this).hasClass('less') ){    
    $(this).text('More').removeClass('less');    
  }else{
    $(this).text('Less').addClass('less'); 
  }
  $(this).siblings('li.toggleable').slideToggle(); 
}); 

const startButton = document.getElementById('start-btn');
const nextButton = document.querySelectorAll('.next-btn');
const prevButton = document.querySelectorAll('.prev-btn');
const submitButton = document.querySelectorAll('.submit-btn');
const restartButton = document.querySelectorAll('.restart-btn');
const questionContainers = document.querySelectorAll('.question-container');
const progressBar = document.querySelector('.progress-bar');
const scoreDisplay = document.getElementById('score');

let currentQuestionIndex = 0;
let score = 0;

for (let i = 1; i < questionContainers.length; i++) {
  questionContainers[i].style.display = 'none';
}


startButton.addEventListener('click', () => {
  showQuestion(currentQuestionIndex);
  startButton.style.display = 'none';
  updateProgressBar(currentQuestionIndex);
});

for (let i = 0; i < nextButton.length; i++) {
  nextButton[i].addEventListener('click', () => {
    showQuestion(currentQuestionIndex + 1);
  });
}

for (let i = 0; i < prevButton.length; i++) {
  prevButton[i].addEventListener('click', () => {
    showQuestion(currentQuestionIndex - 1);
  });
}

submitButton[0].addEventListener('click', showResult);
restartButton[0].addEventListener('click', restartQuiz);

function showResult() {
  let answers = document.forms[currentQuestionIndex].elements;
  for (let i = 0; i < answers.length; i++) {
    if (answers[i].checked) {
      if (answers[i].value === 'b') {
        score++;
      }
      break;
    }
  }
  questionContainers[currentQuestionIndex].style.display = 'none';
  document.querySelector('.result-container').style.display = 'block';
  scoreDisplay.innerHTML = score;
  updateProgressBar(currentQuestionIndex);
}

function restartQuiz() {
  currentQuestionIndex = 0;
  score = 0;
  for (let i = 0; i < questionContainers.length; i++) {
    questionContainers[i].style.display = 'none';
  }
  questionContainers[currentQuestionIndex].style.display = 'block';
  document.querySelector('.result-container').style.display = 'none';
  updateProgressBar(currentQuestionIndex);
}

function updateProgressBar(currentQuestionIndex) {
  const progress = ((currentQuestionIndex + 1) / questionContainers.length) * 100;
  progressBar.style.width = `${progress}%`;
}

function showQuestion(index) {
  if (index >= 0 && index <= questionContainers.length - 1) {
    questionContainers[currentQuestionIndex].style.display = 'none';
    currentQuestionIndex = index;
    questionContainers[currentQuestionIndex].style.display = 'block';
    updateProgressBar(currentQuestionIndex);
  }
}



