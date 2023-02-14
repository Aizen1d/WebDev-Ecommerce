<?php
    session_start();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $fullName = $firstName . " " . $lastName;
        $phoneNumber = $_POST['phonenumber'];
        $postalCode = $_POST['postalcode'];

        $region = $_POST['region'];
        $province = $_POST['province'];
        $city = $_POST['city'];
        $barangay = $_POST['barangay'];
        $houseAddress = $_POST['houseAddress'];

        $userID = $_SESSION['loginID'];

        // database connection
        $connection = new mysqli("localhost", "root", "", "e-commercedb");
        if ($connection->connect_error) {
            die("Failed to connect : ".$connection->connect_error);
        }
        $checkIfExisting = "SELECT * FROM address WHERE userID = ?";

        $statementCheckIfExisting = $connection->prepare($checkIfExisting);
        $statementCheckIfExisting->bind_param("i", $userID);
        $statementCheckIfExisting->execute();

        $result = $statementCheckIfExisting->get_result();

        if ($result->num_rows > 0) {
             // The userID is already present in the table
            $sql = "UPDATE address SET fullName = ?, phoneNumber = ?, postalCode = ?, houseAddress = ?, region = ?, province = ?, city = ?, barangay = ? WHERE userID = ?";
            $statementUpdateData = $connection->prepare($sql);
            $statementUpdateData->bind_param("ssssssssi", $fullName, $phoneNumber, $postalCode, $houseAddress, $region, $province, $city, $barangay, $userID);
            $statementUpdateData->execute();

            $statementUpdateData->close();
        } 
        else {
            // The userID is not present in the table
            $statementCreateNewData = $connection->prepare("INSERT INTO address(userID, fullName, phoneNumber, postalCode, houseAddress, region, province, city, barangay) 
            values(?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $statementCreateNewData->bind_param("issssssss", $userID, $fullName, $phoneNumber, $postalCode, $houseAddress, $region, $province, $city, $barangay);
            $statementCreateNewData->execute();

            $statementCreateNewData->close();
        }

        $_SESSION['save-profile-successful'] = true;
        header("Location: get-user-profile.php");
        $connection->close();
    }
?>