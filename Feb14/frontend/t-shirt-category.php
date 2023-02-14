<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="products.css">

    <title>Products Page</title>
</head>

<body>
    <?php include("navbar.php") ?>

    <div class="container-fluid title">
        <p>T-SHIRTS</p>
    </div>
    
    <?php 
        $path = 
        $_SERVER['DOCUMENT_ROOT'];
        $path .= "/backend/display-t-shirts-category.php";
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
 </body>
 </html>