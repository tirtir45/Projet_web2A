<?php

class BlogModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }


    public function add($title, $content) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO blogs (title, content, created_at) VALUES (:title, :content, NOW())");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }


    public function getAllBlogs() {
        try {
            $stmt = $this->conn->query("SELECT * FROM blogs ORDER BY created_at DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getBlogById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM blogs WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }


    public function deleteBlog($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM blogs WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
