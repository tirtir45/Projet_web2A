<?php
session_start(); // Start the session to access user_id

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to add a comment.";
    exit();
}

$user_id = $_SESSION['user_id']; // Get the logged-in user's ID
$blog_id = $_GET['blog_id']; // Assuming you pass the blog_id in the URL or form

// Get the comment content from the form
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])) {
    $content = $_POST['comment'];

    // Check if content is not empty
    if (!empty($content)) {
        try {
            // Connect to the database
            $conn = config::getConnexion();

            // Insert the comment into the database
            $stmt = $conn->prepare(
                "INSERT INTO comments (blog_id, user_id, content, created_at) 
                 VALUES (:blog_id, :user_id, :content, NOW())"
            );
            $stmt->bindParam(':blog_id', $blog_id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':content', $content, PDO::PARAM_STR);
            $stmt->execute();

            echo "Comment added successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Please enter a comment.";
    }
}
?>

<!-- Comment Form -->
<form method="POST" action="">
    <textarea name="comment" placeholder="Write your comment here..." required></textarea>
    <button type="submit">Add Comment</button>
</form>
