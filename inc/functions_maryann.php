<?php

    //connect to database
    session_start();
    include './dbConnection.php';
    $dbConn = startConnection();
    
    //add function
    function addToCart($id) {
        foreach ($_SESSION['cart'] as $cartId) {
            if ($id == $cartId) {
                return;
            }
        }
        array_push($_SESSION['cart'], $id);
    }
    
    //delete function
    function deleteItem($id){
        $i = array_search($id, $_SESSION['cart']);
        unset($_SESSION['cart'][$i]); //delete element
        array_values($_SESSION['cart']);
    }
    
    function clearCart(){
        unset($_SESSION['cart']);
        
    }
    
    //displays cart
    function displayCart(){
        if(sizeof($_SESSION['cart']) == 0){
            echo "Your Cart is Empty.<br>";
            return;
        }
        foreach($_SESSION['cart'] as $movie){
            displayMovieInfo($movie);
        }
        $total = count($_SESSION['cart'])*9.99;
        echo "<span class='cart-total'><strong>Total</strong>: \$".$total."</span>";
    }
    
    //displays individual movie
    function displayMovieInfo($movie){
        global $dbConn;
        $sql = "SELECT * FROM blockbuster WHERE bb_id = " . $movie;
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($records as $record) {
            echo "<div class='cart-item'>";
            echo "<img src='img/". $movie .".png'>";
            echo "<div class='info-container'>";
            echo "<h5>" . $record['bb_title'] . "</h5>";
            echo "<p>" . $record['bb_genre'] . "</p>";
            echo "<p>" . $record['bb_year'] . "</p>";
            echo "<p>\$9.99</p>";
            echo "</div>";
            
            echo "<div class='actions'>";
            echo "<form method='post' action='inc/functions_antonio.php'>";
            echo "<input type='hidden' name='infoId' value ='". $movie . "'>";
            echo "<button class='btn-info'>Info</button>";
            echo "</form>";
            
            echo "<form method='post' action='cart.php'>";
            echo "<input type='hidden' name='deleteId' value ='". $movie . "'>";
            echo "<button class='btn-danger'>Delete</button>";
            echo "</form>";
            echo "</div></div>";
        }
    }

?>


