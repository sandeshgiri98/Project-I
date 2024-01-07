<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
</head>
<body>
    
</body>
</html>
<body>
    <?php include_once('../dashboard_a/admin_dash.php'); ?>

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
        echo "<script>alert('Error Admin! Email or Number Already Exists.'); window.location.href='adduser.php';</script>";
    } else {
        // User does not exist, proceed with registration
        $sql = "INSERT INTO register (name, email, phone, dob, password, role) VALUES ('$name', '$email', '$phone', '$dob', '$password', '$role')";
        $query = $con->query($sql);

        if (!$query) {
            // Failed to insert data
            echo "<script>alert('User couldn't added due to some problem.'); window.location.href='adduser.php';</script>";
        } else {
            // Successfully registered
            echo "<script>alert('User Added Successfully!'); window.location.href='adduser.php';</script>";
        }
    }
    ?>
    

</body>
</html>
