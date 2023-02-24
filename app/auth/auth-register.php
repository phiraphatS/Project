<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../auth/style.css">
    <link rel="stylesheet" href="../main.css">
    <title>Register</title>
</head>
<body>
    <div class="grid-container">
        <div class="auth-win columns is-desktop">
            <div class="img-regis"></div>
            <div class="form-regis">
                <h2>Register</h2>
                <!-- FORM ACTION -->
                <form action="../register_db.php" method="post">

                    <!-- <label>Username</label> -->
                    <div class="input-container">
                        <input type="text" name="username" required=""/>
                        <label>Username</label>		
                    </div>

                    <!-- <label>Password</label> -->
                    <div class="input-container">
                        <input type="password" name="password_1" required=""/>
                        <label>Password</label>		
                    </div>

                    <!-- <label>Confirm Password</label> -->
                    <div class="input-container">
                        <input type="password" name="password_2" required=""/>
                        <label>Confirm Password</label>		
                    </div>

                    <!-- <label>Email</label> -->
                    <div class="input-container">
                        <input type="email" name="email" required=""/>
                        <label>Email</label>		
                    </div>

                    <div class="action">
                        <button type="submit" name="reg_user" class="btn">Register</button>
                        <span>Already have an account ? <a href="../auth/auth-login.php">Sign in</a></span>
                    </div>
                </form>
                
            </div>
        </div>

        <button type="button" class="btn"><h2><a href="#">Back to Website</a></h2></button>
    </div>

    <!-- PHP -->
    <?php include '../connect.php';?>

</body>
</html>