<?php
// Database connection parameters
$host = "localhost"; // Replace with your database host
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "complaint_project"; // Replace with your database name

// Create a database connection
$con = mysqli_connect($host, $username, $password, $dbname);


// Now you can use the $con connection object to perform database operations


// ... (Your database connection code remains the same)

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['fake_user'])) {
        // Sanitize and validate the user input
        $user_id = trim($_POST['fake_user']);
        $user_id = mysqli_real_escape_string($con, $user_id); // Sanitize input

        // Prepare the SQL query
        $sql = "SELECT COUNT(*) FROM register WHERE fake_user = '$user_id'";

        // Execute the query
        $result = mysqli_query($con, $sql);

        if (!$result) {
            // Handle any database errors
            echo "Error: " . mysqli_error($con);
        } else {
            // Fetch the result
            $row = mysqli_fetch_array($result);

            // Provide a meaningful response
            if ($row[0] > 0) {
                echo "";
            } else {
                echo "Invalid User ID";
            }

            // Free the result set
            mysqli_free_result($result);
        }
    } else {
        // 'fake_user' parameter is not set in the POST request
        echo "Missing 'fake_user' parameter.";
    }
}
?>


