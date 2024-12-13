<?php
require_once (__DIR__. '/../../config.php');


    if($_SERVER['REQUEST_METHOD']==='POST'){
        $title=htmlspecialchars($_POST['title']);
        $content=htmlspecialchars($_POST['content']);
        
        echo"<strong>Title:</strong> $title";
        echo"<strong>Content:</strong> $content";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="style.css">
    <script src="index.js"></script>
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

    <section>
        <h1>Welcome!</h1>
        <p>Blog Section</p>
    </section>


    <!--Create Blogs-->
    <section>
    <h2>Create Blog</h2>
    <br>
    <form action="../../controllers/process.php" method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title">
        <br>
        <br>
        <label for="content">Content:</label>
        <textarea name="content" id="content" rows="5"></textarea>
        <br>
        <br>
        <button type="submit">Create Blog</button>
        <br>
        <br>
        <a href="view.php">
            <button type="button">View Blogs</button>
        </a>
    </form>
    </section>

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