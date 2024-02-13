<?php

include_once('../connection/connection.php');


$selectQuery = "SELECT id, category, type, department, nature, image, complain_description, complaint_datetime,status, complain_user FROM complain WHERE id = $complaintId"; // Adjust the query as per your database schema and needs
$selectExe = mysqli_query($con, $selectQuery);

if ($selectExe) {
    $complaintData = mysqli_fetch_assoc($selectExe);
    
    // Output the JSON data
    header('Content-Type: application/json');
    echo json_encode($complaintData);
} else {
    
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Failed to fetch data'));
}
