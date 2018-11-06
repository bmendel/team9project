<?php
    session_start();
    include 'inc/functions_maryann.php';
    
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