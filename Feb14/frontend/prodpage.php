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
                        <ul class="dropdown-menu w-25">
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
            <button class="btn btn-nav"><img src="pics/login.png" alt="login" width="40px"></button>
        </div>
    </nav>

    <?php 
        $path = 
        $_SERVER['DOCUMENT_ROOT'];
        $path .= "/backend/get-selected-product.php";
        include_once($path);
    ?>

    <footer class="text-center text-white foot">
        <div class="container-fluid">
            <section class="mt-5">
                <div class="row text-center d-flex justify-content-center pt-5">
                    <div class="col-md-2">
                        <h class="foottext">
                            <a href="#" class="text-white" style="text-decoration: none;">ABOUT US</a>
                        </h>
                    </div>
                    <div class="col-md-2">
                        <h class="foottext">
                            <a href="#" class="text-white" style="text-decoration: none;">HELP</a>
                        </h>
                    </div>
                    <div class="col-md-2">
                        <h class="foottext">
                            <a href="#" class="text-white" style="text-decoration: none;">CONTACT</a>
                        </h>
                    </div>
                </div>
            </section>

            <hr class="my-5" />

            <section class="mb-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt
                            distinctio earum repellat quaerat voluptatibus placeat nam,
                            commodi optio pariatur est quia magnam eum harum corrupti
                            dicta, aliquam sequi voluptate quas.
                        </p>
                    </div>
                </div>
            </section>

            <section class="text-center mb-5">
                <a href="#" class="text-white me-4">
                    <i class="fa fa-facebook-f"></i>
                </a>

                <a href="#" class="text-white me-4">
                    <i class="fa fa-twitter"></i>
                </a>

                <a href="#" class="text-white me-4">
                    <i class="fa fa-google"></i>
                </a>
                
                <a href="#" class="text-white me-4">
                    <i class="fa fa-github"></i>
                </a>
            </section>
        </div>

        <div class="text-center p-3 copyright">
            © 2023 Copyright:
            <a href="draft.html" class="text-white">
                Website.com
            </a>
        </div>
    </footer>

</body>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>