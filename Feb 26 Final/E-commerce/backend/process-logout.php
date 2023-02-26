<?php
    session_start();
    session_unset();
    session_destroy();

    /*foreach($_SESSION as $key => $value) {
        if ($key !== 'cart') {
          unset($_SESSION[$key]);
        }
    }*/
      
    header("Location: /frontend/login.php");
?>