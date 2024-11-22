<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forum"; 

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['comment_id']) && filter_var($_POST['comment_id'], FILTER_VALIDATE_INT)) {
            $comment_id = (int)$_POST['comment_id'];

            $stmt = $conn->prepare("DELETE FROM comments WHERE id = :comment_id");
            $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);

            try {
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    http_response_code(200);
                    echo "Comment with ID $comment_id deleted successfully.";
                } else {
                    http_response_code(404);
                    echo "No comment found with ID $comment_id.";
                }
            } catch (PDOException $e) {
                echo "Error executing statement: " . $e->getMessage();
            }
        } else {
            echo "Invalid comment ID.";
        }
    }
} catch (PDOException $e) {
    echo "Error connecting to database: " . $e->getMessage();
} finally {
    
    $conn = null; 
}
?>