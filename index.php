<?php
  session_start();
  include './dbConnection.php';
  $dbConn = startConnection();
  include 'inc/functions_brett.php';
  
  function displayCategories() {
    $categories = ['title', 'genre', 'director', 'runtime', 'year'];
    foreach ($categories as $c) {
      echo "<option value='bb_" . $c ."'>" . ucfirst($c) ."</option>";
    }
  }
  
  function displayResults() {
    if(isset($_POST['submit'])) {
      echo "<hr>";
      echo "<h2>Films Found: </h2>";
      echo "<ul class='result-list'>";
      $results = getResults();
      
      foreach($results as $film) {
        echo "<li class='result-item'>";
        echo "<img src='img/" . $film['bb_id'] . ".png'><br>";
        echo "<h4>".$film['bb_title']."</h4>";
        
        echo '<form method=\'post\'>';
        echo '<input type=\'hidden\' name=\'addId\' value=\'' . $film['bb_id'] . '\'>';
        echo '<button>Add</button>';
        echo '</form>';
        
        echo '<form method=\'post\'>';
        echo '<input type=\'hidden\' name=\'infoId\' value=\'' . $film['bb_id'] . '\'>';
        echo '<button>Info</button>';
        echo '</form>';

        echo "</li>";
      }
      echo "</ul>";
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Blockbuster</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700,700i,800,800i"/>
    <link rel="stylesheet" type="text/css" href="./css/styles.css"/>
  </head>
  <body>
    <div class="page-wrapper">
      <h1>Blockbuster</h1>
      <form method="post">
        Title: <input type="text" name="title"><br>
        Director: <input type="text" name="director"><br>
        Genre: <select name="genre">
          <option value=""> Select one </option>  
          <?=displayGenres()?>
        </select><br>
        Years<br>
        <div class="range">Min: <input type="number" size="3" name="yearMin">
        Max: <input type="number" size="4" name="yearMax"></div>
        Runtime<br>
        <div class="range">Min: <input type="number" size="3" name="timeMin">
        Max: <input type="number" size="4" name="timeMax"></div>
        
        Sort by: <select name="genreSort">
          <option value=""> Select one </option>
          <?=displayCategories()?>
        </select><br>
        <input type="radio" name="order" value="asc"> Ascending <br>
        <input type="radio" name="order" value="desc"> Descending <br>
        
        <br><input type="submit" name ="submit" value="Search">
      </form>
      <?=displayResults()?>
    </div>
  </body>
</html>