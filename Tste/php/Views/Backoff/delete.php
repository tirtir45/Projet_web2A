<?php
require_once(__DIR__ . '/../../connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blogId = $_POST['blog_id'];

    try {
        $conn = config::getConnexion();
        $sql = "DELETE FROM blogs WHERE id = :id";
        $stmt = $conn->prepare($sql);
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
