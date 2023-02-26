<?php
    session_start();

    if(isset($_POST['productID-Decrease'])) {
        if (isset($_SESSION['cart'])) {
        $productID = $_POST['productID-Decrease'];

            if ($_SESSION['cart'][$productID]['quantity'] > 1) {
                $_SESSION['cart'][$productID]['quantity']--;
                $_SESSION['cart'][$productID]['totalProductPrice'] = $_SESSION['cart'][$productID]['price'] * $_SESSION['cart'][$productID]['quantity'];
            }
        }
    }

    if(isset($_POST['productID-Increase'])) {
        if (isset($_SESSION['cart'])) {
        $productID = $_POST['productID-Increase'];
        
        $_SESSION['cart'][$productID]['quantity']++;
        $_SESSION['cart'][$productID]['totalProductPrice'] = $_SESSION['cart'][$productID]['price'] * $_SESSION['cart'][$productID]['quantity'];
        }
    }

    header("Location: /frontend/cart.php");
?>