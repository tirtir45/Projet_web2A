<?php
session_start(); // Start session to access user_id

// Correct the path to config.php
include(__DIR__ . '/../../connect.php'); // Adjusted path

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to manage your blogs.";
    exit();
}

$blogs = []; // Initialize $blogs as an empty array

try {
    // Connect to the database
    $conn = config::getConnexion();

    // Retrieve blogs for the logged-in user from the blogs table
    $stmt = $conn->prepare("SELECT * FROM blogs WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();
    $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Blogs</title>
    <link rel="stylesheet" href="style.css">
    <script src="index.js"></script>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        header {
            background: #333;
            color: #fff;
            padding: 1rem 0;
        }

        header nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 0;
            padding: 0;
        }

        header nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        header nav ul li a:hover {
            text-decoration: underline;
        }

        section {
            max-width: 900px;
            margin: 2rem auto;
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #333;
            color: white;
        }

        .btn {
            padding: 8px 12px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-edit {
            background-color: #4CAF50;
            color: white;
        }

        .btn-delete {
            background-color: #f44336;
            color: white;
        }

        .btn-edit:hover, .btn-delete:hover {
            opacity: 0.8;
        }

        .footer {
            background: #333;
            color: #fff;
            padding: 2rem 0;
            text-align: center;
            margin-top: 2rem;
        }

        .footer a {
            color: #4CAF50;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .footer h4 {
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <header>
        <nav>
            <ul>
                <li><a href="view_blog.php">Home Page</a></li>
                <li><a href="manage.php">My Blogs</a></li>
                <li><a href="indexB.php">Create Blog</a></li>
            </ul>
        </nav>
    </header>

    <!-- Blogs Section -->
    <section>
        <h1>Your Blogs</h1>
        <?php if (count($blogs) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($blogs as $blog): ?>
                        <tr>
                            <td><?= htmlspecialchars($blog['id']) ?></td>
                            <td><?= htmlspecialchars($blog['title']) ?></td>
                            <td><?= nl2br(htmlspecialchars(substr($blog['content'], 0, 50))) ?>...</td>
                            <td><?= $blog['created_at'] ?></td>
                            <td>
                                <a href="edit.php?blog_id=<?= $blog['id'] ?>" class="btn btn-edit">Edit</a>
                                <form method="post" action="delete.php" style="display:inline;">
                                    <input type="hidden" name="blog_id" value="<?= $blog['id'] ?>">
                                    <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this blog?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No blogs found. <a href="index.php" class="btn btn-edit">Create Your First Blog</a></p>
        <?php endif; ?>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div>
            <p>&copy; 2024 Forum Blog Tunisia. All rights reserved.</p>
            <p>
                <a href="view_blog.php" aria-label="Home Page">Home Page</a> | 
                <a href="manage.php" aria-label="My Blogs">My Blogs</a> | 
                <a href="indexB.php" aria-label="Create Blog">Create Blog</a>
            </p>
            <h4>Our Socials</h4>
            <p><a href="https://www.facebook.com/profile.php?id=61568903216448&is_tour_dismissed" aria-label="Facebook">Facebook</a></p>
            <h4>Contact Us</h4>
            <p>Email: <a href="mailto:support@forumblogtunisia.com">support@forumblogtunisia.com</a></p>
            <p>Call us: +216 999 555 222</p>
        </div>
    </footer>

</body>
</html>
