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
</head>

<body>
    <nav class="navbar navbar-expand-md custom-navbar navbar-dark">
        <div class="col-2 logo">
            <a href="#" class="navbar-brand navbar-logo">
                <img src="pics/logo.png" width="115px" alt="logo">
            </a>
            
        </div>

        <div class="col-5 offcanvas offcanvas-end slide" tabindex="-1" id="navmenu">
            <div class="offcanvas-header">
                <button type="button" class="btn-close btn-close-white text-reset close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>    
            <div class="link">
                <ul class="navbar-nav e-commerce-font-color">
                    <li class="nav-item">
                        <a href="#learn" class="nav-link ms-5 text-white">HOME</a>
                    </li>

                    <li class="nav-item">
                        <a href="#learn" class="nav-link ms-5 text-white">PRODUCTS</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle ms-5 text-white" href="#" role="button" data-bs-toggle="dropdown">CATEGORIES</a>
                        <ul class="dropdown-menu category">
                            <li><a class="dropdown-item" href="#">T-Shirts</a></li>
                            <li><a class="dropdown-item" href="#">Hoodies</a></li>
                            <li><a class="dropdown-item" href="#">Shoes</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-3">
            <div class="d-flex align-items-center">
                <input class="form-control me-2 searchb" type="search" placeholder="Search" aria-label="Search"> 
                <button class="btn bg-transparent" type="submit"><img src="pics/search.png" alt="search" width="40px"></button>
                <button class="navbar-toggler burger" type="button" data-bs-toggle="offcanvas" data-bs-target="#navmenu" aria-controls="navbarOffcanvasLg">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
        <div class="col-2">
            <button class="btn btn-nav px-4"><img src="pics/cart.png" alt="cart" width="40px"></button>
            <div class="btn-group profile">
                <button class="btn btn-nav" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                    <img src="pics/login.png" alt="login" width="40px">
                </button>
                <ul class="dropdown-menu dropdown-menu-end profile-dropdown">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Sign up</a></li>
                    <li><a class="dropdown-item" href="#">Login</a></li>
                    <li><a class="dropdown-item" href="#">Logout</a></li>
                </ul>
            </div>
            
        </div>
    </nav>

    <div class="container checkout">
        <h1>Checkout</h1>
        <div class="row">
            <div class="col left">
                <h4>Recipient Address</h4>
                <div class="row">
                    <div class="col-6 form-group">
                        <label class="form-label" for="firstname">First Name</label>
                        <input class="form-control" type="firstname" id="firstname" required>
                        <div class="invalid-feedback">
                            Please enter your first name.
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-label" for="lastname">Last Name</label>
                        <input class="form-control" type="lastname" id="lastname" required>
                        <div class="invalid-feedback">
                            Please enter your last name.
                        </div>
                    </div>
                    <div class="col-12 form-group">
                        <label class="form-label" for="phonenumber">Phone Number</label>
                        <input class="form-control" type="phonenumber" id="phonenumber" required>
                        <div class="invalid-feedback">
                            Please enter your phone number.
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-label" for="region">Region</label>
                        <input class="form-control" type="region" id="region" required>
                        <div class="invalid-feedback">
                            Please enter your region.
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-label" for="province">Province</label>
                        <input class="form-control" type="province" id="province" required>
                        <div class="invalid-feedback">
                            Please enter your province.
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-label" for="city">City</label>
                        <input class="form-control" type="city" id="city" required>
                        <div class="invalid-feedback">
                            Please enter your city.
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-label" for="barangay">Barangay</label>
                        <input class="form-control" type="barangay" id="barangay" required>
                        <div class="invalid-feedback">
                            Please enter your barangay.
                        </div>
                    </div>
                    <div class="col-12 form-group">
                        <label class="form-label" for="address">Street Name, Building, House No.</label>
                        <input class="form-control" type="address" id="address" required>
                        <div class="invalid-feedback">
                            Please enter your address.
                        </div>
                    </div>
                    <div class="col-12 form-group">
                        <label class="form-label" for="code">Postal Code</label>
                        <input class="form-control" type="code" id="address" required>
                        <div class="invalid-feedback">
                            Please enter your postal code.
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <h4>Payment</h4>
                <div class="payment-method row">
                    <div class="col">
                        <button class="cod">Cash on Delivery</button>
                    </div>
                    <div class="col">
                        <button class="gcash"> 
                            <img src="gcash.png" alt="" width="50px">
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

                    <div class="flex-row d-flex align-items-center">
                        <div class="product col-5 d-flex align-items-center">
                            <img src="sample.jpg" width="100px" alt="">
                            <div class="details d-flex flex-column">
                                <div><h6>WATER IS LIFE T-SHIRT</h6></div>
                                <div>Color:<span class="color">Black</span></div>
                                <div>Size:<span class="size">Medium</span></div>
                            </div>
                        </div>
                        <div class="price-row col">₱450.00</div>
                        <div class="quantity-row col">
                            <input readonly class="form-control-plaintext input" type="number" name="qty" id="" value="1">
                        </div> 
                        <div class="total-row col">₱450.00</div>
                    </div>    

                    <hr>

                    <div class="total-price col">
                        Total:<span>₱450.00</span> 
                    </div>
                </div>

                <hr class="my-4">

                <h4>Vouchers</h4>

                <form class="voucher">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Voucher Code">
                        <button type="submit" class="btn btn-secondary">Redeem</button>
                    </div>
                </form>
                
                <hr class="my-4">
                
                <div class="grandtotal">
                    <div class="row align">
                        <div class="col-4"></div>
                        <div class="col-5 my-2">Merchandise Total:</div>
                        <div class="col-3 payment my-2">₱450.00</div>

                        <div class="col-4"></div>
                        <div class="col-5 my-2">Shipping Total:</div>
                        <div class="col-3 payment my-2">₱50.00</div>

                        <div class="col-4"></div>
                        <div class="col-5 my-2">Total Payment:</div>
                        <div class="col-3 totalpayment">₱500.00</div>

                        <div class="button"> 

                            <hr>

                            <button class="buybtn">Place Order</button>
                        </div>
                        
                    </div>
                    

                </div>

                

            </div>
        </div>
    </div>

</body>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>