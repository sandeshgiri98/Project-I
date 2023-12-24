<?php
include_once('../dashboard_a/admin_dash.php');
include_once('../connection/connection.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['contact'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $userId = $_GET['id'];

    $updateQuery = "UPDATE register SET name='$name', email='$email', phone='$phone', dob='$dob', password='$password', role='$role' WHERE id='$userId'";
    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        // Successfully updated
        echo "<script>alert('User Updated Successfully!'); window.location.href='../dashboard_a/userdetails.php';</script>";
    } else {
        // Failed to update data
        echo "<script>alert('Failed to update user.'); window.location.href='../dashboard_a/userdetails.php';</script>";
    }
}

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Retrieve the user's information from the database
    $selectQuery = "SELECT id, name, email, phone, dob, password, role FROM register WHERE id = '$userId'";
    $selectExe = mysqli_query($con, $selectQuery);
    $user = mysqli_fetch_assoc($selectExe);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="../register/userregister.css">
    <link rel="stylesheet" href="../dashboard_a/style.css">
    <style>
    .error {
        display: none;
        color: red;
        font-size: 12px;
        margin-top: 5px;
    }

    .error.active {
        display: block;
        border-radius: 3px;
        border-color: red;
    }
    </style>
</head>

<body>
<div class="main-content">
    <div class="form-content">
        <form id="registration-form" action="" method="POST" onsubmit="return validateForm()">
            <h3>Update User</h3>

            <div class="textfield">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required placeholder="Enter Your Name"
                    value="<?php echo $user['name']; ?>">
                <div class="error" id="name-error">Please enter a valid name</div>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Enter Your Email"
                    value="<?php echo $user['email']; ?>">
                <div class="error" id="email-error">Please enter a valid email address</div>

                <label for="contact">Contact No</label>
                <input type="tel" id="contact" name="contact" required placeholder="Enter Your Phone Number"
                    value="<?php echo $user['phone']; ?>">
                <div class="error" id="contact-error">Please enter a valid phone number</div>

                <label for="dob">Date of birth</label>
                <input type="date" id="dob" name="dob" required value="<?php echo $user['dob']; ?>">
                <div class="error" id="dob-error">Please enter your date of birth</div>

                <label for="password">Password</label>
                <input type="text" id="password" name="password" required placeholder="Password"
                    value="<?php echo $user['password']; ?>">
                <div class="error" id="password-error">Use at least 8 characters with special characters like @, !,
                    or # and numbers like 1, 2, or 3</div>

                <!-- <label for="repassword">Repassword</label>
                <input type="text" id="repassword" name="repassword" required placeholder="Confirm your password"
                    value="<php echo $user['password']; ?>">
                <div class="error" id="repassword-error">Password and Repassword doesn't match.</div> -->

                <label for="role">Role</label>
                <select name="role" id="role" class="roles" required>
                    <option value="student" <?php if ($user['role'] == 'student') echo 'selected'; ?>>Student</option>
                    <option value="teacher" <?php if ($user['role'] == 'teacher') echo 'selected'; ?>>Teacher</option>
                    <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                </select>

            </div>
            <input type="submit" name="submit" value="Update User" class="form-button">
        </form>
    </div>
    <script src="../dashboard_a/user-validation.js"></script>
</div>
</body>

</html>