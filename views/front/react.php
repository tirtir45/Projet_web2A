<?php
include(__DIR__. '/../../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = config::getConnexion();

    $blogId = $_POST['blog_id'];
    $reaction = $_POST['reaction'];

    $sql = "INSERT INTO reactions (blog_id, reaction_type) VALUES (:blog_id, :reaction_type)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':blog_id' => $blogId, ':reaction_type' => $reaction]);

    header('Location: index.php');
}
?>
