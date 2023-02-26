<?php
    session_start();

    $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/backend/database-connection.php";
            include_once($path);

    // redirect to login and prevent from accessing profile
    if (!isset($_SESSION['loginSession']) && $_SESSION['loginSession'] == false) {
        header("Location: /frontend/login.php");
        exit;
    }

    if(isset($_POST['productID'])) {
        $selectedSize = $_POST['selectedSize'];
        $selectedColor = $_POST['selectedColor'];
        $variant = $selectedSize .'-'. $selectedColor;
        $productID = $_POST['productID'] . $variant; 

        if (!isset($_SESSION['cart'])) { // create array for cart if not existing
            $_SESSION['cart'] = array(); 
        }
            if (array_key_exists($productID, $_SESSION['cart'])) { // check if product exist already in the cart
                $_SESSION['cart'][$productID]['quantity']++;
                $_SESSION['cart'][$productID]['totalProductPrice'] = $_SESSION['cart'][$productID]['price'] * $_SESSION['cart'][$productID]['quantity'];
                $_SESSION['add-to-cart-qty-success'] = true;
            } 
            else { // add the product and its details
                $statement = $connection->prepare("SELECT productName, price, Image FROM products WHERE productID = ?");
                $statement->bind_param("i", $productID);
                $statement->execute();
                $result = $statement->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                    $_SESSION['cart'][$productID] = array(
                        'productID' => $productID,
                        'quantity' => 1,
                        'productName' => $row['productName'],
                        'price' => $row['price'],
                        'totalProductPrice' => $row['price'],
                        'color' => $selectedColor, // to change
                        'size' => $selectedSize, // to change
                        'image' => $row['Image']);
                        $_SESSION['add-to-cart-success'] = true;
                }

                $connection->close();
            }
        
    }

    //optional header("Location: /frontend/cart.php");
    header("Location: /frontend/prodpage.php?productID=$productID");

?>