<?php
include_once('../connection/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $complaintId = $_POST['complaintId'];
    $teacherId = $_POST['teacherId'];

    // Perform the database insert to assign the complaint to the teacher
    $insertQuery = "INSERT INTO complaint_assignment (complain_id, teacher_id) VALUES ($complaintId, $teacherId)";
    if (mysqli_query($con, $insertQuery)) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
