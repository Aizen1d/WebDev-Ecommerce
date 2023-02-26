<?php
    session_start();
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $birthdate = $_POST['bday'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $errors = array();
    $saveData = array();

    // database connection
    $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/backend/database-connection.php";
            include_once($path);

        // check if username is already taken
        $checkUsername = $connection->prepare("SELECT * FROM users WHERE username = ?");
        $checkUsername->bind_param("s", $username);
        $checkUsername->execute();
        $usernameResult = $checkUsername->get_result();

        $checkEmail = $connection->prepare("SELECT * FROM users WHERE email = ?");
        $checkEmail->bind_param("s", $email);
        $checkEmail->execute();
        $emailResult = $checkEmail->get_result();

        // validations for register form
        if ($usernameResult->num_rows > 0) {
            $errors['username-taken'] = "Username is already taken.";
        }
        if ($emailResult->num_rows > 0) {
            $errors['email-taken'] = "Email is already in use.";
        }
        if (strlen($password) < 5) {
            $errors['short-password'] = "Password must contain at least 6 characters.";
        }
        
        if(count($errors) > 0) { // if errors occurs
            $_SESSION['errors'] = $errors;
            $saveData['loadFirstName'] = $firstName;
            $saveData['loadLastName'] = $lastName;
            $saveData['loadBirthdate'] = $birthdate;

            if(!$errors['username-taken']) {
                $saveData['loadUserName'] = $username;
            }
            if(!$errors['email-taken']) {
                $saveData['loadEmail'] = $email;
            }

            $_SESSION['saveData'] = $saveData;
            header("Location: /frontend/register.php");
        }
        else {
            // clean up previous validation errors, if everything's fine
            unset($_SESSION['errors']);
            
            $birthdate = date("F j, Y", strtotime($birthdate));

            $statement = $connection->prepare("insert into users(firstName, lastName, birthdate, email, username, password) 
            values(?, ?, ?, ?, ?, ?)");
            $statement->bind_param("ssssss", $firstName, $lastName, $birthdate, $email, $username, $password);
            $statement->execute();
            
            $_SESSION['register-successful'] = true;
            header("Location: /frontend/login.php");

            $statement->close();
        }
        
        $connection->close();
        $checkUsername->close();
        $checkEmail->close();
?>
