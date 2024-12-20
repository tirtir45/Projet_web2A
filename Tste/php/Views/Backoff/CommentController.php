<?php
require_once(__DIR__ . '/../../config.php');
require_once('CommentModel.php');
require_once('BlogModel.php');

class CommentController
{
    private $commentModel;
    private $blogModel;
    private $conn;

    public function __construct()
    {
        $this->conn = config::getConnexion();
        $this->commentModel = new CommentModel($this->conn);
        $this->blogModel = new BlogModel($this->conn);
    }

    // Fetch comments for a specific blog
    public function getComments($blogId)
    {
        return $this->commentModel->getCommentsByBlogId($blogId);
    }

    // Add a comment
    public function addComment($userId, $blogId, $content)
    {
        return $this->commentModel->addComment($userId, $blogId, $content);
    }
}
?>
