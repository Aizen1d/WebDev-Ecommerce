<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="css/cart.css">
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

        <hr>

        <div class="flex-row d-flex align-items-center">
            <div class="product col-5 d-flex align-items-center">
                <img src="sample.jpg" width="200px" alt="">
                <div class="details d-flex flex-column">
                    <div><h6>WATER IS LIFE T-SHIRT</h6></div>
                    <div>Color:<span class="color">Black</span></div>
                    <div>Size:<span class="size">Medium</span></div>
                </div>
            </div>
            
            <div class="price-row col">₱450.00</div>
                <div class="quantity-row col">
                    <button class="btn px-3 me-2"
                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                        <i class="bi bi-dash"></i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                            <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                        </svg>
                    </button>
                    
                    <input class="input" type="number" name="qty" id="" value="1">
                    
                    <button class="btn px-3 ms-2"
                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                        <i class="bi bi-plus"></i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                    </button>
                </div>
            <div class="total-row col">₱450.00</div>
                <div class="col-1"><button class="delete">&times;</button></div>
        </div>

        <hr>

        <div class="row">
            <div class="total-price col">
                Total:<span>₱450.00</span> 
            </div>
            <div class="checkout col-2">
                <button class="checkoutbutton">Check Out</button>
            </div>
        </div>
    
    </div>


</body>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>