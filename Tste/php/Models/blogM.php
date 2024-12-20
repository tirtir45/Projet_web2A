<?php

class BlogModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Add a blog with user_id
    public function add($title, $content, $user_id) {
        try {
            // Prepare SQL query to insert the blog post
            $sql = "INSERT INTO blogs (title, content, user_id, created_at) VALUES (:title, :content, :user_id, NOW())";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':user_id', $user_id);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error adding blog: " . $e->getMessage());
        }
    }

    // Delete a blog by its ID
    public function deleteBlog($blogId) {
        try {
            $sql = "DELETE FROM blogs WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $blogId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error deleting blog: " . $e->getMessage());
        }
    }

    // Update a blog's title and content by its ID
    public function updateBlog($blogId, $title, $content) {
        try {
            $sql = "UPDATE blogs SET title = :title, content = :content WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':id', $blogId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error updating blog: " . $e->getMessage());
        }
    }

    // Fetch a single blog by ID
    public function getBlogById($id) {
        try {
            $stmt = $this->conn->prepare("
                SELECT title, content, created_at, user_id 
                FROM blogs 
                WHERE id = :id
            ");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error fetching blog: " . $e->getMessage());
        }
    }

    // Fetch all blogs with user information
    public function getAllBlogs() {
        try {
            $sql = "SELECT b.id, b.title, b.content, b.created_at, u.firstname 
                    FROM blogs b
                    JOIN user u ON b.user_id = u.id
                    ORDER BY b.created_at DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error fetching blogs: " . $e->getMessage());
        }
    }

    // Fetch blogs by user_id
    public function getBlogsByUserId($user_id) {
        try {
            $stmt = $this->conn->prepare("
                SELECT title, content, created_at, user_id 
                FROM blogs 
                WHERE user_id = :user_id
                ORDER BY created_at DESC
            ");
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error fetching blogs by user: " . $e->getMessage());
        }
    }
}

?>
