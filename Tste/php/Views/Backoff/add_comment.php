<?php
session_start();
include(__DIR__ . '/../../config.php');

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to add a comment.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blog_id = $_POST['blog_id'];
    $user_id = $_SESSION['user_id'];
    $content = trim($_POST['content']);

    try {
        $conn = config::getConnexion();
        $stmt = $conn->prepare("INSERT INTO comments (blog_id, user_id, content) VALUES (:blog_id, :user_id, :content)");
        $stmt->bindParam(':blog_id', $blog_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->execute();

        header("Location: view_blog.php?id=$blog_id"); // Redirect back to the blog page
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
