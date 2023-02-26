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

            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/backend/database-connection.php";
            include_once($path);

            $stmt = $connection ->prepare("SELECT * FROM products where productID = ?");
            $stmt->bind_param('i', $productID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = mysqli_fetch_assoc($result);
                $row["Image"] = base64_decode($row["Image"]);
                
                echo '<div class="container product">
                        <div class="left">
                            <img src="data:image/jpeg;base64,' . base64_encode($row['Image']) . '" alt="" width="65%" height="85%">
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
                                    <div class="choosecolor">';

                                    $colors = explode(',', $row['color']);
                                    foreach ($colors as $color) {
                                        echo '<button>' . ucfirst($color) . '</button>';
                                    }

                                echo'</div>
                                </div>
                                <div class="productsize">
                                    <span>Size</span>
                                    <div class="choosesize">';

                                    $sizes = explode(',', $row['size']);
                                    foreach ($sizes as $size) {
                                        echo '<button>' . strtoupper($size) . '</button>';
                                    }

                                    echo'</div>
                                </div>
                            </div>

                            <div class="product-price">
                                <span>₱' . $row['price'] . '</span>
                                <form action="/backend/add-to-cart.php" method="post" id="add-to-cart-form">
                                    <input type="hidden" name="productID" value="'.$productID.'">
                                    <input type="hidden" id="color-input" name="selectedColor" value="S">
                                    <input type="hidden" id="size-input" name="selectedSize" value="S">
                                    <button class="cart-btn" id="add-to-cart-btn" style="border: none;" type="button"
                                    onclick="validateForm()"  name="add_to_cart">Add to cart</button>
                                </form>
                            </div>

                            <script>
                                const colorButtons = document.querySelectorAll(".productcolor button");
                                const sizeButtons = document.querySelectorAll(".productsize button");
                                let selectedColorButton;
                                let selectedSizeButton;
                                
                                colorButtons.forEach(button => {
                                    button.addEventListener("click", () => {
                                        if (selectedColorButton) {
                                            selectedColorButton.classList.remove("selected");
                                        }
                                        selectedColorButton = button;
                                        selectedColorButton.classList.add("selected");
                                        const value = selectedColorButton.innerText;
                                    });
                                });

                                sizeButtons.forEach(button => {
                                    button.addEventListener("click", () => {
                                        if (selectedSizeButton) {
                                            selectedSizeButton.classList.remove("selected");
                                        }
                                        selectedSizeButton = button;
                                        selectedSizeButton.classList.add("selected");
                                        const value = selectedSizeButton.innerText;
                                    });
                                });

                                function validateForm() {
                                    // perform validation here
                                    const selectedColor = document.querySelector(".productcolor button.selected");
                                    const selectedSize = document.querySelector(".productsize button.selected");

                                    if (!selectedColor) {
                                        const errorMessage = document.createElement("div");
                                        errorMessage.classList.add("alert", "alert-danger", "fixed-top");
                                        errorMessage.setAttribute("role", "alert");
                                        errorMessage.style.textAlign = "center";
                                        errorMessage.style.fontSize = "18px";
                                        errorMessage.innerText = "Please select desired color!";
                                        document.body.appendChild(errorMessage);

                                        errorMessage.style.opacity = "0";

                                        setTimeout(() => {
                                            errorMessage.style.opacity = "1"; // gradually increase opacity to 1
                                            errorMessage.style.transition = "opacity 0.3s ease"; // add a fading transition
                                          }, 500);
                                        return; 
                                    }

                                    if (!selectedSize) {
                                        const errorMessage = document.createElement("div");
                                        errorMessage.classList.add("alert", "alert-danger", "fixed-top");
                                        errorMessage.setAttribute("role", "alert");
                                        errorMessage.style.textAlign = "center";
                                        errorMessage.style.fontSize = "18px";
                                        errorMessage.innerText = "Please select desired size.";
                                        document.body.appendChild(errorMessage);

                                        errorMessage.style.opacity = "0";

                                        setTimeout(() => {
                                            errorMessage.style.opacity = "1"; // gradually increase opacity to 1
                                            errorMessage.style.transition = "opacity 0.3s ease"; // add a fading transition
                                          }, 500);
                                        return; 
                                    }
                                    
                                    document.getElementById("color-input").value = selectedColor.innerText;
                                    document.getElementById("size-input").value = selectedSize.innerText;

                                    document.getElementById("add-to-cart-form").submit();
                                }
                            </script>

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