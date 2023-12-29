<?php
include_once('../connection/connection.php');

if (isset($_POST['complain_id'])) {
    $complainId = $_POST['complain_id'];

    // Delete the complaint from the database
    $deleteQuery = "DELETE FROM complain WHERE id = $complainId";
    $deleteExe = mysqli_query($con, $deleteQuery);

    if ($deleteExe) {
        echo json_encode(['status' => 'Success']);
    } else {
        echo json_encode(['status' => 'Error']);
    }
}
?>
