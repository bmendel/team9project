<?php
    session_start();
    include 'inc/functions_maryann.php';
    
    if (isset($_POST['addId'])) {
        addToCart($_POST['addId']);
    }
    if (isset($_POST['deleteId'])) {
        deleteItem($_POST['deleteId']);
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
        
        <form method='post' action='index.php'>
            <button>Back</button>
        </form>

    </body>
</html>