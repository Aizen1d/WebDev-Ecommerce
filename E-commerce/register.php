<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

     <link rel="stylesheet" type="text/css" href="register.css">
     
    <title>Register Page</title>
</head>
<body>
    <div class="login">

        <h1 class="text-center">REGISTER</h1>

        <form class="needs-validation" action="process-register.php" method="post" novalidate>
            <div class="row name">
                <div class="col-6 form-group">
                    <label class="form-label" for="firstname">First Name</label>
                    <input class="form-control" type="firstname" id="firstname" name="firstName" 
                    value="<?php if(isset($_SESSION['saveData']['loadFirstName'])) { echo $_SESSION['saveData']['loadFirstName']; } ?>" required>
                    <div class="invalid-feedback">
                        Please enter your first name.
                    </div>

                </div>
                <div class="col-6 form-group">
                    <label class="form-label" for="lastname">Last Name</label>
                    <input class="form-control" type="lastname" id="lastname" name="lastName" 
                    value="<?php if(isset($_SESSION['saveData']['loadLastName'])) { echo $_SESSION['saveData']['loadLastName']; } ?>" required>
                    <div class="invalid-feedback">
                        Please enter your last name.
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="bday">Birth Date</label>
                <input class="form-control" type="date" name="bday" placeholder="dd-mm-yyyy" min="1997-01-01" max="2030-12-31" name="birthDate"
                value="<?php if(isset($_SESSION['saveData']['loadBirthdate'])) { echo $_SESSION['saveData']['loadBirthdate']; } ?>" required>
                <div class="invalid-feedback">
                    Please enter your birthdate.
                </div>
            </div>  
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input class="form-control" type="email" id="email" name="email" 
                value="<?php if(isset($_SESSION['saveData']['loadEmail'])) { echo $_SESSION['saveData']['loadEmail']; } ?>" required>
                <div class="invalid-feedback invalid-email">
                    Please enter your email.
                </div>

                <?php if(isset($_SESSION['errors']['email-taken'])) { ?> 
                    <h2 class="invalid-register email-taken"><?php echo $_SESSION['errors']['email-taken'];?></h2>
                <?php } ?>

            </div>
            <div class="form-group">
                <label class="form-label" for="username">Username</label>
                <input class="form-control" type="username" id="username" name="username" 
                value="<?php if(isset($_SESSION['saveData']['loadUserName'])) { echo $_SESSION['saveData']['loadUserName']; } ?>" required>

                <div class="invalid-feedback">
                    Please enter your username.
                </div>

                <?php if(isset($_SESSION['errors']['username-taken'])) { ?> 
                    <h2 class="invalid-register username-taken"><?php echo $_SESSION['errors']['username-taken'];?></h2>
                <?php } ?>   

            </div>
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input class="form-control" type="password" id="password" name="password" required>
                <div class="invalid-feedback invalid-password">
                    Please enter your password.
                </div>

                <?php if(isset($_SESSION['errors']['short-password'])) { ?> 
                    <h2 class="invalid-register short-password"><?php echo $_SESSION['errors']['short-password'];?></h2>
                <?php } ?>  

            </div>
            <div class="text-center butones">
                <input class="btn loginbt w-75" type="submit" value="Create">
            </div>
            <div class="text-center text">Already have an account?
                <a href="login.php" class="create">Sign in.</a>
            </div>
        </form>
    </div>

    <?php 
        // if reloaded clears the session
        unset($_SESSION['errors']);
        unset($_SESSION['saveData']);
    ?>

    <script>
    let forms = document.querySelectorAll(".needs-validation");

    Array.prototype.slice.call (forms).forEach (function(form){
        form.addEventListener ("submit", function(event){
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            let getUsernameError = document.getElementsByClassName("username-taken");
            let getEmailError = document.getElementsByClassName("email-taken");
            let getPasswordError = document.getElementsByClassName("short-password");

            if (getUsernameError[0]) {
                getUsernameError[0].innerHTML = "";
            }
            if (getEmailError[0]) {
                getEmailError[0].innerHTML = "";
            }
            if (getPasswordError[0]) {
                getPasswordError[0].innerHTML = "";
            }
        }
        form.classList.add("was-validated");
        });
    });
    </script>   

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>