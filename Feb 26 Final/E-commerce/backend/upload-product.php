<?php
    session_start();

    $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/backend/database-connection.php";
        include_once($path); 
    
    if (isset($_POST['product-id'])) {
        $productID = $_POST['product-id'];
    }
    
    $productName = $_POST['name-product'];
    $category = $_POST['category-product'];
    $description = $_POST['description-product'];
    $colors = $_POST['colors-product'];
    $size = $_POST['size-product'];
    $price = $_POST['price-product'];
    
    if (isset($_FILES['image-product'])) {
        $image = $_FILES['image-product'];
    }

    // if no image uploaded in edit mode
    if ($image['error'] == UPLOAD_ERR_NO_FILE) {
        if (isset($_POST['edit'])) {
                    
            $statement = $connection->prepare("UPDATE products SET productName = ?, 
                                                                    description = ?, 
                                                                    category = ?, 
                                                                    color = ?, 
                                                                    size = ?, 
                                                                    price = ? 
                                                                    WHERE productID = ?");
            $statement->bind_param("sssssdi", $productName, $description, $category, $colors, $size, $price, $productID);
            $statement->execute();

            $_SESSION['uploadProductSuccess'] = "Product successfully edited.";
        }
        
        if (isset($_POST['new'])) { // new product to be inserted
           
            $statement = $connection->prepare("INSERT INTO products(productName, description, category, color, size, price) 
                values(?, ?, ?, ?, ?, ?)");
            $statement->bind_param("sssssd", $productName, $description, $category, $colors, $size, $price);
            $statement->execute();

            $_SESSION['uploadProductSuccess'] = "Product successfully added.";
        }

        $connection->close();

        header("Location: /frontend/prodlist.php");
        exit;
    }

    $fileName = $image['name'];
    $fileType = $image['type'];
    $fileTmpName = $image['tmp_name'];
    $fileError = $image['error'];
    $fileSize = $image['size'];

    $allowed = array('jpeg', 'png', 'jpg');
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    
    if (in_array($ext, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1024 * 1024 * 5) {
                
                $data = file_get_contents($fileTmpName);
                $data = base64_encode($data);
                
                if (isset($_POST['edit'])) {
                    
                    $statement = $connection->prepare("UPDATE products SET productName = ?, 
                                                                            description = ?, 
                                                                            category = ?, 
                                                                            color = ?, 
                                                                            size = ?, 
                                                                            price = ?, 
                                                                            Image = ?
                                                                            WHERE productID = ?");
                    $statement->bind_param("sssssdsi", $productName, $description, $category, $colors, $size, $price, $data, $productID);
                    $statement->execute();
                }
                if (isset($_POST['new'])) { // new product to be inserted
                   
                    $statement = $connection->prepare("INSERT INTO products(productName, description, category, color, size, price, Image) 
                        values(?, ?, ?, ?, ?, ?, ?)");
                    $statement->bind_param("sssssds", $productName, $description, $category, $colors, $size, $price, $data);
                    $statement->execute();
                }

                $connection->close();

                $_SESSION['uploadProductSuccess'] = "Product successfully added.";
                header("Location: /frontend/prodlist.php");
            } 
            else {
                $_SESSION['uploadImageSizeExceed'] = "The file is too large, 5mb is the limit.";
            }
        } 
        else {
            $_SESSION['uploadImageUploadingError'] = "There was an error uploading your photo.";
        }
    } 
    else {
        $_SESSION['uploadImageNotSupported'] = "File type you uploaded is not supported.";
    }
?>