<?php 
    session_start(); 
    if (isset($_POST['payment-input'])) {
        $_SESSION['placeOrderDone'] = true;
        unset($_SESSION['cart']);
        unset($_SESSION['voucher-redeemed']);
        unset($_SESSION['voucherCode']);
        unset($_SESSION['voucherError']);
    }
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

    <link rel="stylesheet" type="text/css" href="css/receipt.css">
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>

</head>

<body>
    <?php 
        /*if (isset($_SESSION['placeOrderDone']) && $_SESSION['placeOrderDone'] === true) {
            header("Location: /frontend/cart.php");
            unset($_SESSION['voucherError']);
            exit;
        }*/
    ?>

    <?php if (isset($_SESSION['voucherError']) && $_SESSION['voucherError'] === true) : ?>
        <div class="alert alert-danger fixed-top" role="alert" style="text-align:center; font-size: 18px;">
            <?php echo "Voucher is invalid" ?>
        </div>
    <?php endif; ?>

        
    <?php 
       $userID = $_SESSION['loginID'];
       $fullName = $_POST['first-name-input'] . ' ' . $_POST['last-name-input'];
       $phoneNumber = $_POST['phone-number-input'];
       $postalCode = $_POST['postal-input'];
       $houseAddress = $_POST['address-input'];
       $region = $_POST['region-input'];
       $province = $_POST['province-input'];
       $city = $_POST['city-input'];
       $barangay = $_POST['barangay-input'];

        $userRecipientsAddress['recipientsFirstName'] = $_POST['first-name-input'];
        $userRecipientsAddress['recipientsLastName'] = $_POST['last-name-input'];
        $userRecipientsAddress['recipientsPhoneNumber'] = $phoneNumber;
        $userRecipientsAddress['recipientsPostalCode'] = $postalCode;
        $userRecipientsAddress['recipientsHouseAddress'] = $houseAddress;
        $userRecipientsAddress['recipientsRegion'] = $region;
        $userRecipientsAddress['recipientsProvince'] = $province; 
        $userRecipientsAddress['recipientsCity'] = $city;
        $userRecipientsAddress['recipientsBarangay'] = $barangay;

        $_SESSION['userRecipientsAddress'] = $userRecipientsAddress;

       $path = $_SERVER['DOCUMENT_ROOT'];
       $path .= "/backend/database-connection.php";
       include_once($path);
       
       $checkIfExisting = "SELECT * FROM address WHERE userID = ?";

       $statementCheckIfExisting = $connection->prepare($checkIfExisting);
       $statementCheckIfExisting->bind_param("i", $userID);
       $statementCheckIfExisting->execute();

       $result = $statementCheckIfExisting->get_result();

       if ($result->num_rows > 0) {
           $sql = "UPDATE address SET fullName = ?, phoneNumber = ?, postalCode = ?, houseAddress = ?, region = ?, province = ?, city = ?, barangay = ? WHERE userID = ?";
           $statementUpdateData = $connection->prepare($sql);
           $statementUpdateData->bind_param("ssssssssi", $fullName, $phoneNumber, $postalCode, $houseAddress, $region, $province, $city, $barangay, $userID);
           $statementUpdateData->execute();

           $statementUpdateData->close();
       } 
    ?>

    <?php include("navbar.php") ?>

    <div class="container checkout">
        <div class="label">
            <img src="/images/check.svg" alt="" width="45px" class="check">
            <h1>Purchase Complete</h1>
        </div>
        <div class="row">
            <div class="col left">
                <h4>Recipient Address</h4>
                <div class="row">
                    <div class="col-6 form-group">
                        <label class="form-label" for="firstname">First Name</label>
                        <input readonly class="form-control-plaintext value" type="firstname" id="firstname" 
                        value="<?php echo $_POST['first-name-input']; ?>" required>
                        <div class="invalid-feedback">
                            Please enter your first name.
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-label" for="lastname">Last Name</label>
                        <input readonly class="form-control-plaintext value" type="lastname" id="lastname" 
                        value="<?php echo $_POST['last-name-input']; ?>" required>
                        <div class="invalid-feedback">
                            Please enter your last name.
                        </div>
                    </div>
                    <div class="col-12 form-group">
                        <label class="form-label" for="phonenumber">Phone Number</label>
                        <input readonly class="form-control-plaintext value" type="phonenumber" id="phonenumber" 
                        value="<?php echo $_POST['phone-number-input']; ?>" required>
                        <div class="invalid-feedback">
                            Please enter your phone number.
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-label" for="region">Region</label>
                        <input readonly class="form-control-plaintext value" type="region" id="region"
                        value="<?php echo $_POST['region-input']; ?>" required>
                        <div class="invalid-feedback">
                            Please enter your region.
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-label" for="province">Province</label>
                        <input readonly class="form-control-plaintext value" type="province" id="province" 
                        value="<?php echo $_POST['province-input']; ?>" required>
                        <div class="invalid-feedback">
                            Please enter your province.
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-label" for="city">City</label>
                        <input readonly class="form-control-plaintext value" type="city" id="city" 
                        value="<?php echo $_POST['city-input']; ?>" required>
                        <div class="invalid-feedback">
                            Please enter your city.
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-label" for="barangay">Barangay</label>
                        <input readonly class="form-control-plaintext value" type="barangay" id="barangay"
                        value="<?php echo $_POST['barangay-input']; ?>" required>
                        <div class="invalid-feedback">
                            Please enter your barangay.
                        </div>
                    </div>
                    <div class="col-12 form-group">
                        <label class="form-label" for="address">Street Name, Building, House No.</label>
                        <input readonly class="form-control-plaintext value" type="address" id="address" 
                        value="<?php echo $_POST['address-input']; ?>" required>
                        <div class="invalid-feedback">
                            Please enter your address.
                        </div>
                    </div>
                    <div class="col-12 form-group">
                        <label class="form-label" for="code">Postal Code</label>
                        <input readonly class="form-control-plaintext value" type="code" id="postal" 
                        value="<?php echo $_POST['postal-input']; ?>" required>
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
                        foreach ($_SESSION['cart2'] as $item) {
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

                <h4>Voucher</h4>

                <form class="voucher" action="/backend/apply-voucher.php" method="post">
                    <div class="input-group">
                        <input type="text" name="voucher-input" readonly class="form-control-plaintext value" placeholder="Voucher Code"
                        <?php if(isset($_POST['voucher-input'])) {
                                    echo "value='".$_POST['voucher-input']."' readonly";
                               }?>>
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
                            if (isset($_POST['voucher-input']) && $_POST['voucher-input'] != "No voucher") {
                                echo '<div class="col-4"></div>
                                <div class="col-5 my-2" style="color: #ffae42;">Voucher Discount ('.$_SESSION['voucherPercentage'].'%):</div>
                                <div class="col-3 payment my-2" style="color: #ffae42;"> - ₱'.$_SESSION['voucherValue'].'</div>';
                            }
                            unset($_SESSION['voucherValue']);
                            unset($_SESSION['voucherPercentage']);
                        ?>

                        <div class="col-4"></div>
                        <div class="col-5 my-2">Total Payment:</div>
                        <div class="col-3 totalpayment"><?php echo("₱" . $_SESSION['GrandTotalPrice']);?></div>
                    </div>
                </div>

            <script>
                <?php 
                    if ($_POST['payment-input'] == "cod") {
                        echo'document.getElementById("cod-method").classList.add("selected")';
                    }
                    else if ($_POST['payment-input'] == "gcash") {
                        echo'document.getElementById("gcash-method").classList.add("selected")';
                    }
                ?>

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