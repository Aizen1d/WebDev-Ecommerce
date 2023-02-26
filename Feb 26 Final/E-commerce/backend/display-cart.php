<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="css/cart.css">

</head>

<body>        
        <?php 

        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            echo '
            <div class="container cart">
            <h1>Shopping Cart</h1>
                <div class="main-column flex-row d-flex">
                    <div class="col-5"></div>
                        <div class="col">
                            Price
                        </div>
                        <div class="col">
                            Quantity
                        </div>
                        <div class="col">
                            Total Price
                        </div>
                    <div class="col-1"></div>
                </div>
                <hr>';

            $grandTotalPrice = 0.00;
            foreach ($_SESSION['cart'] as $item) {
                $onClickStep = "document.querySelector('#product" .$item['productID']. "')";
                $item["image"] = base64_decode($item["image"]);

                echo'<div class="flex-row d-flex align-items-center">
                    <div class="product col-5 d-flex align-items-center">
                        <img style="max-width: 100%; max-height: 100%; width: 100px; height: 100px;" src="data:image/jpeg;base64,' . base64_encode($item['image']) . '" alt="">
                        <div class="details d-flex flex-column">
                            <div><h6>'. $item['productName'] .'</h6></div>
                            <div>Color:<span class="color">'. $item['color'] .'</span></div>
                            <div>Size:<span class="size">'. $item['size'] .'</span></div>
                        </div>
                    </div>

                    <form id="decreaseQuantity'.$item['productID'].'" method="post" action="/backend/update-cart-quantity.php">
                        <input type="hidden" name="productID-Decrease" value="' .$item['productID']. '">
                    </form>

                    <form id="increaseQuantity'.$item['productID'].'" method="post" action="/backend/update-cart-quantity.php">
                            <input type="hidden" name="productID-Increase" value="' .$item['productID']. '">
                    </form> 

                    <div class="price-row col">₱'. $item['price'] .'</div>
                        <div class="quantity-row col">
                            
                                <button type="submit" form="decreaseQuantity'.$item['productID'].'" class="btn px-3 me-2">
                           
                                <i class="bi bi-dash"></i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                </svg>
                                </button>
                            
                            
                            <input class="input" type="number" name="qty" id="product'.$item['productID'].'" value="' .$item['quantity']. '" readonly>

                                <button type="submit" form="increaseQuantity'.$item['productID'].'" class="btn px-3 ms-2">

                                    <i class="bi bi-plus"></i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                </button>
                            
                        </div>
                    <div class="total-row col">₱'.$item['totalProductPrice'].'</div>
                        <div class="col-1">
                            <form action="/backend/remove-from-cart.php" method="post">
                                <input type="hidden" name="productID" value="' .$item['productID']. '">
                                <button class="delete" type="submit">&times;</button>
                            </form>
                        </div>        
                    </div>

                <hr> 
                
                <script>
                    function decreaseQuantity() {
                        let input = ' .$onClickStep. ';
                        let value = parseInt(input.value);
                        if (value > 1) {
                            input.stepDown();
                        }
                    }

                    function increaseQuantity() {
                        let input = ' .$onClickStep. ';
                        input.stepUp();
                    }
                </script>';

                $grandTotalPrice = $grandTotalPrice + $item['totalProductPrice'];
            }

            // generate uniqid if the user checkouts ?? continue or not
            $checkout_id = uniqid();

            // unset old sessions from checkout
            unset($_SESSION['voucher-redeemed']);
            unset($_SESSION['voucherValue']);
            unset($_SESSION['voucherCode']);
            unset($_SESSION['voucherPercentage']);
            unset($_SESSION['voucherError']);
            $_SESSION['placeOrderDone'] = false;
            

            echo '<div class="row">
            <div class="total-price col">
                Total:<span>₱' .$grandTotalPrice. '</span> 
            </div>
            <div class="checkout col-2">
                <form method="post" action="/frontend/checkout.php">
                    <input type="hidden" name="cart-submitted">
                    <input type="hidden" name="checkout-id" value="'.$checkout_id.'">
                    <button type="submit" class="checkoutbutton">Check Out</button>
                </form>
            </div>
        </div>
    </div>';
        }
        else {
            echo'
                <div class="container cart" style="height: 400px">
                <h1>Shopping Cart</h1>
                <hr>
                <h1 style="margin-top: 9%; justify-content:center ;display: flex;">Your cart is empty.</h1>
                </div>';
        }
        
        ?>
</body>

</body>
</html>