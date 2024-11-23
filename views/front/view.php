<?php
include (__DIR__. '/../../config.php');

$conn=config::getConnexion();

try {
    $sql = "SELECT * FROM blogs ORDER BY created_at DESC";
    $stmt = $conn->query($sql);
    $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Blogs</title>
</head>
<body>
    <h1>Blog List</h1>
    <?php if (count($blogs) > 0): ?>
        <ul>
            <?php foreach ($blogs as $blog): ?>
                <li>
                    <h2><?= htmlspecialchars($blog['title']) ?></h2>
                    <p><?= nl2br(htmlspecialchars($blog['content'])) ?></p>
                    <small>Created on: <?= $blog['created_at'] ?></small>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No blogs found.</p>
    <?php endif; ?>
</body>
</html>
