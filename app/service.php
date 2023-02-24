<?php 
    session_start();

    if (isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header('location: ../app/auth/auth-login.php');
    }

    if (isset($_GET['login'])){
        header('location: ../app/auth/auth-login.php');
    }
?>