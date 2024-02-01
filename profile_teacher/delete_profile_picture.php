<?php
session_start();
include_once('../register/connection.php');

if (!isset($_SESSION['user_name'])) {
    header("Location: ../login/login.php");
    exit();
}

if (isset($_SESSION['fake_user'])) {
    $fakeUserID = $_SESSION['fake_user'];

    // Check if the user has a profile picture
    $selectQuery = "SELECT profile_image FROM register WHERE fake_user = '$fakeUserID'";
    $selectExe = mysqli_query($con, $selectQuery);
    $user = mysqli_fetch_assoc($selectExe);

    if ($user['profile_image']) {
        // Delete the profile picture file from the server
        $profileImage = $user['profile_image'];
        if ($profileImage && file_exists("../photoes/$profileImage")) {
            unlink("../photoes/$profileImage");
        }

        // Set the profile_image column to NULL in the database
        $updateQuery = "UPDATE register SET profile_image=NULL WHERE fake_user='$fakeUserID'";
        $updateResult = mysqli_query($con, $updateQuery);

        if ($updateResult) {
            echo "Profile Picture deleted successfully!";
        } else {
            echo "Failed to delete profile picture.";
        }
    } else {
        echo "No profile picture found to delete.";
    }
} else {
    echo "User not authenticated.";
}
?>
