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
            echo "<div id='movieInfo'>";
            foreach ($records as $record) {
                if($id == $record['bb_id']){
                    echo "<h2>Title: ".$record['bb_title']."</h2><br>";
                    echo "<h3>Director: ".$record['bb_director']."</h3><br>";
                    echo "<h3>Runtime: ".$record['bb_runtime']." minutes</h3><br>";
                    echo "<h3>Genre: ".$record['bb_genre']."</h3><br>";
                    
                    // form 
                    echo '<form method=\'post\' action=\'../cart.php\'>';
                    echo '<input type=\'hidden\' name=\'addId\' value=\'' . $record['bb_id'] . '\'>';
                    echo '<button>Add To Cart</button>';
                    echo '</form>';
                    
                    echo '<form method=\'post\' action=\'../index.php\'>';
                    echo '<button>Back</button>';
                    echo '</form>';
                    break;
                }
            //   echo "<option value='".$record['bb_genre']."'>".$record['bb_genre']."</option>";
            }
            echo "</div>";
        }
    }

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Movie Info</title>
        <link rel="stylesheet" type="text/css" href="../css/styles.css"/>
    </head>
    <body>
        <?php displayMovieInfo(); ?>
    </body>
</html>