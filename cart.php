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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700,700i,800,800i"/>
        <link rel="stylesheet" type="text/css" href="./css/styles.css"/>
    </head>
    <body id="cart">
        <header><h1>Your Shopping Cart</h1></header>
        <div class='content-wrapper'>
            <?= displayCart() ?>
        </div>
        <br>
        <div class='cart-actions'>
            <form method='post' action='index.php'>
                <button class='btn btn-success'>Back</button>
            </form>
        
            <form method='post'>
                <input type='hidden' name='clearId'>
                <button class='btn btn-danger'>Clear Cart</button>
            </form>
        </div>
    </body>
</html>