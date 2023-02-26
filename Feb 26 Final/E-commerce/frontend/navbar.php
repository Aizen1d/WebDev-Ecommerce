<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
</head>
<body>
    <nav class="navbar navbar-expand-md custom-navbar navbar-dark">
        <div class="col-2 logo">
                <a href="/frontend/home.php" class="navbar-brand navbar-logo">
                    <img src="/images/navbar-images/logo.png" width="115px" alt="logo">
                </a>
            </div>

            <div class="col-5 offcanvas offcanvas-end slide" tabindex="-1" id="navmenu">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close btn-close-white text-reset close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>    
                <div class="link">
                    <ul class="navbar-nav e-commerce-font-color">
                        <li class="nav-item">
                            <a href="home.php" class="nav-link ms-5 text-white">HOME</a>
                        </li>

                        <li class="nav-item">
                            <a href="products.php" class="nav-link ms-5 text-white">PRODUCTS</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle ms-5 text-white" href="#" role="button" data-bs-toggle="dropdown">CATEGORIES</a>
                            <ul class="dropdown-menu category">
                                <li><a class="dropdown-item" href="categories.php?category=T-shirt">T-Shirts</a></li>
                                <li><a class="dropdown-item" href="categories.php?category=hoodies">Hoodies</a></li>
                                <li><a class="dropdown-item" href="categories.php?category=shoes">Shoes</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <form method="post" action="search.php" id="search-form">
                <input type="hidden" name="query" id="getQuery" value="">
            </form>

            <div class="col-3">
                <div class="d-flex align-items-center">
                    <input class="form-control me-2 searchb" type="search" placeholder="Search" aria-label="Search" name="query" id="search-value"> 
                    <button class="btn bg-transparent" id="search-button" type="submit" form="search-form">
                    <img src="/images/navbar-images/search.png" alt="search" width="40px"></button>
                    <button class="navbar-toggler burger" type="button" data-bs-toggle="offcanvas" data-bs-target="#navmenu" aria-controls="navbarOffcanvasLg">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>
            
            <script>
                var searchValue = document.getElementById("search-value");
                var query = document.getElementById("getQuery");
                var form = document.getElementById("search-form");
                searchValue.addEventListener("input", function() {
                    query.value = searchValue.value;
                    form.action = "search.php?query=" + query.value;
                });

                var searchInput = document.getElementById("search-value");

                searchInput.addEventListener("keydown", function(event) {
                // If the "Enter" key is pressed
                if (event.keyCode === 13) {
                    document.getElementById("search-button").click();
                }
                });
            </script>
            

            <div class="col-2">
                <a href="cart.php" class="btn btn-nav px-4"><img src="/images/navbar-images/cart.png" alt="cart" width="40px"></a>
                <div class="btn-group profile">
                    <a href="cart.php" class="btn btn-nav" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                        <img src="/images/navbar-images/login.png" alt="login" width="40px"></img>
                    </a>

                    <?php
                        if (isset($_SESSION['loginSession']) && $_SESSION['loginSession'] == true) {
                            $hideOnLogin = "display: none;";
                            $hideOnLogout = "";
                        }
                        else {
                            $hideOnLogin = "";
                            $hideOnLogout = "display: none;";
                        }
                    ?>

                    <ul class="dropdown-menu dropdown-menu-end profile-dropdown">
                        <li><a class="dropdown-item" style="<?php echo $hideOnLogout; ?>" href="/backend/get-user-profile.php" method="post">Profile</a></li>
                        <li><a class="dropdown-item" style="<?php echo $hideOnLogin; ?>" href="register.php">Sign up</a></li>
                        <li><a class="dropdown-item" style="<?php echo $hideOnLogin; ?>" href="login.php">Login</a></li>
                        <li><a class="dropdown-item" style="<?php echo $hideOnLogout; ?>" href="/backend/process-logout.php">Logout</a></li>
                    </ul>
                </div>
                
            </div>
        </nav>
</body>
</html>