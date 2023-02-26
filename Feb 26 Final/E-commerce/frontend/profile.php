<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="css/profile.css">   
    <title>Profile Page</title>
</head>

<body>
    <?php
        // redirect to login and prevent from accessing profile

        if (!isset($_SESSION['loginSession']) && $_SESSION['loginSession'] == false) {
            header("Location: home.php");
            exit;
        }
    ?>

    <?php
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/frontend/navbar.php";
        include_once($path);
    ?>

    <?php if (isset($_SESSION['save-profile-successful'])) : ?>
        <div class="alert alert-success fixed-top" role="alert" style="text-align:center; font-size: 18px;">
            Saved successfully!
        </div>
        <?php unset($_SESSION['save-profile-successful']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['profilePhotoUpdateSuccess'])) : ?>
        <div class="alert alert-success fixed-top" role="alert" style="text-align:center; font-size: 18px;">
            <?php echo($_SESSION['profilePhotoUpdateSuccess']); ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['profileUpdateErrors']['profilePhotoSizeExceed'])) : ?>
        <div class="alert alert-danger fixed-top" role="alert" style="text-align:center; font-size: 18px;">
            <?php echo($_SESSION['profileUpdateErrors']['profilePhotoSizeExceed']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['profileUpdateErrors']['profilePhotoUploadingError'])) : ?>
        <div class="alert alert-danger fixed-top" role="alert" style="text-align:center; font-size: 18px;">
            <?php echo($_SESSION['profileUpdateErrors']['profilePhotoUploadingError']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['profileUpdateErrors']['profilePhotoNotSupported'])) : ?>
        <div class="alert alert-danger fixed-top" role="alert" style="text-align:center; font-size: 18px;">
            <?php echo($_SESSION['profileUpdateErrors']['profilePhotoNotSupported']); ?>
        </div>
    <?php endif; ?>

    <script>
        const messages = document.querySelectorAll('.alert');
        messages.forEach(message => {
            message.style.opacity = "0";
            setTimeout(() => {
                message.style.opacity = "1";
                message.style.transition = "opacity 0.6s ease";
            }, 500);
        });
    </script>

    <?php unset($_SESSION['profileUpdateErrors']); 
          unset($_SESSION['profilePhotoUpdateSuccess'])?>

    <div class="container profile-table">
        <div class="profile-menu">
            <div class="row">
                <div class="col-6">
                    <h1 class="profile-text">Profile</h1>
                </div>
                <div class="col-6 button">
                    <button class="save-button" type="submit" form="recipientform">Save All</button>
                </div>
            </div>

            <hr class="my-3" />
            
            <div class="profile-content row">
                <div class="col-6">
                    <div class="row py-2">
                        <label for="username" class="col-3 col-form-label text-end label">Username</label>
                        <div class="col">
                            <input type="text" readonly class="form-control-plaintext" 
                            value="<?php if(isset($_SESSION['loginUsername'])) { echo $_SESSION['loginUsername']; } ?>">
                        </div>
                    </div>
                    <div class="row py-2">
                        <label for="name" class="col-3 col-form-label text-end label">Name</label>
                        <div class="col">
                            <input type="text" readonly class="form-control-plaintext" 
                            value="<?php if(isset($_SESSION['userProfileData']['userFirstName']) && isset($_SESSION['userProfileData']['userLastName'])) { 
                                echo $_SESSION['userProfileData']['userFirstName'] . " " . $_SESSION['userProfileData']['userLastName'];} ?>">
                        </div>
                    </div>
                    <div class="row py-2">
                        <label for="email" class="col-3 col-form-label text-end label">Email</label>
                        <div class="col">
                            <input type="text" readonly class="form-control-plaintext" 
                            value="<?php if(isset($_SESSION['userProfileData']['userEmail'])) { echo $_SESSION['userProfileData']['userEmail']; } ?>" >
                        </div>
                    </div>
                    <div class="row py-2">
                        <label for="bday" class="col-3 col-form-label text-end label">Birth Date</label>
                        <div class="col">
                            <input type="text" readonly class="form-control-plaintext" 
                            value="<?php if(isset($_SESSION['userProfileData']['userBirthdate'])) { echo $_SESSION['userProfileData']['userBirthdate']; } ?>">
                        </div>
                    </div>
                    
                </div>

                <div class="col-3">
                    <div class="divider"></div>
                </div>
                
                <div class="col-3">
                    <form action="/backend/update-profile-photo.php" method="post" enctype="multipart/form-data">
                        <div class="pic">
                            <img id="preview" 
                            <?php if(isset($_SESSION['userProfilePhoto'])) { 
                                    echo ('src=data:image/jpeg;base64,'.base64_encode($_SESSION['userProfilePhoto']) ); } 
                                  else {
                                    echo ('src=/images/profilepic.jpg'); 
                                  }?>
                            width="150px" alt="" style="width: 150px; height: 150px; border: 2px solid #bbbbbb;">
                            <input type="file" id="file" name="photo" onchange="this.form.submit()" accept="image/png, image/jpeg"
                            onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
                            
                            <div class="button">
                                <label for="file" id="upload">Select Photo</label>
                            </div>
                        </div>
                    </form>       
                </div>
            </div>
        
            <h1>Recipient's Address</h1>

            <hr class="my-4" />

            <div class="row form">
                <div class="col-6">
                    <form class="needs-validation" id="recipientform" action="/backend/save-recipients-address.php" method="post" novalidate>
                        <div class="row left">
                            <div class="col-6 form-group">
                                <label class="form-label" for="firstname">First Name</label>
                                <input class="form-control" type="firstname" id="firstname" name="firstname" 
                                value="<?php if(isset($_SESSION['userRecipientsAddress']['recipientsFirstName'])) { 
                                    echo $_SESSION['userRecipientsAddress']['recipientsFirstName']; } ?>"required>
                                <div class="invalid-feedback">
                                    Please enter your first name.
                                </div>
                            </div>
                            <div class="col-6 form-group">
                                <label class="form-label" for="lastname">Last Name</label>
                                <input class="form-control" type="lastname" id="lastname" name="lastname"
                                value="<?php if(isset($_SESSION['userRecipientsAddress']['recipientsLastName'])) { 
                                    echo $_SESSION['userRecipientsAddress']['recipientsLastName']; } ?>" required>
                                <div class="invalid-feedback">
                                    Please enter your last name.
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <label class="form-label" for="phonenumber">Phone Number</label>
                                <input class="form-control" type="phonenumber" id="phonenumber" name="phonenumber" 
                                value="<?php if(isset($_SESSION['userRecipientsAddress']['recipientsPhoneNumber'])) { 
                                    echo $_SESSION['userRecipientsAddress']['recipientsPhoneNumber']; } ?>" required>
                                <div class="invalid-feedback">
                                    Please enter your phone number.
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <label class="form-label" for="code">Postal Code</label>
                                <input class="form-control" type="code" id="address" name="postalcode" 
                                value="<?php if(isset($_SESSION['userRecipientsAddress']['recipientsPostalCode'])) { 
                                    echo $_SESSION['userRecipientsAddress']['recipientsPostalCode']; } ?>" required>
                                <div class="invalid-feedback">
                                    Please enter your postal code.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="row right">
                            <div class="col-6 form-group">
                                <label class="form-label" for="region">Region</label>
                                <input class="form-control" type="region" id="region" name="region" 
                                value="<?php if(isset($_SESSION['userRecipientsAddress']['recipientsRegion'])) { 
                                    echo $_SESSION['userRecipientsAddress']['recipientsRegion']; } ?>"required>
                                <div class="invalid-feedback">
                                    Please enter your region.
                                </div>
                            </div>
                            <div class="col-6 form-group">
                                <label class="form-label" for="province">Province</label>
                                <input class="form-control" type="province" id="province" name="province" 
                                value="<?php if(isset($_SESSION['userRecipientsAddress']['recipientsProvince'])) { 
                                    echo $_SESSION['userRecipientsAddress']['recipientsProvince']; } ?>"required>
                                <div class="invalid-feedback">
                                    Please enter your province.
                                </div>
                            </div>
                            <div class="col-6 form-group">
                                <label class="form-label" for="city">City</label>
                                <input class="form-control" type="city" id="city" name="city" 
                                value="<?php if(isset($_SESSION['userRecipientsAddress']['recipientsCity'])) { 
                                    echo $_SESSION['userRecipientsAddress']['recipientsCity']; } ?>"required>
                                <div class="invalid-feedback">
                                    Please enter your city.
                                </div>
                            </div>
                            <div class="col-6 form-group">
                                <label class="form-label" for="barangay">Barangay</label>
                                <input class="form-control" type="barangay" id="barangay" name="barangay" 
                                value="<?php if(isset($_SESSION['userRecipientsAddress']['recipientsBarangay'])) { 
                                    echo $_SESSION['userRecipientsAddress']['recipientsBarangay']; } ?>"required>
                                <div class="invalid-feedback">
                                    Please enter your barangay.
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <label class="form-label" for="address">Street Name, Building, House No.</label>
                                <input class="form-control" type="address" id="address" name="houseAddress" 
                                value="<?php if(isset($_SESSION['userRecipientsAddress']['recipientsHouseAddress'])) { 
                                    echo $_SESSION['userRecipientsAddress']['recipientsHouseAddress']; } ?>"required>
                                <div class="invalid-feedback">
                                    Please enter your address.
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <?php
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/frontend/footer.php";
        include_once($path);
    ?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>