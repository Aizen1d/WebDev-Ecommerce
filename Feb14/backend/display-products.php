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
</head>

<body>
    <div class="container-fluid products">
    <?php
        $conn = mysqli_connect("localhost", "root", "", "e-commercedb");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        $sql = "SELECT productID, productName, price, Image FROM products";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            while ($product = mysqli_fetch_assoc($result)) {
                echo '<div class="margin">
                        <a href="/frontend/prodpage.php?productID=' . $product['productID'] . '" style="text-decoration: none;" class="card">
                            <img src="data:image/jpeg;base64,' . base64_encode($product['Image']) . '" width="300" alt="">
                            <h>' . $product['productName'] . '</h>
                            <h>₱' . $product['price'] . '</h>
                        </a>
                      </div>';
            }
        } 
        else {
            echo "0 results";
        }
        
        mysqli_close($conn);        
    ?>
    </div>

 </body>
 </html>