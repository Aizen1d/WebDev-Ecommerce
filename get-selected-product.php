<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="/frontend/css/prodpage.css">
</head>

<body>
    <?php
        if (isset($_GET['productID'])) {
            $productID = $_GET['productID'];
            $connection = new mysqli("localhost", "root", "", "e-commercedb");

            if ($connection->connect_error) {
                die("Failed to connect : ".$connection->connect_error);
            }

            $stmt = $connection ->prepare("SELECT * FROM products where productID = ?");
            $stmt->bind_param('i', $productID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = mysqli_fetch_assoc($result);
                
                echo '<div class="container product">
                        <div class="left">
                            <img src="data:image/jpeg;base64,' . base64_encode($row['Image']) . '" alt="" width="65%">
                        </div>
                        
                        <div class="right">
                            <div class="productdesc">
                                <span>' . $row['category'] . '</span>
                                <h1>' . $row['productName'] . '</h1>
                                <p>' . $row['description'] . '</p>
                            </div>
                            <div class="productconfig">
                                <div class="productcolor">
                                    <span>Color</span>
                                    <div class="choosecolor">
                                        <div>
                                            <input data-image="black" type="radio" id="black" name="color" value="black" checked>
                                            <label for="black"><span></span></label>
                                        </div>
                                        <div>
                                            <input data-image="white" type="radio" id="white" name="color" value="white" checked>
                                            <label for="white"><span></span></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="productsize">
                                    <span>Size</span>
                                    <div class="choosesize">
                                        <button>XS</button>
                                        <button>S</button>
                                        <button>M</button>
                                        <button>L</button>
                                        <button>XL</button>
                                    </div>
                                </div>
                            </div>

                            <div class="product-price">
                                <span>₱' . $row['price'] . '</span>
                                <a href="#" class="cart-btn">Add to cart</a>
                            </div>
                        </div>
                    </div>';
            }

            $stmt->close();
            $connection->close();
        }
    ?>

</body>

</body>
</html>