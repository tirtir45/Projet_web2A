<?php
require_once (__DIR__. '/../../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = config::getConnexion();

    $blogId = $_POST['blog_id'];
    $content = $_POST['content'];

    $sql = "INSERT INTO comments (blog_id, content) VALUES (:blog_id, :content)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':blog_id' => $blogId, ':content' => $content]);

    header('Location:index.php');
}
?>
