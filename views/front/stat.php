<?php
require_once(__DIR__ . '/../../config.php');

class BlogStats{
    public static function getBlogsSortedByLikes() {
        $conn = config::getConnexion();

        try {
            $sql = "SELECT blogs.*,
                    COALESCE(likes_count, 0) AS likes
                FROM blogs
                LEFT JOIN (
                    SELECT blog_id, COUNT(*) AS likes_count 
                    FROM reactions 
                    WHERE reaction_type = 'like' 
                    GROUP BY blog_id
                ) likes ON blogs.id = likes.blog_id
                ORDER BY likes DESC, created_at DESC
            ";

            $stmt = $conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
}
?>
