<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

     <link rel="stylesheet" type="text/css" href="css/login.css">
     
    <title>Login Page</title>
</head>
<body>

    <?php
        // redirect to home and prevent from going to login if login-ed

        if (isset($_SESSION['loginSession']) && $_SESSION['loginSession'] == true) {
            header("Location: home.php");
            exit;
        }
    ?>
    
    <?php // show message after successful register ?>
    
    <?php if (isset($_SESSION['register-successful'])) : ?>
            <div class="alert alert-success fixed-top" role="alert" style="text-align:center; font-size: 18px;">
            Registration successful!
            </div>
        <?php unset($_SESSION['register-successful']); ?>
    <?php endif; ?>

    <div class="login">

        <h1 class="text-center">LOGIN</h1>

        <?php if (isset($_SESSION['login-errors']['invalid-login'])) { ?>   
     		<h2 class="invalid_login"><?php echo $_SESSION['login-errors']['invalid-login']; ?></h2>
     	<?php } ?>

        <form class="needs-validation" action="/backend/process-login.php" method="post" novalidate>
            <div class="form-group">
                <label class="form-label" for="username">Username</label>
                <input class="form-control" type="username" id="username" name="username" 
                value="<?php if(isset($_SESSION['saveData']['loadUserName'])) { 
                        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                            echo $_SESSION['saveData']['loadUserName']; 
                            } 
                        }
                    ?>" required>
                <div class="invalid-feedback">
                    Please enter your username.
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input class="form-control" type="password" id="password" name="password" required>
                <div class="invalid-feedback">
                    Please enter your password.
                </div>

            </div>
            
            <div class="form-group form-check">
                <input class="form-check-input" type="checkbox" id="check">
                <label class="form-check-label" for="check">Remember me</label>
            </div>

            <div class="text-center butones">
                <input class="btn loginbt w-75" type="submit" value="Login">
            </div>

            <div class="text-center text">Don't have an account?
                <a href="register.php" class="create">Sign up.</a>
            </div>
        </form>
    </div>
    
    
    <?php 
        // remove warnings, etc when page is reloaded.
        unset($_SESSION['login-errors']); 
        unset($_SESSION['register-successful']);
        unset($_SESSION['saveData'])
    ?>

    <script>
        let forms = document.querySelectorAll(".needs-validation");
        Array.prototype.slice.call (forms).forEach (function(form) {
            form.addEventListener ("submit", function(event){
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                    let loginFailed = document.getElementsByClassName("invalid_login");

                    if (loginFailed[0]) {
                        loginFailed[0].innerHTML = "";
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