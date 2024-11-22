<?php
$blogs = [];
$filePath = 'blogs.txt';
if (file_exists($filePath)) {
    $fileContents = file($filePath, FILE_IGNORE_NEW_LINES);
    foreach ($fileContents as $line) {
        list($date, $title, $content) = explode('|', $line);
        $blogs[] = ['date' => $date, 'title' => $title, 'content' => $content];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Blog - Tunisia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Header Section -->
    <header>
        <div class="logo">
            <img src="logo.png" alt="Logo">
        </div>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="index.php">Forum</a></li>
                <li><a href="#">Shop</a></li>
                <li><a href="#">Interactive map</a></li>
                <li><a href="#">Event</a></li>
                <li><a href="signin.html" class="sign-in">Sign in</a></li>
                <li><a href="register.html" class="register">Register</a></li>
            </ul>
        </nav>
    </header>

    <section class="welcome">
        <h1>Welcome!</h1>
        <p>Blog Section</p>
    </section>

    <!--Create blog button-->
    <section class="blog-b">
        <div>
            <a href="manage.html">
                <button>Create new Blog</button>
            </a>
        </div>
    </section>

    <section class="blog-section" id="home-blogs">
        <h2>Latest Blogs</h2>
        <br>
        <br>
        <?php foreach ($blogs as $blog): ?>
            <div class="blog-card">
                <h2><?php echo htmlspecialchars($blog['title']); ?></h2>
                <p><?php echo htmlspecialchars($blog['content']); ?></p>
                <a href="read.html">
                    <button>Read more</button>
                </a>
            </div>
        <?php endforeach; ?>
    </section>

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