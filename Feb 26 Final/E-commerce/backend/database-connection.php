<?php
    $connection = new mysqli("localhost", "root", "", "e-commercedb");

    if ($connection->connect_error) {
        die("Failed to connect : ".$connection->connect_error);
    }
?>