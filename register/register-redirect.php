<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="popupp.css">
    <style>
    #regerror-popup {
        background: rgb(243, 239, 239);
        border-radius: 5px;
        max-width: 300px;
        text-align: center;
        margin: 70px auto;
        padding: 40px;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
    }
    </style>
</head>

<body>

    <div id="success-popup" style="display: none;">
        <img src="../photoes/register.gif" class="invalid" alt="Image Not found">
        <h2>Registered Successful!</h2>
        <p>Welcome to Login Page.</p>
    </div>
    <div id="error-popup" style="display: none;">
        <img src="../photoes/wrong.gif" class="invalid" alt="Image Not found">
        <h2 class="incorrect">Error ! <br>Please Check Credentials</h2>
        <p>Please try again.</p>
    </div>
    <div id="regerror-popup" style="display: none;">
        <img src="../photoes/wrong.gif" class="invalid" alt="Image Not found">
        <h2 class="incorrect">Error ! <br>Email or Number Already Exists</h2>
        <p>Please try to Register again with different Credentials.</p>
    </div>


    <?php
    include_once('connection.php');

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['contact'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Check if user already exists with the same email or phone number
    $checkQuery = "SELECT * FROM register WHERE email = '$email' OR phone = '$phone'";
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // User already exists, show error message
        echo "<script>
                document.getElementById('regerror-popup').style.display='block';
                setTimeout(function(){
                    window.location.href='Register.php'; 
                }, 1800);
              </script>";
    } else {
        // User does not exist, proceed with registration
        $sql = "INSERT INTO register (name, email, phone, dob, password, role) VALUES ('$name', '$email', '$phone', '$dob', '$password', '$role')";
        $query = $con->query($sql);

        if (!$query) {
            // Failed to insert data
            echo "<script>
                    document.getElementById('error-popup').style.display='block';
                    setTimeout(function(){
                        window.location.href='Register.php'; 
                    }, 1800);
                  </script>";
        } else {
            // Successfully registered
            echo "<script>
                    document.getElementById('success-popup').style.display='block';
                    setTimeout(function(){ 
                        window.location.href='../login/login.php'; 
                    }, 1600);
                  </script>";
        }
    }
?>

</body>

</html>