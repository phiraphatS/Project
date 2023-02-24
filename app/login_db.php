<?php
    session_start();
    include('connect.php');
    include('test.php');


    $errors = array();

    if (isset($_POST['login_user'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        

        if (empty($username)){
            array_push($errors,"Username is required");
        }
        if (empty($password)){
            array_push($errors,"Password is required");
        }
        if (count($errors) == 0) {
            $password = md5($password);

            debug_to_console("password" . $password);
            debug_to_console("username" . $username);

            $query = "SELECT * FROM fasion_user WHERE USER_NAME = '$username' AND PASSWORD = '$password'";
            $db_query = mysqli_query($conn, $query);

            if(mysqli_num_rows($db_query) == 1){
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "Your are now logged in";

                $result = mysqli_fetch_assoc($db_query);
                switch($result['USER_TYPE']) {
                    case 1: header("location: ../app/admin/admin-home.php");
                        break;
                    default : header("location: ../app/customer/customer-home.php");
                        break;
                }
               
            }else{
                array_push($errors, "Wrong username/password combination");
                $_SESSION['error'] = "Wrong username or password try again!";
                header("location: ../app/auth/auth-login.php");
            }
        }
    }

?>