<?php
    session_start();

    if(isset($_POST['productID'])) {
        if (isset($_SESSION['cart'])) {
        
        $productID = $_POST['productID'];
        
        unset($_SESSION['cart'][$productID]);
        header("Location: /frontend/cart.php");
        }
    }
?>