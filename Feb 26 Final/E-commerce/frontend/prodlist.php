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

    <link rel="stylesheet" type="text/css" href="/frontend/css/prodlist.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
</head>

<body>

    <nav class="navbar navbar-expand-md custom-navbar navbar-dark">
        <div class="col-2 logo">
            <a href="/frontend/prodlist.php" class="navbar-brand navbar-logo">
                <img src="/images/navbar-images/logo.png" width="115px" alt="logo">
            </a>
        </div>

        <div class="col-9" style="text-align: end;">
            <div class="btn-group profile">
                <button class="btn btn-nav" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                    <img src="/images/navbar-images/login.png" alt="login" width="40px"></img>
                </button>

                <ul class="dropdown-menu dropdown-menu-end profile-dropdown">
                    <li><a class="dropdown-item"  href="/backend/process-logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <?php
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/backend/database-connection.php";
        include_once($path); ?>

    <?php if (isset($_SESSION['uploadProductSuccess'])) : ?>
        <div class="alert alert-success fixed-top" role="alert" style="text-align:center; font-size: 18px;">
            <?php echo($_SESSION['uploadProductSuccess']); ?>
        </div>
    <?php unset($_SESSION['uploadProductSuccess']); endif; ?>

    <?php if (isset($_SESSION['deleteProductSuccess'])) : ?>
        <div class="alert alert-success fixed-top" role="alert" style="text-align:center; font-size: 18px;">
            <?php echo($_SESSION['deleteProductSuccess']); ?>
        </div>
    <?php unset($_SESSION['deleteProductSuccess']); endif; ?>

    <?php if (isset($_SESSION['uploadImageSizeExceed'])) : ?>
        <div class="alert alert-danger fixed-top" role="alert" style="text-align:center; font-size: 18px;">
            <?php echo($_SESSION['uploadImageSizeExceed']); ?>
        </div>
    <?php unset($_SESSION['uploadImageSizeExceed']); endif; ?>

    <?php if (isset($_SESSION['uploadImageUploadingError'])) : ?>
        <div class="alert alert-danger fixed-top" role="alert" style="text-align:center; font-size: 18px;">
            <?php echo($_SESSION['uploadImageUploadingError']); ?>
        </div>
    <?php unset($_SESSION['uploadImageUploadingError']); endif; ?>

    <?php if (isset($_SESSION['uploadImageNotSupported'])) : ?>
        <div class="alert alert-danger fixed-top" role="alert" style="text-align:center; font-size: 18px;">
            <?php echo($_SESSION['uploadImageNotSupported']); ?>
        </div>
    <?php unset($_SESSION['uploadImageNotSupported']); endif; ?>

    
<div class="container list">
    <div class="top row">
        <div class="col title"><h1>List of Products</h1></div>
        <div class="col btn">
            <a href="upload.php">
                <button class="addbtn">Add Product</button>
            </a>
        </div>
    </div>
    
    <hr class="my-4">

    <div class="tbl">
        <table class="table table-hover table-bordered border-dark">
            <thead class="head">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <tbody>
            <?php 
            $sql = "SELECT productID, productName, description, category, price FROM products";
            $result = mysqli_query($connection, $sql);
            
            if (mysqli_num_rows($result) > 0) {
                $count = 0;

                while ($product = mysqli_fetch_assoc($result)) {
                    $count++;
                    $message = 'Are you sure you want to delete this product ('.$product['productName'].')?';
                    echo'<tr class="align-middle">
                            <th scope="row">'.$count.'</th>
                            <td>'.$product['productName'].'</td>
                            <td>'.$product['category'].'</td>
                            <td>'.$product['description'].'</td>
                            <td>₱'.$product['price'].'</td>
                            <td>
                                <div class="center">
                                <form action="upload.php" method="post">
                                    <input type="hidden" name="productID" value="' .$product['productID']. '">
                                    <button class="icon mb-3"><img src="/images/edit.svg" alt="" class="green"></button>
                                </form>

                                <form id="delete-form" action="/backend/delete-product.php" method="post">
                                    <input type="hidden" name="productID" value="' .$product['productID']. '">
                                    <button type="button" class="icon" onclick="
                                        const confirmed = window.confirm(\''.$message.'\');
                                    
                                        if (confirmed) {
                                            this.form.submit();
                                        }">
                                    <img src="/images/delete.svg" alt="" class="red"></button>
                                </form>
                                </div> 
                            </td>
                        </tr>';
                    }
                }?>
            </tbody>
            
        </table>
    </div>
</div>

<script>
  const form = document.getElementById('myForm');
  form.addEventListener('submit', (event) => {
    event.preventDefault(); // prevent default form submission
    const confirmed = confirm('Are you sure you want to submit the form?');
    if (confirmed) {
      form.submit(); // submit the form programmatically
    }
  });

  function askDelete(){
    const confirmed = window.confirm("Are you sure you want to delete this product?");

    if (confirmed) {
        document.getElementById('delete-form').submit();
    }  
  }
</script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>