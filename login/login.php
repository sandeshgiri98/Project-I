<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="error.css">
</head>

<body>
    <div class="form-content">
        <form class="login_form" action="redirect.php" method="POST" name="form" onsubmit="return validate()">
            <h3 class="heading-box">LOGIN</h3>
            <div class="textfield">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Registered Email Address">

                <div id="email-error">Please fill up your Email</div>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password">

                <div id="pass-error">Please fill up your Password</div>
            </div>
            <!-- <div>
                <input type="checkbox" class="check-box"><span> Remember Password</span>
             </div>   -->
            <!-- <p class="register"><a href="#">Forget Password</a></p>
            <br> -->
            <input type="submit" name="submit" value="Login" class="form-button">
        </form>
        <p class="register">Don't Have an account? <a href="../register/Register.php">Register</a></p>
    </div>
    <script src="../login/validation.js"></script>
</body>

</html>