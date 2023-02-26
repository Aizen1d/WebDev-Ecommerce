<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $_SESSION['loginSession'] = false;

        // ADMIN LOGIN
        if ($username == "admin" && $password == "123") {
            header("Location: /frontend/prodlist.php");
            exit;
        }

        $errors = array();
        $saveData = array();

        // database connection
        $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/backend/database-connection.php";
            include_once($path);

        $statement = $connection->prepare("SELECT * FROM users WHERE username = ? and password = ?");
        $statement->bind_param("ss", $username, $password);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows == 1) {
            // Login success
            unset($_SESSION['login-errors']);

            $row = $result->fetch_assoc();

            $_SESSION['loginUsername'] = $username;
            $_SESSION['loginID'] = $row['userID'];
            $_SESSION['loginSession'] = true;
            
            header("Location: /frontend/home.php");
            
        } else {
            // Login failed
            $saveData['loadUserName'] = $username;
            $errors['invalid-login'] = "Username or password is incorrect.";

            $_SESSION['login-errors'] = $errors;
            $_SESSION['saveData'] = $saveData;
            $_SESSION['loginSession'] = false;

            header("Location: /frontend/login.php");
        }

        $statement->close();
        $connection->close();
    }
?>