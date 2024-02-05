<?php
session_start();
include_once('../register/connection.php');

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    header("Location: ../login/login.php");
    exit();
}

// Check if the delete button is clicked (sent via AJAX)
if (isset($_POST['delete'])) {
    $fakeUserID = $_SESSION['fake_user'];

    // Get the profile_image filename from the database
    $selectQuery = "SELECT profile_image FROM register WHERE fake_user = '$fakeUserID'";
    $selectExe = mysqli_query($con, $selectQuery);
    $user = mysqli_fetch_assoc($selectExe);
    $img = $user['profile_image'];

    // Delete the profile picture file from the server
    $target_directory = "../photoes/";
    $target_file = $target_directory . $img;
    if (file_exists($target_file)) {
        unlink($target_file);
    }

    // Update the profile_image column in the database to remove the profile picture
    $updateQuery = "UPDATE register SET profile_image=NULL WHERE fake_user='$fakeUserID'";
    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        echo "Profile Picture Deleted Successfully!";
    } else {
        echo "Failed to delete profile picture.";
    }
}
