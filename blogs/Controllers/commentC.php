<?php
class CommentController {
    private $commentModel;

    public function __construct($commentModel) {
        $this->commentModel = $commentModel;
    }

    public function delete($commentId) {
        
        if (!is_numeric($commentId) || $commentId <= 0) {
            return "Invalid comment ID.";
        }

        $deletedCount = $this->commentModel->deleteComment($commentId);

        if ($deletedCount > 0) {
            return "Comment with ID $commentId deleted successfully.";
        } else {
            return "No comment found with ID $commentId.";
        }
    }
}
?>