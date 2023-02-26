<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="css/prodpage.css">
</head>

<body>
    <?php
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/frontend/navbar.php";
        include_once($path);
    ?>

    <?php if (isset($_SESSION['add-to-cart-success'])) : ?>
            <div class="alert alert-success fixed-top" role="alert" style="text-align:center; font-size: 18px;">
                Product added to cart.
            </div>
        <?php unset($_SESSION['add-to-cart-success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['add-to-cart-qty-success'])) : ?>
            <div class="alert alert-success fixed-top" role="alert" style="text-align:center; font-size: 18px;">
                Product quantity in cart increased.
            </div>
        <?php unset($_SESSION['add-to-cart-qty-success']); ?>
    <?php endif; ?>

    <?php 
        $path = 
        $_SERVER['DOCUMENT_ROOT'];
        $path .= "/backend/get-selected-product.php";
        include_once($path);
    ?>

    <?php
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/frontend/footer.php";
        include_once($path);
    ?>
</body>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>