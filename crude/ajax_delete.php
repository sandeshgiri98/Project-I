<?php
include_once('../connection/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $userId = $_POST['id'];

   
    $currentUser = 123; 
    if ($userId == $currentUser) {
 
        echo json_encode(['status' => 'error', 'message' => 'Error! User ID not deleted.']);
        exit;
    }
    $deleteQuery = "DELETE FROM register WHERE id = $userId";
    $deleteExe = mysqli_query($con, $deleteQuery);

    if ($deleteExe) {

        echo json_encode(['status' => 'success', 'message' => 'User deleted successfully.']);
        exit;
    } else {
  
        echo json_encode(['status' => 'error', 'message' => 'Error deleting user.']);
        exit;
    }
}
