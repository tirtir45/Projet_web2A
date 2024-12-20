<?php
class CommentModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Fetch comments for a specific blog
    public function getCommentsByBlogId($blogId)
    {
        $sql = "SELECT comments.*, user.firstname AS user_name 
                FROM comments 
                JOIN user ON comments.user_id = user.id 
                WHERE comments.blog_id = :blog_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':blog_id', $blogId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a comment to the blog
    public function addComment($userId, $blogId, $content)
    {
        $sql = "INSERT INTO comments (user_id, blog_id, content) VALUES (:user_id, :blog_id, :content)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':blog_id', $blogId);
        $stmt->bindParam(':content', $content);
        return $stmt->execute();
    }
}
?>
