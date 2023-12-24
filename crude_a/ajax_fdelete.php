<?php
// Include your database connection here
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['feedbackUserId'])) {
    $feedbackUserId = $_POST['feedbackUserId'];

    // Prepare and execute the DELETE query
    $deleteQuery = "DELETE FROM feedback WHERE userid = ?";
    $stmt = mysqli_prepare($con, $deleteQuery);
    mysqli_stmt_bind_param($stmt, 'i', $feedbackUserId);

    if (mysqli_stmt_execute($stmt)) {
        // Deletion successful
        echo "Feedback entry with UserId $feedbackUserId has been deleted successfully.";
    } else {
        // Deletion failed
        echo "Error deleting feedback entry.";
    }

    // Close statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($con);
} else {
    // Invalid request
    echo "Invalid request.";
}
?>
