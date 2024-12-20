<?php
require_once(__DIR__ . '/../../connect.php');

if (isset($_GET['blog_id'])) {
    $blogId = $_GET['blog_id'];

    try {
        $conn = config::getConnexion();
        $sql = "SELECT * FROM blogs WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $blogId, PDO::PARAM_INT);
        $stmt->execute();
        $blog = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$blog) {
            echo "Blog not found.";
            exit;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    try {
        $sql = "UPDATE blogs SET title = :title, content = :content WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':id', $blogId, PDO::PARAM_INT);
        $stmt->execute();

        // Redirect back to manage.php
        header('Location: manage.php');
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Blog</title>
    <link rel="stylesheet" href="view.css">
</head>
<body>
    <h1>Edit Blog</h1>
    <form method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($blog['title']) ?>" required>
        <br>
        <label for="content">Content:</label>
        <textarea id="content" name="content" required><?= htmlspecialchars($blog['content']) ?></textarea>
        <br>
        <button type="submit">Update Blog</button>
    </form>
</body>
</html>
