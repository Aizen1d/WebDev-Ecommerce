<?php 
    session_start(); 

    if (isset($_POST['payment-input'])) {
        $_SESSION['placeOrderDone'] = true;
        unset($_SESSION['cart']);
        unset($_SESSION['voucher-redeemed']);
        unset($_SESSION['voucherValue']);
        unset($_SESSION['voucherCode']);
        unset($_SESSION['voucherPercentage']);
        unset($_SESSION['voucherError']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
     
     <link rel="stylesheet" type="text/css" href="css/home.css">
     <link rel="shortcut icon" type="image/x-icon" href="/pics/logo.png"/>
</head>
<body>
    <?php include("navbar.php") ?>

    <section class="main py-5">
        <div class="container-sm py-5">
            <div class="row py-5">
                <div class="col-sm-6 text-group">
                    <img src="/images/home.png" width="300px" alt="" class="logoimg">
                    <p class="paragraph">With a focus on quality and affordability, we strive to bring you the best shopping experience possible. 
                    Browse our collection today and find the perfect item for your unique style. Start shopping now!</p>
                    
                    <?php
                        if (isset($_SESSION['loginSession']) && $_SESSION['loginSession'] == true) {
                            $buttonsVisible = "display: none;";
                        }
                        else {
                            $buttonsVisible = "";
                        }
                    ?>

                    <a href="login.php">
                        <button class="button" style="<?php echo $buttonsVisible; ?>">Login</button>
                    </a>

                    <a href="register.php">
                        <button class="button" style="<?php echo $buttonsVisible; ?>">Register</button>
                    </a>
                </div>

                <div class="col-sm-6">
                    <img class="model-image" src="/home-pics/girl.png" alt="image">
                </div>

            </div>
        </div>
    </section>

    <?php include("footer.php") ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
