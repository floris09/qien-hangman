<?php
  session_start();

  $words = ['random','words','squid','coffee','coding'];


  $guesses = $_SESSION['guesses'] ?? [];
  $word = $_SESSION['word'] ?? $words[array_rand($words)];
  $wrongCount = $_SESSION['wrongCount'] ?? 0;
  $notGuessed = 0;
  $wordArray = str_split($word);

  if(isset($_GET['new'])){
    session_destroy();
    header('Location: index.php');
  }
 ?>

<html>
<head>
</head>
<body>

  <script>
    function submit(){
      var input = document.getElementById('input');
      var guess = input.value;
      document.location = '?guess=' + guess;
    }
  </script>

<input type='text' id='input'>
<button onclick='submit()'>Guess</button>

<a href='index.php?new=true'><button>New Game</button></a><br>

</body>

<?php
  if(isset($_GET['guess'])){
    $guesses[] = $_GET['guess'];

    if(!in_array($_GET['guess'],$wordArray)){
      $wrongCount++;
    }
  }

  foreach ($wordArray as $letter) {
    if(in_array($letter,$guesses)){
      echo "$letter ";
    } else {
      echo "_ ";
      $notGuessed++;
    }
  }

  if($wrongCount >= 10){
    echo '<br>YOU LOSE...';
  }

  if($notGuessed == 0){
    echo '<br>YOU WIN!';
  }

  echo '<br>';

  $_SESSION['guesses'] = $guesses;
  $_SESSION['word'] = $word;
  $_SESSION['wrongCount'] = $wrongCount;
  // print_r($guesses);
  // echo('<br>');
  // echo($word . '<br>');
  echo('wrong:' . $wrongCount);

 ?>
