<?php
session_start(); // Start session to access user_id

// Correct the path to config.php
include(__DIR__ . '/../../connect.php');  // Adjusted path

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to create a blog.";
    exit();
}

try {
    // Connect to the database
    $conn = config::getConnexion();

    // Check if the form was submitted to create a blog
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitize inputs
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
        $user_id = $_SESSION['user_id']; // Retrieve user ID from session

        // Prepare the query to insert the blog into the database
        $stmt = $conn->prepare("INSERT INTO blogs (title, content, user_id, created_at) VALUES (:title, :content, :user_id, NOW())");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        echo "Blog created successfully!";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog</title>
    <link rel="stylesheet" href="style.css">
    <script src="index.js"></script>
</head>
<body>

    <!-- Header Section -->
    <header>
        <nav>
            <ul>
            <li><a href="manage.php">My Blogs</a></li>
                <li><a href="#">Create</a></li>
                <li><a href="view_blog.php">Home Page</a></li>
                <li><a href="../Frontoff/view.php">Shop</a></li>
            </ul>
        </nav>
    </header>

    <section>
        <h1>Create Blog</h1>
        <form action="view_blog.php" method="post">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
            <br><br>
            <label for="content">Content:</label>
            <textarea name="content" id="content" rows="5" required></textarea>
            <br><br>
            <button type="submit">Create Blog</button>
        </form>
    </section>

    <!-- Footer -->
    

</body>
</html>
