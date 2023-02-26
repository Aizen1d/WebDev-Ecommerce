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

    <link rel="stylesheet" type="text/css" href="/frontend/css/products.css">

    <title><?php echo ucwords($_GET['category']) ?> Page</title>
</head>

<body>
    <?php include("navbar.php") ?>

    <div class="container-fluid title">
        <p><?php echo strtoupper($_GET['category']) ?></p>
    </div>

    <div class="container-fluid products">
    <?php
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/backend/database-connection.php";
        include_once($path);
        
        $category = strtolower($_GET['category']);

        $sql = "SELECT productID, productName, price, Image FROM products WHERE LOWER(category) = LOWER(?)";
        $statement = $connection->prepare($sql);
        $statement->bind_param("s", $category);
        $statement->execute();
        $result = $statement->get_result();
        
        if ($result->num_rows > 0) {
            while ($product = mysqli_fetch_assoc($result)) {
                $product['Image'] = base64_decode($product['Image']);
                echo '<div class="margin">
                        <a href="/frontend/prodpage.php?productID=' . $product['productID'] . '" style="text-decoration: none;" class="card">
                            <img style="max-width: 100%; max-height: 100%; width: 300px; height: 300px;" 
                            src="data:image/jpeg;base64,' . base64_encode($product['Image']) . '" alt="">
                            <h>' . $product['productName'] . '</h>
                            <h>₱' . $product['price'] . '</h>
                        </a>
                      </div>';
            }
        } 
        else {
            echo "0 results";
        }
        
        mysqli_close($connection);        
    ?>
    </div>

    <?php
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/frontend/footer.php";
        include_once($path);
    ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
 </body>
 </html>