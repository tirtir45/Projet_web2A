<?php
session_start(); // Start session to access user_id
include(__DIR__ . '/../config.php');
include(__DIR__ . '/../Models/blogM.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to view your blogs.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $title = htmlspecialchars(trim($_POST['title']));
    $content = htmlspecialchars(trim($_POST['content']));
    $user_id = $_SESSION['user_id']; // Retrieve user ID from session

    // Check if title and content are not empty
    if (empty($title) || empty($content)) {
        echo "Title and content are required.";
        exit();
    }

    try {
        // Connect to the database
        $conn = config::getConnexion();
        $blogModel = new BlogModel($conn);

        // Add blog post
        if ($blogModel->add($title, $content, $user_id)) {
            // Redirect to the user's blog list or profile page after successful blog creation
            header("Location: /path/to/blog_list.php"); // Adjust the path as needed
            exit();
        } else {
            echo "Failed to create the blog.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}
?>
