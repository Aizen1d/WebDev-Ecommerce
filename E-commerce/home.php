<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
     
     <link rel="stylesheet" type="text/css" href="home.css">
     <style>
            .custom-navbar {
            background-color:rgba(186, 176, 127, 0.39);;
            font-family: 'Raleway', sans-serif;
            font-size: large;
            margin-top: 1.5% !important;
            align-items: center !important;
            padding-top: 1%;
            padding-bottom: 1%;
            height: 12%;
            }

            .dropdown-menu {
                margin-left: 48px;
            }

            .logo {
                text-align: end;
                padding-left: 7%;
            }

            .slide{
                background-color: #BAB07F !important;
                width: 300px !important;
            }

            .searchb{
                text-align: left !important;
            }

            .burger{
                text-align: end !important;
                margin-left: 40%;
            }

            .close{
                position: absolute;
                right: 45px;
                padding: 5px;
                margin-top: 10px !important;
                font-size: x-large;
                opacity: 1;
            }
     </style>
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

    <section class="main py-5">
        <div class="container-lg py-5">
            <div class="row py-5">
                <div class="col-sm-6 text-group">
                    <h1 class="py-5">Nom<span class="multiText">Nomi</span></h1>
                    <p class="paragraph">With a focus on quality and affordability, we strive to bring you the best shopping experience possible. 
                    Browse our collection today and find the perfect item for your unique style. Start shopping now!</p>
                    
                    <a href="loginui.html">
                        <button class="button">Login</button>
                    </a>

                    <a href="register.html">
                        <button class="button">Register</button>
                    </a>
                </div>

                <div class="col-sm-6">
                    <img class="model-image" src="home-pics/home-bg.png" alt="image">
                    <img class="splash-image" src="home-pics/smoke-art.png" alt="image">
                </div>

            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>