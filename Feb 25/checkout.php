<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="css/checkout.css">
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>

</head>

<body>
    <?php if (!isset($_POST['cart-submitted']) && !isset($_POST['voucher-redeemed']) ) {
        if (isset($_SESSION['voucherError']) && $_SESSION['voucherError'] == false) {
            header("Location: /frontend/cart.php");
            unset($_SESSION['voucherError']);
            exit;
        }
    } 
    ?>

    <?php 
        if (isset($_SESSION['placeOrderDone']) && $_SESSION['placeOrderDone'] === true) {
            header("Location: /frontend/cart.php");
            unset($_SESSION['voucherError']);
            exit;
        }
    ?>

    <?php if (isset($_SESSION['voucherError']) && $_SESSION['voucherError'] === true) : ?>
        <div class="alert alert-danger fixed-top" role="alert" style="text-align:center; font-size: 18px;">
            <?php echo "Voucher is invalid" ?>
        </div>
    <?php endif; ?>

    <?php 
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/backend/database-connection.php";
        include_once($path);

        $userRecipientsAddress = array();
        $userID = $_SESSION['loginID'];

        $statement = $connection->prepare("SELECT * FROM address WHERE userID = ?");
        $statement->bind_param("i", $userID);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $fullName = $row['fullName'];
            $fullNameSplit = explode(' ', $fullName);

            $userRecipientsAddress['recipientsFirstName'] = $fullNameSplit[0];
            $userRecipientsAddress['recipientsLastName'] = $fullNameSplit[1];
            $userRecipientsAddress['recipientsPhoneNumber'] = $row['phoneNumber'];
            $userRecipientsAddress['recipientsPostalCode'] = $row['postalCode'];
            $userRecipientsAddress['recipientsHouseAddress'] = $row['houseAddress']; 
            $userRecipientsAddress['recipientsRegion'] = $row['region']; 
            $userRecipientsAddress['recipientsProvince'] = $row['province']; 
            $userRecipientsAddress['recipientsCity'] = $row['city']; 
            $userRecipientsAddress['recipientsBarangay'] = $row['barangay']; 

            $_SESSION['userRecipientsAddress'] = $userRecipientsAddress;
        }
    ?>

    <?php include("navbar.php") ?>

    <form action="/frontend/home.php" method="post" id="place-order-form">
        <input type="hidden" id="first-name-input" name="first-name-input" value="">
        <input type="hidden" id="last-name-input" name="last-name-input" value="">
        <input type="hidden" id="phone-number-input" name="phone-number-input" value="">
        <input type="hidden" id="region-input" name="region-input" value="">
        <input type="hidden" id="province-input" name="province-input" value="">
        <input type="hidden" id="city-input" name="city-input" value="">
        <input type="hidden" id="barangay-input" name="barangay-input" value="">
        <input type="hidden" id="address-input" name="address-input" value="">
        <input type="hidden" id="postal-input" name="postal-input" value="">

        <input type="hidden" id="payment-input" name="payment-input" value="">
    </form>

    <div class="container checkout">
        <h1>Checkout</h1>
        <div class="row">
            <div class="col left">
                <h4>Recipient Address</h4>
                <div class="row">
                    <div class="col-6 form-group">
                        <label class="form-label" for="firstname">First Name</label>
                        <input class="form-control validate-checkout" type="firstname" id="firstname" 
                        value="<?php if(isset($_SESSION['userRecipientsAddress']['recipientsFirstName'])) { 
                                    echo $_SESSION['userRecipientsAddress']['recipientsFirstName']; } ?>" required>
                        <div class="invalid-feedback">
                            Please enter your first name.
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-label" for="lastname">Last Name</label>
                        <input class="form-control validate-checkout" type="lastname" id="lastname" 
                        value="<?php if(isset($_SESSION['userRecipientsAddress']['recipientsLastName'])) { 
                                    echo $_SESSION['userRecipientsAddress']['recipientsLastName']; } ?>" required>
                        <div class="invalid-feedback">
                            Please enter your last name.
                        </div>
                    </div>
                    <div class="col-12 form-group">
                        <label class="form-label" for="phonenumber">Phone Number</label>
                        <input class="form-control validate-checkout" type="phonenumber" id="phonenumber" 
                        value="<?php if(isset($_SESSION['userRecipientsAddress']['recipientsPhoneNumber'])) { 
                                    echo $_SESSION['userRecipientsAddress']['recipientsPhoneNumber']; } ?>" required>
                        <div class="invalid-feedback">
                            Please enter your phone number.
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-label" for="region">Region</label>
                        <input class="form-control validate-checkout" type="region" id="region"
                        value="<?php if(isset($_SESSION['userRecipientsAddress']['recipientsRegion'])) { 
                                    echo $_SESSION['userRecipientsAddress']['recipientsRegion']; } ?>" required>
                        <div class="invalid-feedback">
                            Please enter your region.
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-label" for="province">Province</label>
                        <input class="form-control validate-checkout" type="province" id="province" 
                        value="<?php if(isset($_SESSION['userRecipientsAddress']['recipientsProvince'])) { 
                                    echo $_SESSION['userRecipientsAddress']['recipientsProvince']; } ?>" required>
                        <div class="invalid-feedback">
                            Please enter your province.
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-label" for="city">City</label>
                        <input class="form-control validate-checkout" type="city" id="city" 
                        value="<?php if(isset($_SESSION['userRecipientsAddress']['recipientsCity'])) { 
                                    echo $_SESSION['userRecipientsAddress']['recipientsCity']; } ?>" required>
                        <div class="invalid-feedback">
                            Please enter your city.
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-label" for="barangay">Barangay</label>
                        <input class="form-control validate-checkout" type="barangay" id="barangay"
                        value="<?php if(isset($_SESSION['userRecipientsAddress']['recipientsBarangay'])) { 
                                    echo $_SESSION['userRecipientsAddress']['recipientsBarangay']; } ?>" required>
                        <div class="invalid-feedback">
                            Please enter your barangay.
                        </div>
                    </div>
                    <div class="col-12 form-group">
                        <label class="form-label" for="address">Street Name, Building, House No.</label>
                        <input class="form-control validate-checkout" type="address" id="address" 
                        value="<?php if(isset($_SESSION['userRecipientsAddress']['recipientsHouseAddress'])) { 
                                    echo $_SESSION['userRecipientsAddress']['recipientsHouseAddress']; } ?>" required>
                        <div class="invalid-feedback">
                            Please enter your address.
                        </div>
                    </div>
                    <div class="col-12 form-group">
                        <label class="form-label" for="code">Postal Code</label>
                        <input class="form-control validate-checkout" type="code" id="postal" 
                        value="<?php if(isset($_SESSION['userRecipientsAddress']['recipientsPostalCode'])) { 
                                    echo $_SESSION['userRecipientsAddress']['recipientsPostalCode']; } ?>" required>
                        <div class="invalid-feedback">
                            Please enter your postal code.
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <h4>Payment</h4>
                <div class="payment-method row">
                    <div class="col">
                        <button class="cod" id="cod-method" data-value="cod">Cash on Delivery</button>
                    </div>
                    <div class="col">
                        <button class="gcash" id="gcash-method" data-value="gcash"> 
                            <img src="/images/checkout/gcash.png" alt="" width="50px">
                            <span style="justify-content: center;">G-Cash</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col right">
                <h4>Your Cart</h4>

                <div class="cart">
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
                    </div>

                    <hr>
                    
                    <?php 
                    $_SESSION['TotalPrice'] = 0.00;
                    $_SESSION['TotalQuantity'] = 0;
                        foreach ($_SESSION['cart'] as $item) {
                            $item["image"] = base64_decode($item["image"]);
                            echo'<div class="flex-row d-flex align-items-center">
                                <div class="product col-5 d-flex align-items-center">
                                    <img style="max-width: 100%; max-height: 100%; width: 100px; height: 100px;" 
                                    src="data:image/jpeg;base64,' . base64_encode($item['image']) . '" alt="">
                                    <div class="details d-flex flex-column">
                                        <div><h6>'. $item['productName'] .'</h6></div>
                                        <div>Color:<span class="color"> ' . $item['color'] .'</span></div>
                                        <div>Size:<span class="size"> '. $item['size'] .'</span></div>
                                    </div>
                                </div>
                                <div class="price-row col">₱'. $item['price'] .'</div>
                                <div class="quantity-row col">
                                    <input readonly class="form-control-plaintext input" type="number" name="qty" 
                                    id="product'.$item['productID'].'" value="' .$item['quantity']. '">
                                </div> 
                                <div class="total-row col">₱'.$item['totalProductPrice'].'</div>
                            </div>
                            <hr>';   
                            $_SESSION['TotalPrice'] = $_SESSION['TotalPrice'] + $item['totalProductPrice'];
                            $_SESSION['TotalQuantity'] = $_SESSION['TotalQuantity'] + $item['quantity'];
                        } ?>
                    <div class="total-price col">
                        Total:<span><?php echo("₱" . $_SESSION['TotalPrice']) ?></span> 
                    </div>
                </div>

                <hr class="my-4">

                <h4>Vouchers</h4>

                <form class="voucher" action="/backend/apply-voucher.php" method="post">
                    <div class="input-group">
                        <input type="text" name="voucher-input" class="form-control" placeholder="Voucher Code"
                        <?php if(isset($_SESSION['voucherCode'])) {
                                    echo "value='".$_SESSION['voucherCode']."' readonly";
                               }?>>

                        <button type="submit" class="btn btn-secondary" 
                            <?php if(isset($_SESSION['voucherCode'])) 
                                    echo "disabled";?>
                        >Redeem</button>
                    </div>
                </form>
                
                <hr class="my-4">

                <?php
                if ($_SESSION['TotalQuantity'] >= 3) {
                    $ShippingTotal = $_SESSION['TotalPrice'] / 2;
                    $ShippingTotal = $ShippingTotal * 0.05;
                    $ShippingTotal = $ShippingTotal + 50;
                }
                else {
                    $ShippingTotal = 50;
                }
                
                if (isset($_SESSION['voucherValue'])) {
                    $_SESSION['GrandTotalPrice'] = round($_SESSION['TotalPrice'] + $ShippingTotal - $_SESSION['voucherValue'], 2);
                }
                else {
                    $_SESSION['GrandTotalPrice'] = round($_SESSION['TotalPrice'] + $ShippingTotal, 2);
                }

                ?>
                
                <div class="grandtotal">
                    <div class="row align">
                        <div class="col-4"></div>
                        <div class="col-5 my-2">Merchandise Total:</div>
                        <div class="col-3 payment my-2"><?php echo("₱" . $_SESSION['TotalPrice']) ?></div>

                        <div class="col-4"></div>
                        <div class="col-5 my-2">Shipping Total:</div>
                        <div class="col-3 payment my-2"><?php echo("₱" . $ShippingTotal) ?></div>

                        <?php
                            if (isset($_POST['voucher-redeemed']) && isset($_SESSION['voucherValue'])) {
                                echo '<div class="col-4"></div>
                                <div class="col-5 my-2" style="color: #ffae42;">Voucher Discount ('.$_SESSION['voucherPercentage'].'%):</div>
                                <div class="col-3 payment my-2" style="color: #ffae42;"> - ₱'.$_SESSION['voucherValue'].'</div>';
                            }
                        ?>

                        <div class="col-4"></div>
                        <div class="col-5 my-2">Total Payment:</div>
                        <div class="col-3 totalpayment"><?php echo("₱" . $_SESSION['GrandTotalPrice']);?></div>

                        <div class="button"> 
                            <hr>
                            <button class="buybtn" type="button" onclick="validateForm()">Place Order</button>
                        </div>
                    </div>
                </div>

            <script>
                const paymentButtons = document.querySelectorAll(".payment-method button");
                let selectedPaymentButton;
                                
                paymentButtons.forEach(button => {
                    button.addEventListener("click", () => {
                        if (selectedPaymentButton) {
                            selectedPaymentButton.classList.remove("selected");
                        }
                            selectedPaymentButton = button;
                            selectedPaymentButton.classList.add("selected");
                            const value = selectedPaymentButton.innerText;
                        });
                    });

                function validateForm() {
                    const inputs = document.querySelectorAll(".validate-checkout");
                    const selectedPayment = document.querySelector(".payment-method button.selected");
                    
                    for (let i = 0; i < inputs.length; i++) {
                        const input = inputs[i];

                        if (input.value.trim() == "") {
                            const errorMessage = document.createElement("div");
                            errorMessage.classList.add("alert", "alert-danger", "fixed-top", "details-error");
                            errorMessage.setAttribute("role", "alert");
                            errorMessage.style.textAlign = "center";
                            errorMessage.style.fontSize = "18px";
                            errorMessage.innerText = "Please fill up all details";
                            document.body.appendChild(errorMessage);
                            errorMessage.style.opacity = "0";

                            setTimeout(() => {
                                errorMessage.style.opacity = "1";
                                errorMessage.style.transition = "opacity 0.45s ease"; 
                            }, 500)
                            return;
                        }
                    }
                    
                    // check if payment method is selected
                    if (!selectedPayment) {
                        const errorMessage = document.createElement("div");
                            errorMessage.classList.add("alert", "alert-danger", "fixed-top", "payment-error");
                            errorMessage.setAttribute("role", "alert");
                            errorMessage.style.textAlign = "center";
                            errorMessage.style.fontSize = "18px";
                            errorMessage.innerText = "Please select payment method below";
                            document.body.appendChild(errorMessage);
                            errorMessage.style.opacity = "0";

                        setTimeout(() => {
                            errorMessage.style.opacity = "1";
                            errorMessage.style.transition = "opacity 0.45s ease"; 
                        }, 500)
                        return;
                    }

                    // remove DETAILS error message with transition fade away
                    const detailError = document.querySelector(".details-error");
                    if (detailError) {
                        detailError.style.opacity = "0";
                        setTimeout(() => {
                            detailError.remove();
                        }, 500)
                    }
                    
                    // remove PAYMENT error message with transition fade away
                    const paymentError = document.querySelector(".payment-error");
                    if (paymentError) {
                        paymentError.style.opacity = "0";
                        setTimeout(() => {
                            paymentError.remove();
                        }, 500)
                    }

                    document.getElementById("first-name-input").value = document.getElementById("firstname").value 
                    document.getElementById("last-name-input").value = document.getElementById("lastname").value 
                    document.getElementById("phone-number-input").value = document.getElementById("lastname").value 
                    document.getElementById("region-input").value = document.getElementById("region").value 
                    document.getElementById("province-input").value = document.getElementById("province").value 
                    document.getElementById("city-input").value = document.getElementById("city").value 
                    document.getElementById("barangay-input").value = document.getElementById("barangay").value 
                    document.getElementById("address-input").value = document.getElementById("address").value 
                    document.getElementById("postal-input").value = document.getElementById("postal").value 

                    document.getElementById("payment-input").value = selectedPayment.getAttribute("data-value");

                    const form = document.getElementById('place-order-form');
                    form.submit();
                };

                

            </script>
            </div>
        </div>
    </div>

    <?php include("footer.php") ?>

</body>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>