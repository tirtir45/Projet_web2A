<?php  
    require_once(__DIR__. "/../../config.php");
    $conn = config::getConnexion();

    try {
        // Delete blog
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
            $id = intval($_POST['id']);
            $stmt = $conn->prepare("DELETE FROM blogs_u WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo "<script>alert('Blog deleted successfully');</script>";
            } else {
                echo "<script>alert('Error deleting blog');</script>";
            }
        }

        // Edit blog
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
            $id = intval($_POST['id']);
            $newTitle = $_POST['title'];
            $newContent = $_POST['content'];
            $stmt = $conn->prepare("UPDATE blogs_u SET title = :title, content = :content WHERE id = :id");
            $stmt->bindParam(':title', $newTitle, PDO::PARAM_STR);
            $stmt->bindParam(':content', $newContent, PDO::PARAM_STR); 
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo "<script>alert('Blog updated successfully');</script>";
            } else {
                echo "<script>alert('Error updating blog');</script>";
            }
        }

        // Fetch all blogs
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
    <link rel="stylesheet" href="style_mang.css">
    <script type="text/javascript">
        function confirmDelete() {
            return confirm("Are you sure you want to delete this blog?");
        }

        function editBlog(id, title, content) {
            
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-title').value = title;
            document.getElementById('edit-content').value = content;
            document.getElementById('edit-section').style.display = 'block';
        }
    </script>
</head>
<body>
    <!--header-->
<header>
        <nav>
            <ul>
                <li><a href="manage.php">Home</a></li>
                <li><a href="index.php">Forum</a></li>
                <li><a href="#">Shop</a></li>
                <li><a href="#">Interactive map</a></li>
                <li><a href="#">Event</a></li>
                <li><a href="#" class="sign-in">Sign in</a></li>
                <li><a href="#" class="register">Register</a></li>
            </ul>
        </nav>
    </header>
<br>
<br>
    <h1>Manage Your Blogs</h1>
<br>
<br>
    <!-- List of blogs -->
    <h2>Your Blogs</h2>
    <form action="searchM.php" method="get">
        <input type="text" name="searchM" placeholder="Search your blogs">
        <button type="submit">Search</button>
    </form>
    <?php if (count($blogs_u) > 0): ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Created at</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($blogs_u as $row): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row["title"]);?></td>
                    <td><?php echo htmlspecialchars($row['content']); ?></td>
                    <td><?php echo htmlspecialchars($row['created_at']);?></td>
                    <td>
                        <!-- Delete Form -->
                        <form action="manage.php" method="post" style="display: inline;" onsubmit="return confirmDelete();">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="delete" value="1">
                            <button type="submit">Delete</button>
                        </form>

                        <!-- Edit Button -->
                        <button onclick="editBlog('<?php echo $row['id']; ?>','<?php echo addslashes(htmlspecialchars($row['title'], ENT_QUOTES)); ?>','<?php echo addslashes(htmlspecialchars($row['content'], ENT_QUOTES)); ?>')">Edit</button>
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
            <label for="edit-title">New Title:</label><br>
            <input type="text" name="title" id="edit-title"><br><br>
            <label for="edit-content">New Content:</label><br>
            <textarea name="content" id="edit-content" rows="4" cols="50"></textarea><br><br>
            <input type="hidden" name="edit" value="1">
            <button type="submit">Update Blog</button>
        </form>
    </div>
    <br>
    <br>
    <!--footer-->
    <footer>
    <div class="footer-links">
            <p><a href="#" aria-label="About us">About Us</a></p>
            <p><a href="#" aria-label="Terms of Service">Terms of Service</a></p>
            <p><a href="#" aria-label="Privacy Policy">Privacy Policy</a></p>
        </div>
        <div>
            <h4>Our Socials</h4>
            <p><a href="https://www.facebook.com/profile.php?id=61568903216448&is_tour_dismissed" aria-label="Facebook">Facebook</a></p>
        </div>
        <div>
            <h4>Our Contacts</h4>
            <p><a href="#" aria-label="Email">Email</a></p>
            <p>Call us on +216 999 555 222</p>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Forum Blog Tunisia. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
