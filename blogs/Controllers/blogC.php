<?php
class BlogController {
    private $blogModel;

    public function __construct($blogModel) {
        $this->blogModel = $blogModel;
    }

    public function delete($blogId) {
        if (!is_numeric($blogId) || $blogId <= 0) {
            return "Invalid blog ID.";
        }
        $deletedCount = $this->blogModel->deleteBlog($blogId);

        if ($deletedCount > 0) {
            return "Blog with ID $blogId deleted successfully.";
        } else {
            return "No blog found with ID $blogId.";
        }
    }
}
?>