<?php
    
  include '../dbConnection.php';
  $dbConn = startConnection();

    
    function displayMovieInfo(){
        global $dbConn;
        if(isset($_POST['infoId'])){
            $id = $_POST['infoId'];
            $sql = "SELECT * FROM `blockbuster` WHERE 1";
            $stmt = $dbConn->prepare($sql);
            $stmt->execute();
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo "<div id='movieInfo' class='content-wrapper'>";
            foreach ($records as $record) {
                if($id == $record['bb_id']){
                    echo "<img src='../img/".$record['bb_id'].".png' alt='".$record['bb_title']."'/>";
                    echo "<div class='info-container'>";
                    echo "<h2>".$record['bb_title']."</h2>";
                    echo "<p>Director: ".$record['bb_director']."</p>";
                    echo "<p>Runtime: ".$record['bb_runtime']." minutes</p>";
                    echo "<p>Genre: ".$record['bb_genre']."</p>";
                    
                    // form 
                    echo '<form method=\'post\' action=\'../cart.php\'>';
                    echo '<input type=\'hidden\' name=\'addId\' value=\'' . $record['bb_id'] . '\'>';
                    echo '<button class="btn-success">Add To Cart</button>';
                    echo '</form>';
                    
                    echo '<form method=\'post\' action=\'../index.php\'>';
                    echo '<button class="btn-info">Back</button>';
                    echo '</form>';
                    echo '</div>';
                    break;
                }
            }
            echo "</div>";
        }
    }

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Movie Info</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700,700i,800,800i"/>
        <link rel="stylesheet" type="text/css" href="../css/styles.css"/>
    </head>
    <body id="info">
        <div class="page-wrapper">
            <?php displayMovieInfo(); ?>
        </div>
    </body>
</html>