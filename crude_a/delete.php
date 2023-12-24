<?php
include_once('../admin_dashboard/connection.php');

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
        $deleteQuery = "DELETE FROM register WHERE id = '$userId'";
        $deleteExe = mysqli_query($con, $deleteQuery);

        if ($deleteExe) {
            echo "<script>alert('User deleted successfully.'); window.location.href = '../admin_dashboard/userdetails.php';</script>";
        } else {
            echo "<script>alert('Failed to delete user.'); window.location.href = '../admin_dashboard/userdetails.php';</script>";
        }
    } else {
        echo "<script>
                if (confirm('Are you sure you want to delete this user?')) {
                    window.location.href = 'delete.php?id=$userId&confirm=yes';
                } else {
                    window.location.href = '../admin_dashboard/userdetails.php';
                }
            </script>";
    }
}
?>