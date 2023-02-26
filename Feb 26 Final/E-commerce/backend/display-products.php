<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="/frontend/css/products.css">
</head>

<body>
    <div class="container-fluid products">
    <?php
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/backend/database-connection.php";
        include_once($path);
        
        $sql = "SELECT productID, productName, price, Image FROM products";
        $result = mysqli_query($connection, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            while ($product = mysqli_fetch_assoc($result)) {
                $product['Image'] = base64_decode($product['Image']);

                echo '<div class="margin" width="300">
                        <a href="/frontend/prodpage.php?productID=' . $product['productID'] . '" style="text-decoration: none;" class="card">
                            <img style="max-width: 100%; max-height: 100%; width: 300px; height: 300px;" 
                            src="data:image/jpeg;base64,' . base64_encode($product['Image']) . '" alt="?">
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

 </body>
 </html>