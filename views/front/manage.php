<?php  
    include(__DIR__. "/../../config.php");
    $conn = config::getConnexion();

    try {

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
            $id = intval($_POST['id']);
            $stmt = $conn->prepare("DELETE FROM blogs_u WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) { // Fixed "excute" typo to "execute"
                echo "<script>alert('Blog deleted successfully');</script>";
            } else {
                echo "<script>alert('Error deleting blog');</script>";
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
            $id = intval($_POST['id']);
            $newContent = $_POST['content'];
            $stmt = $conn->prepare("UPDATE blogs_u SET content = :content WHERE id = :id");
            $stmt->bindParam(':content', $newContent, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo "<script>alert('Blog updated successfully');</script>";
            } else {
                echo "<script>alert('Error updating blog');</script>";
            }
        }

        $stmt = $conn->prepare("SELECT * FROM blogs_u");
        $stmt->execute();
        $blogs_u = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Blogs</title>
    <script type="text/javascript">
        // Confirm delete
        function confirmDelete() {
            return confirm("Are you sure you want to delete this blog?");
        }

        // Edit blog dynamically
        function editBlog(id, content) {
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-content').value = content;
            document.getElementById('edit-section').style.display = 'block';
        }
    </script>
</head>
<body>
    <h1>Manage Your Blogs</h1>

    <!-- List of blogs -->
    <h2>Your Blogs</h2>
    <?php if (count($blogs_u) > 0): ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Content</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($blogs_u as $row): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['content']); ?></td>
                    <td>
                        <!-- Delete Form -->
                        <form action="manage.php" method="post" style="display: inline;" onsubmit="return confirmDelete();">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="delete" value="1">
                            <button type="submit">Delete</button>
                        </form>

                        <!-- Edit Button -->
                        <button onclick="editBlog('<?php echo $row['id']; ?>', '<?php echo htmlspecialchars($row['content'], ENT_QUOTES); ?>')">Edit</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No blogs found.</p>
    <?php endif; ?>

    <!-- Edit Blog Section -->
    <div id="edit-section" style="display: none;">
        <h2>Edit Blog</h2>
        <form action="manage.php" method="post">
            <input type="hidden" name="id" id="edit-id">
            <label for="edit-content">New Content:</label><br>
            <textarea name="content" id="edit-content" rows="4" cols="50"></textarea><br><br>
            <input type="hidden" name="edit" value="1">
            <button type="submit">Update Blog</button>
        </form>
    </div>
</body>
</html>
