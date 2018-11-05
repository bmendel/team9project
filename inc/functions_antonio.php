<?php


    function displayMovieInfo(){
        if(isset($_POST['infoId'])){
            global $dbConn;
            $id = $_POST['infoId'];
            $sql = "SELECT bb_id FROM blockbuster";
            $stmt = $dbConn->prepare($sql);
            $stmt->execute();
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo "<div>";
            foreach ($records as $record) {
                if($id == $record['bb_id']){
                    echo "<h2>Title: ".$record['bb_title']."</h2><br>";
                    echo "<h3>Director: ".$record['bb_director']."</h3><br>";
                    echo "<h3>Runtime: ".$record['bb_runtime']."</h3><br>";
                    echo "<h3>Genre: ".$record['bb_genre']."</h3><br>";
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
        <title></title>
    </head>
    <body>
        <?php displayMovieInfo(); ?>
    </body>
</html>