<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="/frontend/css/upload.css">
</head>

<body>

    <?php
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/backend/database-connection.php";
        include_once($path); 
    ?>

    <?php
    if (isset($_POST['productID'])) {
        $statement = $connection->prepare("SELECT * FROM products WHERE productID = ?");
        $statement->bind_param("i", $_POST['productID']);
        $statement->execute();
        $result = $statement->get_result();

        $row = $result->fetch_assoc();
    }
    ?>

    <div class="container upload">
        <div class="upload-form">
            <h1><?php if(isset($_POST['productID'])) { echo "Edit"; } else { echo "Upload"; } ?> Product</h1>

            <hr class="my-4">

            <form class="upload-table row" action="/backend/upload-product.php" method="post" id="product-form" enctype="multipart/form-data">
                <input type="hidden" id="new-or-edit" name="">
                <input type="hidden" id="product-id" name="product-id"
                value="<?php if(isset($_POST['productID'])) { echo $_POST['productID']; } ?>">
                <div class="form-group">
                    <label for="product" class="form-label">Product Name</label>
                    <input type="text" id="name-product" name="name-product" class="form-control validate-checkout" 
                    value="<?php if(isset($_POST['productID'])) { echo $row['productName']; } ?>">  
                </div>
                <div class="form-group col-6">
                    <label for="image" class="form-label">Upload Product Image (5mb maximum)</label>
                    <input type="file" id="image-product" name="image-product"  class="form-control validate-checkout"
                    accept="image/png, image/jpeg">
                </div>
                <div class="form-group col-6">
                    <label for="category" class="form-label">Product Category</label>
                    <input type="text" id="category-product" name="category-product" class="form-control validate-checkout"
                    value="<?php if(isset($_POST['productID'])) { echo $row['category']; } ?>">
                </div><div class="form-group">
                    <label for="desc" class="form-label">Product Description</label>
                    <textarea type="text" id="description-product" name="description-product" class="form-control desc validate-checkout"
                    ><?php if(isset($_POST['productID'])) { echo $row['description']; } ?></textarea>
                    <input type="hidden" id="desc-product" name="desc-product">
                </div>
                <div class="form-group">
                    <label for="color" class="form-label">Product Colors</label>
                    <input type="hidden" id="colors-input" name="colors-product" class="validate-checkout">
                    <select class="form-select" id="colors-select" multiple aria-label="multiple select size 1 select">
                    
                    <?php
                        $colors = array("black", "white", "red", "blue", "pink", "green"); // define the available colors
                        $selectedDesc = '';
                        if (isset($_POST['productID'])) {
                            $selectedDesc = strtolower($row['color']);
                        }

                        $selectedColors = explode(',', $selectedDesc);
                        foreach ($colors as $color) {
                            $selected = '';
                            if (in_array($color, $selectedColors)) {
                                $selected = 'selected';
                            }
                            echo '<option value="' . $color . '"' . $selected . '>' . ucfirst($color) . '</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="size" class="form-label">Product Size</label>
                    <input type="text" id="size-product" name="size-product" class="form-control validate-checkout"
                    value="<?php if(isset($_POST['productID'])) { echo $row['size']; } ?>">
                </div>
                <div class="form-group">
                    <label for="price" class="form-label">Product Price</label>
                    <input type="text" id="price-product" name="price-product" class="form-control validate-checkout"
                    value="<?php if(isset($_POST['productID'])) { echo $row['price']; } ?>">
                </div>
            </form>

            <hr class="my-4">

            <div class="button">
                <a href="prodlist.php">
                    <button class="cancelbtn">Cancel</button>
                </a>
                <button type="button" onclick="validateForm()" class="savebtn">Save</button>
            </div>
        </div>
    </div>
    
    <script>
        <?php 
            if (isset($_POST['productID'])) {
                echo "document.getElementById('new-or-edit').name = 'edit'";
            }
            else {
                echo "document.getElementById('new-or-edit').name = 'new'";
            };
        ?>

        var textarea = document.querySelector('#description-product');
            textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        const colorSelect = document.getElementById('colors-select');
        const selectedColors = Array.from(colorSelect.selectedOptions).map(option => option.value);
        document.getElementById('colors-input').value = selectedColors.join(',');

        colorSelect.addEventListener('change', (event) => {
            const selectedColors = Array.from(colorSelect.selectedOptions).map(option => option.value);
            document.getElementById('colors-input').value = selectedColors.join(',');
        });

        function validateForm() {
            const inputs = document.querySelectorAll(".validate-checkout");
            
            if (document.getElementById('new-or-edit').name == 'new') {
                for (let i = 0; i < inputs.length; i++) {
                const input = inputs[i];
                    if (input.value.trim() == "") {
                        const errorMessage = document.createElement("div");
                        errorMessage.classList.add("alert", "alert-danger", "fixed-top");
                        errorMessage.setAttribute("role", "alert");
                        errorMessage.style.textAlign = "center";
                        errorMessage.style.fontSize = "18px";
                        errorMessage.innerText = "Please fill up all details";
                        document.body.appendChild(errorMessage);
                        errorMessage.style.opacity = "0";

                        setTimeout(() => {
                            errorMessage.style.opacity = "1";
                            errorMessage.style.transition = "opacity 0.45s ease"; 
                        }, 500)
        
                        return;
                    }
                }
            }
            document.getElementById('desc-product').value = document.getElementById('description-product').value
            document.getElementById('product-form').submit();
        }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
