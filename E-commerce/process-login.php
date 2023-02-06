<?php
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];

    $errors = array();
    $saveData = array();

    // database connection
    $connection = new mysqli("localhost", "root", "", "e-commercedb");
    if ($connection->connect_error) {
        die("Failed to connect : ".$connection->connect_error);
    }

    $statement = $connection->prepare("SELECT * FROM users WHERE username = ? and password = ?");
    $statement->bind_param("ss", $username, $password);
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows == 1) {
        // Login success
        unset($_SESSION['login-errors']);
        $_SESSION['loginSession'] = true;
        header("Location: home.php");
        
    } else {
        // Login failed
        $saveData['loadUserName'] = $username;
        $errors['invalid-login'] = "Username or password is incorrect.";

        $_SESSION['login-errors'] = $errors;
        $_SESSION['saveData'] = $saveData;
        header("Location: login.php");
    }

    $statement->close();
    $connection->close();
?>