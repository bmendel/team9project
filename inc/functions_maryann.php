<?php

    //connect to database
    session_start();
    include './dbConnection.php';
    $dbConn = startConnection();
    
    
    //add function
    function addToCart(){
        $id = $_POST['bb_id'];
        array_push($_SESSION['cart'], $id);
    }
    
    //delete function
    function deleteItem(){
        global $cart;
        unset($cart[$id]); //delete element
        unset($_SESSION['cart'][$id]);
        
    }
    
    //displays cart
    function displayCart(){
        global $cart;
        
        for($i = 0; $i < sizeof($cart); $i++){
            displayMovieInfo($cart[$i]);
            echo "<br><hr><br>";
        
        }
    }
    
    //displays individual movie
    function displayMovieInfo($movie){
        global $dbConn;
        $sql = "SELECT * FROM blockbuster WHERE bb_id = " . $movie;
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($records as $record) {
            echo $record['bb_title'] . "<br>";
            echo "<img src='../img/". $movie .".png'> <br>";
            echo $record['bb_year'] . "<br>";
            echo "<button type = 'button' value ='". $movie. "'>Delete</button>";
        }
        
    }

?>



