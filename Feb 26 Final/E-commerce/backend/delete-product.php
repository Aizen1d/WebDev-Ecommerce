<?php
    session_start();

    if ($_POST['productID']) {
        $productID = $_POST['productID']; 

        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/backend/database-connection.php";
        include_once($path); 

        $statement = $connection->prepare("DELETE FROM products WHERE productID = ?");
        $statement->bind_param("i", $productID);
        $statement->execute();

        $connection->close();

        $_SESSION['deleteProductSuccess'] = "Product successfully deleted.";
        header("Location: /frontend/prodlist.php");
        exit;
    }
?>  