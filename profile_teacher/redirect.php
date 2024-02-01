<?php
include_once('../teacher_dashboard/student_dash.php');
include_once('../register/connection.php');

// Check if the form was submitted
if (isset($_POST['submit'])) {
    $image = $_FILES['image']['name'];

    //target directory and file path
    $target_directory = "../photoes/";
    $target_file = $target_directory . $image;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {

        // Update the profile_image column in the database
        
        $updateQuery = "UPDATE register SET profile_image='$image' WHERE fake_user = ?";
        $stmt = $con->prepare($updateQuery);
        $stmt->bind_param("s", $_SESSION['fake_user']);

        if ($stmt->execute()) {
            echo "<script>alert('Profile Picture Added Successfully!'); window.location.href='../profile_teacher/profile_setting.php';</script>";
            exit();
        } else {
            echo "<script>alert('Failed to Upload.'); window.location.href='../profile_teacher/profile_setting.php';</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Error moving uploaded file.'); window.location.href='../profile_teacher/profile_setting.php';</script>";
    }
}

$con->close();
?>