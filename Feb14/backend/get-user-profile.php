<?php 
    session_start();

    $userID = $_SESSION['loginID'];
    $username = $_SESSION['loginUsername'];

    $userProfileData = array();
    $userRecipientsAddress = array();

    // database connection
    $connection = new mysqli("localhost", "root", "", "e-commercedb");
    if ($connection->connect_error) {
        die("Failed to connect : ".$connection->connect_error);
    }

    $statement = $connection->prepare("SELECT * FROM users WHERE userID = ?");
    $statement->bind_param("i", $userID);
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $userProfileData['userFirstName'] = $row['firstName'];
        $userProfileData['userLastName'] = $row['lastName'];
        $userProfileData['userEmail'] = $row['email'];
        $userProfileData['userBirthdate'] = $row['birthdate'];

        $_SESSION['userProfileData'] = $userProfileData;

    }

    $statement2 = $connection->prepare("SELECT * FROM address WHERE userID = ?");
    $statement2->bind_param("i", $userID);
    $statement2->execute();
    $result2 = $statement2->get_result();

    if ($result2->num_rows > 0) {
        $row = $result2->fetch_assoc();

        $fullName = $row['fullName'];
        $fullNameSplit = explode(' ', $fullName);

        $userRecipientsAddress['recipientsFirstName'] = $fullNameSplit[0];
        $userRecipientsAddress['recipientsLastName'] = $fullNameSplit[1];
        $userRecipientsAddress['recipientsPhoneNumber'] = $row['phoneNumber'];
        $userRecipientsAddress['recipientsPostalCode'] = $row['postalCode'];
        $userRecipientsAddress['recipientsHouseAddress'] = $row['houseAddress']; 
        $userRecipientsAddress['recipientsRegion'] = $row['region']; 
        $userRecipientsAddress['recipientsProvince'] = $row['province']; 
        $userRecipientsAddress['recipientsCity'] = $row['city']; 
        $userRecipientsAddress['recipientsBarangay'] = $row['barangay']; 

        $_SESSION['userRecipientsAddress'] = $userRecipientsAddress;

    }

    $stmt = $connection->prepare("SELECT photo FROM users WHERE userID = ?");
    $stmt->bind_param('i', $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($row["photo"] !== NULL) {
            $imageData = base64_decode($row["photo"]);
            $_SESSION['userProfilePhoto'] = $imageData;
        }

        $stmt->close();
    }

    header("Location: /frontend/profile.php");
?>