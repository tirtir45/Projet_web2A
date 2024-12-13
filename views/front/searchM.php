<?php
require_once(__DIR__.'/../../config.php');

$conn = config::getConnexion();
$searchM = '';
$blogs_u = [];

try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['searchM'])) {
        $searchM = htmlspecialchars($_GET['searchM']);
        $sql = "SELECT * FROM blogs_u WHERE title LIKE :keyword OR content LIKE :keyword ORDER BY created_at DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':keyword', '%' . $searchM . '%');
        $stmt->execute();
        $blogs_u = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    
} catch (PDOException $e) {
    error_log($e->getMessage());
    echo 'An error occurred while processing your request.';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Blogs User</title>
    <link rel="stylesheet" href="style_mang.css">
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php">Forum</a></li>
            <li><a href="#">Shop</a></li>
            <li><a href="#">Interactive Map</a></li>
            <li><a href="#">Event</a></li>
            <li><a href="#" class="sign-in">Sign In</a></li>
            <li><a href="#" class="register">Register</a></li>
        </ul>
    </nav>
</header>

<h1>Search Results</h1>

<!-- Search Form -->
    <form method="get" action="searchM.php">
    <input type="text" name="searchM" placeholder="Search your blogs" value="<?= htmlspecialchars($searchM) ?>">
    <button type="submit">Search</button>
</form>
<br>

<!-- Display Results -->
<?php if (!empty($searchM)): ?>
    <?php if (count($blogs_u) > 0): ?>
        <table border="1">
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Created At</th>
            </tr>
            <?php foreach ($blogs_u as $blog_u): ?>
                <tr>
                    <td><?= htmlspecialchars($blog_u['title']) ?></td>
                    <td><?= nl2br(htmlspecialchars($blog_u['content'])) ?></td>
                    <td><?= htmlspecialchars($blog_u['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No results found for "<?= htmlspecialchars($searchM) ?>".</p>
    <?php endif; ?>
<?php else: ?>
    <p>Please enter a keyword to search.</p>
<?php endif; ?>

<footer>
    <p>&copy; 2024 Blog Search. All rights reserved.</p>
</footer>
</body>
</html>
