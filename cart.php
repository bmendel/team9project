<?php
        //connect to database
    session_start();
    include 'dbConnection.php';
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
            echo "<img src='img/". $movie .".png'> <br>";
            echo $record['bb_year'] . "<br>";
            
            echo "<form method='post' action='inc/functions_antonio.php'>";
            echo "<input type='hidden' name='infoId' value ='". $movie . "'>";
            echo "<button>Info</button>";
            echo "</form>";
            
            echo "<form method='post' action='cart.php'>";
            echo "<input type='hidden' name='deleteId' value ='". $movie . "'>";
            echo "<button>Delete</button>";
            echo "</form>";
        }
        
    }
    
    if (isset($_POST['addId'])) {
        addToCart($_POST['addId']);
    }
    if (isset($_POST['deleteId'])) {
        deleteItem($_POST['deleteId']);
    }
    if (isset($_POST['clearId'])) {
        clearCart();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Shopping Cart </title>
    </head>
    <body>
        <header><h1><strong>Your Shopping Cart</strong></h1></header>
        
        <?= displayCart() ?>
        
        <br>
        
        <form method='post' action='index.php'>
            <button>Back</button>
            
        </form>
        
        <form method='post'>
            <input type='hidden' name='clearId'>
            <button>Clear Cart</button>
        </form>
        
    </body>
</html>