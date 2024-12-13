<?php
require_once(__DIR__.'/../../config.php');

$conn = config::getConnexion();
$search = '';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['search'])) {
        $search = htmlspecialchars($_GET['search']);
        $sql = "SELECT * FROM blogs WHERE title LIKE :keyword OR content LIKE :keyword ORDER BY created_at DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':keyword', '%' . $search . '%');
        $stmt->execute();
        $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $blogs = [];
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Blogs</title>
    <link rel="stylesheet" href="view.css">
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
    <form method="get" action="search.php">
        <input type="text" name="search" placeholder="Search blogs..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Search</button>
    </form>
    <br>

    <!-- Display Results -->
    <?php if (!empty($search)): ?>
        <?php if (count($blogs) > 0): ?>
            <ul>
                <?php foreach ($blogs as $blog): ?>
                    <li>
                        <h2><?= htmlspecialchars($blog['title']) ?></h2>
                        <p><?= nl2br(htmlspecialchars($blog['content'])) ?></p>
                        <small>Created on: <?= htmlspecialchars($blog['created_at']) ?></small>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No results found for "<?= htmlspecialchars($search) ?>".</p>
        <?php endif; ?>
    <?php else: ?>
        <p>Please enter a keyword to search.</p>
    <?php endif; ?>

    <footer>
        <p>&copy; 2024 Blog Search. All rights reserved.</p>
    </footer>
</body>
</html>
