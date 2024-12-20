<?php
session_start();
include(__DIR__ . '/../../connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = config::getConnexion();

    // Ensure the user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo "You must be logged in to react.";
        exit();
    }

    $userId = $_SESSION['user_id']; // Logged-in user's ID
    $blogId = $_POST['blog_id'];    // Blog ID
    $reaction = $_POST['reaction']; // 'like' or 'dislike'

    try {
        // Check if the user already reacted to this blog
        $checkQuery = "SELECT id, reaction_type FROM reactions WHERE blog_id = :blog_id AND userid = :userid";
        $stmt = $conn->prepare($checkQuery);
        $stmt->execute([':blog_id' => $blogId, ':userid' => $userId]);
        $existingReaction = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingReaction) {
            // Update the reaction if it's different
            if ($existingReaction['reaction_type'] !== $reaction) {
                $updateQuery = "UPDATE reactions SET reaction_type = :reaction_type, created_at = NOW() WHERE id = :id";
                $stmt = $conn->prepare($updateQuery);
                $stmt->execute([':reaction_type' => $reaction, ':id' => $existingReaction['id']]);
                echo "Reaction updated successfully!";
            } else {
                echo "You have already reacted with the same reaction.";
            }
        } else {
            // Insert new reaction
            $insertQuery = "INSERT INTO reactions (blog_id, reaction_type, created_at, userid) 
                            VALUES (:blog_id, :reaction_type, NOW(), :userid)";
            $stmt = $conn->prepare($insertQuery);
            $stmt->execute([
                ':blog_id' => $blogId,
                ':reaction_type' => $reaction,
                ':userid' => $userId
            ]);
            echo "Reaction added successfully!";
        }

        // Redirect back to the blog view page
        header('Location: view_blog.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
