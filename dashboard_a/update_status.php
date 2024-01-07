<?php
include_once('../connection/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $complainId = $_POST['complain_id'];
    $newStatus = $_POST['new_status'];

    // Perform the update query
    $updateQuery = "UPDATE complain SET status = '$newStatus' WHERE id = $complainId";
    mysqli_query($con, $updateQuery);

    // Respond with a success status
    echo "Status updated successfully";
}
?>
