<?php
include_once('../connection/connection.php');

if (isset($_POST['postId']) && isset($_POST['comment'])) {
    $postId = intval($_POST['postId']);
    $comment = mysqli_real_escape_string($con, $_POST['comment']);

    // Check if the post exists
    $selectQuery = "SELECT * FROM complain WHERE id = $postId";
    $result = mysqli_query($con, $selectQuery);
    $row = mysqli_fetch_assoc($result);
    if (!$row) {
        die('Post not found.');
    }

    // Insert comment into the database
    $userId = 1; // Replace with the actual user ID (you can get it from the logged-in user session)
    $insertCommentQuery = "INSERT INTO post_comments (post_id, user_id, comment) VALUES ($postId, $userId, '$comment')";
    mysqli_query($con, $insertCommentQuery);

    // Count comments for this post
    $selectCountQuery = "SELECT COUNT(*) AS comments_count FROM post_comments WHERE post_id = $postId";
    $resultCount = mysqli_query($con, $selectCountQuery);
    $commentsCount = mysqli_fetch_assoc($resultCount)['comments_count'];

    // Return the updated comment count in JSON format
    echo json_encode(['comments_count' => $commentsCount]);
} else {
    die('Invalid request.');
}
?>
