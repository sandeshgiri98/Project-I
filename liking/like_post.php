<?php
session_start();
require_once('../connection/connection.php');

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["post_id"])) {
    // Check if the user is authenticated (you should have your authentication logic here)

    // Get the post ID and user ID
    $postId = $_POST["post_id"];
    $userId = $_SESSION["user_id"]; // Replace with your user ID retrieval logic

    // Check if the user has already liked this post
    $alreadyLiked = $_POST["already_liked"] === "true";

    if ($alreadyLiked) {
        // User has already liked this post, so remove the like
        $deleteLikeQuery = "DELETE FROM complaint_likes WHERE complaint_id = $postId AND user_id = $userId";
        mysqli_query($con, $deleteLikeQuery);
    } else {
        // User hasn't liked this post, so add a like
        $addLikeQuery = "INSERT INTO complaint_likes (complaint_id, user_id, liked_by_user) VALUES ($postId, $userId, 'username_here')";
        mysqli_query($con, $addLikeQuery);
    }

    // Calculate the updated like count
    $countLikesQuery = "SELECT COUNT(*) AS like_count FROM complaint_likes WHERE complaint_id = $postId";
    $countLikesResult = mysqli_query($con, $countLikesQuery);
    $likeCount = mysqli_fetch_assoc($countLikesResult)["like_count"];

    // Update the like count in the main table
    $updateLikeCountQuery = "UPDATE complain_details SET like_count = $likeCount WHERE id = $postId";
    mysqli_query($con, $updateLikeCountQuery);

    // Return the updated like count as JSON response
    echo json_encode(["success" => true, "likes" => $likeCount]);
} else {
    // Invalid request
    echo json_encode(["success" => false]);
}
?>
