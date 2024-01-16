<?php
// Include the database connection
include('../connection/connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $userId = $_POST["fake_user"];
    $description = $_POST["description"];

    // Prepare and execute an SQL INSERT statement
    $sql = "INSERT INTO feedback (userid, description) VALUES (?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $userId, $description);

    if ($stmt->execute()) {
        // Feedback data inserted successfully
        header("Location: ".$_SERVER['HTTP_REFERER']); // Redirect back to the same page
        exit();
    } else {
        // Error occurred while inserting data
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}
?>
