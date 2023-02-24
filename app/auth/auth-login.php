<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../main.css">
    <title>Login</title>
</head>
<body>
    <div class="grid-container">
        <!-- <div class="test">test</div> -->
        <div class="auth-win columns is-desktop">
            <div class="img-regis"></div>
            <div class="form-regis">

                <h2>Login</h2>
                <!-- FORM ACTION -->
                <form action="../login_db.php" method="post">
                    
                    <!-- <label>Username</label> -->
                    <div class="input-container">
                        <input type="text" name="username" required=""/>
                        <label>Username</label>		
                    </div>

                    <!-- <label>Password</label> -->
                    <div class="input-container">
                        <input type="password" name="password" required=""/>
                        <label>Password</label>		
                    </div>

                    <div class="action">
                        <button type="submit" name="login_user" class="btn">Login</button>
                        <span>Don't have an account ? <a href="../auth/auth-register.php">Sign up</a></span>
                    </div>
                </form>
            </div>
        </div>

        <button type="button" class="btn"><h2><a href="#">Back to Website</a></h2></button>
    </div>
</body>
</html>