<?php

include (__DIR__.'/../../config.php');

try {
    $conn=config::getConnexion();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
            die("<div class='error'>Invalid ID provided.</div>");
        }

        $id = intval($_POST['id']);

        $stmt = $conn->prepare("DELETE FROM blogs WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<div class='success'>Blog entry with ID $id deleted successfully.</div>";
        } else {
            echo "<div class='error'>No blog entry found with ID $id.</div>";
        }
    }
} catch (PDOException $e) {
    error_log("Error deleting blog entry: " . $e->getMessage());
    echo "<div class='error'>An error occurred. Please try again later.</div>";
} finally {
    $conn = null;
}
?>
