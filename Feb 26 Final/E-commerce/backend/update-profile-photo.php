<?php
session_start();

if (isset($_FILES["photo"])) {
    $userID = $_SESSION['loginID'];
    $photo = $_FILES['photo'];
    $profileUpdateErrors = array();
    
    $fileName = $photo['name'];
    $fileType = $photo['type'];
    $fileTmpName = $photo['tmp_name'];
    $fileError = $photo['error'];
    $fileSize = $photo['size'];

    $allowed = array('jpeg', 'png', 'jpg');
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    
    if (in_array($ext, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1024 * 1024 * 2) {
                
                $data = file_get_contents($fileTmpName);
                $data = base64_encode($data);
                
                // database connection
                $path = $_SERVER['DOCUMENT_ROOT'];
                $path .= "/backend/database-connection.php";
                include_once($path);

                // update the photo for the user
                $statementUpdatePhoto = $connection->prepare("UPDATE users SET photo = ? WHERE userID = ?");
                $statementUpdatePhoto->bind_param("si", $data, $userID);
                $statementUpdatePhoto->execute();
                
                $statementUpdatePhoto->close();
                $connection->close();

                $_SESSION['profilePhotoUpdateSuccess'] = "Profile photo updated successfully.";
                
            } 
            else {
                $profileUpdateErrors['profilePhotoSizeExceed'] = "The file is too large, 2mb is the limit.";
            }
        } 
        else {
            $profileUpdateErrors['profilePhotoUploadingError'] = "There was an error uploading your photo.";
        }
    } 
    else {
        $profileUpdateErrors['profilePhotoNotSupported'] = "File type you uploaded is not supported.";
    }

    $_SESSION['profileUpdateErrors'] = $profileUpdateErrors;
    header("Location: get-user-profile.php");
}
?>