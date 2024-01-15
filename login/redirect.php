<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="popup.css">
    <style>
        .sadmin_popup,
    .admin_popup,
    .teacher_popup,
    .student_popup {
        background: #fff;
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
    <div id="ssuccess-popup" class="student_popup" style="display: none;">
        <img src="../photoes/tick.gif" alt="Image Not found">
        <h2>Login Successful!</h2>
        <p>Welcome to Student page.</p>
    </div>

    <div id="tsuccess-popup" class="teacher_popup" style="display: none;">
        <img src="../photoes/tick.gif" alt="Image Not found">
        <h2>Login Successful!</h2>
        <p>Welcome to Teacher page.</p>
    </div>

    <div id="asuccess-popup" class="admin_popup" style="display: none;">
        <img src="../photoes/tick.gif" alt="Image Not found">
        <h2>Login Successful!</h2>
        <p>Welcome to Admin page.</p>
    </div>

    <div id="sasuccess-popup" class="sadmin_popup" style="display: none;">
        <img src="../photoes/tick.gif" alt="Image Not found">
        <h2>Login Successful!</h2>
        <p>Welcome to Super Admin page.</p>
    </div>

    <div id="error-popup" style="display: none;">
        <img src="../photoes/wrong.gif" class="invalid" alt="Image Not found">
        <h2 class="incorrect">Incorrect <br>Email or Password</h2>
        <p>Please try again.</p>
    </div>

    <!-- PHP for the login popup -->
    <?php
    session_start();
    include("../register/connection.php");

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize user inputs to prevent SQL injection
    $email = mysqli_real_escape_string($con, $email);
    $password = mysqli_real_escape_string($con, $password);

    $emailQuery = "SELECT * FROM register WHERE email='$email' AND password='$password'";
    $emailExe = mysqli_query($con, $emailQuery);

    if (mysqli_num_rows($emailExe) > 0) {
        $row = mysqli_fetch_assoc($emailExe);
        $userType = $row['role'];

        // Update last login time
        $userId = $row['id'];
        $updateQuery = "UPDATE register SET last_login_time = CURRENT_TIMESTAMP WHERE id = $userId";
        mysqli_query($con, $updateQuery);

        // Store user information in session variables
        $_SESSION['user_id'] = $userId;
        $_SESSION['role'] = $userType;
        $_SESSION['user_name'] = $row['name'];

        // Set popup and redirection details based on user role
        $popupId = '';
        $redirectUrl = '';

        if ($userType == 'Super Admin') {
            $popupId = 'sasuccess-popup';
            $redirectUrl = '../dashboard_a/content.php';
        } elseif ($userType == 'admin') {
            $popupId = 'asuccess-popup';
            $redirectUrl = '../dashboard/content.php';
        } elseif ($userType == 'teacher') {
            $popupId = 'tsuccess-popup';
            $redirectUrl = '../teacher_dashboard/scontent.php';
        } elseif ($userType == 'student') {
            $popupId = 'ssuccess-popup';
            $redirectUrl = '../student_dashboard/scontent.php';
        }

        // Display the appropriate popup and perform server-side redirect
        echo "<script>
            document.getElementById('$popupId').style.display='block';
            setTimeout(function(){ 
                window.location.href='$redirectUrl'; 
            }, 1600);
        </script>";
        exit();
    } else {
        // Incorrect email or password
        echo "<script>
            document.getElementById('error-popup').style.display='block';
            setTimeout(function(){
                window.location.href='login.php'; 
            }, 1000);
        </script>";
        exit();
    }
    ?>
</body>

</html>