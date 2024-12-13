<?php
require_once (__DIR__. '/../../config.php');
require_once('stat.php');

$blogs=BlogStats::getBlogsSortedByLikes();
$conn=config::getConnexion();

try {
    /*$sql = "SELECT * FROM blogs ORDER BY created_at DESC";
    $stmt = $conn->query($sql);
    $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);*/

    foreach($blogs as &$blog){
        //l'affichage des commentaires dans chaque blog qui le correspond 
        $blogId=$blog['id'];
        $sqlComments="SELECT * FROM comments WHERE blog_id=:blog_id ORDER BY created_at DESC";
        $stmtComments = $conn->prepare($sqlComments);
        $stmtComments->bindParam(':blog_id', $blogId);
        $stmtComments->execute();
        $blog['comments']=$stmtComments->fetchAll(PDO::FETCH_ASSOC);

        //de meme pour les reactions
        $sqlReactions="SELECT reaction_type, COUNT(*) AS count FROM reactions WHERE blog_id=:blog_id GROUP BY reaction_type";
        $stmtReactions = $conn->prepare($sqlReactions);
        $stmtReactions->bindParam(':blog_id', $blogId);
        $stmtReactions->execute();
        $reactions=$stmtReactions->fetchAll(PDO::FETCH_ASSOC);

        $blog['likes']=0;
        $blog['dislikes']=0;
        
            foreach($reactions as $reaction){
                if($reaction['reaction_type']=="like") $blog['likes']=$reaction['count'];
                if($reaction['reaction_type']=="dislike") $blog['dislikes']=$reaction['count'];
            }
        }
    }catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Blogs</title>
    <link rel="stylesheet" href="view.css">
    <script src="comment.js"></script>
    <script src="react.js"></script>
    <script src="search.js"></script>
</head>
<body>
    <!--Header Section-->
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

    <h1>Blog List</h1>

    <form action="search.php" method="get">
        <input type="text" name="search" placeholder="Search for a blog">
        <button type="submit">Search</button>
    </form>
    <br>
    <br>
    <?php if (count($blogs) >= 0): ?>
        <ul>
            <?php foreach ($blogs as $blog): ?>
                <li>
                    <h2><?= htmlspecialchars($blog['title']) ?></h2>
                    <p><?= nl2br(htmlspecialchars($blog['content'])) ?></p>
                    <small>Created on: <?= $blog['created_at'] ?></small>
                    <div>
                        <p>Likes: <?= $blog['likes'] ?> | Dislikes: <?= $blog['dislikes'] ?></p>
                        <form method="post" action="react.php">
                            <input type="hidden" name="blog_id" value="<?= $blog['id'] ?>">
                            <button type="submit" name="reaction" value="like">Like</button>
                            <button type="submit" name="reaction" value="dislike">Dislike</button>
                        </form>
                    </div>
                    <h3>Comments</h3>
                    <ul>
                        <?php if (!empty($blog['comments'])): ?>
                            <?php foreach ($blog['comments'] as $comment): ?>
                                <li>
                                    <?= nl2br(htmlspecialchars($comment['content'])) ?>
                                    <small>(<?= htmlspecialchars($comment['created_at']) ?>)</small>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>No comments yet.</li>
                        <?php endif; ?>
                    </ul>
                    <form method="post" action="comment.php">
                        <input type="hidden"  name="blog_id" value="<?= $blog['id'] ?>">
                        <textarea name="content" placeholder="What's on your mind?"></textarea>
                        <button type="submit">Post Comment</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No blogs found.</p>
    <?php endif; ?>
    <br>
    <br>

        <!--Footer-->
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
</body>
</html>
