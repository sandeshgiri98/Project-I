<?php
session_start();
require_once('../connection/connection.php'); // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["complaint_id"]) && isset($_POST["comment_text"])) {
    // Check if the user is authenticated (you should have your authentication logic here)

    // Get the complaint ID, comment text, and user ID
    $complaintId = $_POST["complaint_id"];
    $commentText = $_POST["comment_text"];
    $userId = $_SESSION["user_id"]; // Replace with your user ID retrieval logic

    // Insert the comment into the database
    $insertCommentQuery = "INSERT INTO complaint_comments (complaint_id, user_id, comment_text, comment_datetime) VALUES ($complaintId, $userId, '$commentText', NOW())";
    mysqli_query($con, $insertCommentQuery);

    // Calculate the updated comment count
    $countCommentsQuery = "SELECT COUNT(*) AS comment_count FROM complaint_comments WHERE complaint_id = $complaintId";
    $countCommentsResult = mysqli_query($con, $countCommentsQuery);
    $commentCount = mysqli_fetch_assoc($countCommentsResult)["comment_count"];

    // Return the updated comment count as JSON response
    echo json_encode(["success" => true, "comments" => $commentCount]);
} else {
    // Invalid request
    echo json_encode(["success" => false]);
}
?>
