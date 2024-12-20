<?php
session_start();
require_once(__DIR__ . '/../../connect.php');
require_once('stat.php');

$conn = config::getConnexion();
$blogs = [];

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']) ? 'true' : 'false';
echo "<script>const isLoggedIn = $isLoggedIn;</script>";

try {
    // Fetch blogs with the user's name
    $sqlBlogs = "SELECT b.id, b.title, b.content, b.created_at, u.firstname 
                 FROM blogs b
                 JOIN user u ON b.user_id = u.id
                 ORDER BY b.created_at DESC";
    $stmtBlogs = $conn->prepare($sqlBlogs);
    $stmtBlogs->execute();
    $blogs = $stmtBlogs->fetchAll(PDO::FETCH_ASSOC);

    // Fetch comments and reactions for each blog
    foreach ($blogs as &$blog) {
        $blogId = $blog['id'];

        // Fetch comments for each blog
        $sqlComments = "SELECT * FROM comments WHERE blog_id=:blog_id ORDER BY created_at DESC";
        $stmtComments = $conn->prepare($sqlComments);
        $stmtComments->bindParam(':blog_id', $blogId);
        $stmtComments->execute();
        $blog['comments'] = $stmtComments->fetchAll(PDO::FETCH_ASSOC);

        // Fetch reactions (likes and dislikes)
        $sqlReactions = "SELECT reaction_type, COUNT(*) AS count FROM reactions WHERE blog_id=:blog_id GROUP BY reaction_type";
        $stmtReactions = $conn->prepare($sqlReactions);
        $stmtReactions->bindParam(':blog_id', $blogId);
        $stmtReactions->execute();
        $reactions = $stmtReactions->fetchAll(PDO::FETCH_ASSOC);

        $blog['likes'] = 0;
        $blog['dislikes'] = 0;

        foreach ($reactions as $reaction) {
            if ($reaction['reaction_type'] == "like") $blog['likes'] = $reaction['count'];
            if ($reaction['reaction_type'] == "dislike") $blog['dislikes'] = $reaction['count'];
        }
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
    <title>View Blogs</title>
    <link rel="stylesheet" href="view.css">
    <script src="comment.js"></script>
    <script src="react.js"></script>
    <script src="search.js"></script>

    <!-- CSS here -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../..//assets/css/meanmenu.min.css" />
    <link rel="stylesheet" href="../../assets/css/animate.css" />
    <link rel="stylesheet" href="../../assets/css/swiper.min.css" />
    <link rel="stylesheet" href="../../assets/css/slick.css" />
    <link rel="stylesheet" href="../../assets/css/magnific-popup.css" />
    <link rel="stylesheet" href="../../assets/css/fontawesome-pro.css" />
    <link rel="stylesheet" href="../../assets/css/spacing.css" />
    <link rel="stylesheet" href="../../assets/css/main.css" />
</head>

<body>


        <!-- preloader start -->
    <?php require_once('../../connect.php');
        ?>
    <div id="preloader">
      <div class="bd-loader-inner">
        <div class="bd-loader">
          <span class="bd-loader-item"></span>
          <span class="bd-loader-item"></span>
          <span class="bd-loader-item"></span>
          <span class="bd-loader-item"></span>
          <span class="bd-loader-item"></span>
          <span class="bd-loader-item"></span>
          <span class="bd-loader-item"></span>
          <span class="bd-loader-item"></span>
        </div>
      </div>
    </div>
    <!-- preloader end -->

    <script>
        window.onload = function() {
            // Hide the preloader after the page has loaded
            document.getElementById('preloader').style.display = 'none';
        }
    </script>
    <!-- Back to top start -->
    <div class="backtotop-wrap cursor-pointer">
      <svg
        class="backtotop-circle svg-content"
        width="100%"
        height="100%"
        viewBox="-1 -1 102 102"
      >
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
      </svg>
    </div>
    <!-- Back to top end -->

<!-- Offcanvas area start -->
<div class="fix">
      <div class="offcanvas__info">
         <div class="offcanvas__wrapper">
            <div class="offcanvas__content">
               <div class="offcanvas__top mb-40 d-flex justify-content-between align-items-center">
                  <div class="offcanvas__logo">
                     <a href="index.php">
                        <img src="../../assets/imgs/furniture/logo/black-logo.png">
                     </a>
                  </div>
                  <div class="offcanvas__close">
                     <button>
                        <i class="fal fa-times"></i>
                     </button>
                  </div>
               </div>
               <div class="offcanvas__search mb-25">
               </div>
               <div class="mobile-menu fix mb-40"></div>
               <div class="offcanvas__contact mt-30 mb-20">
                  <h4>Contact Info</h4>
                  <ul>
                     <li class="d-flex align-items-center">
                        <div class="offcanvas__contact-icon mr-15">
                           <i class="fal fa-map-marker-alt"></i>
                        </div>
                        <div class="offcanvas__contact-text">
                           <a target="_blank"
                              href="https://maps.app.goo.gl/EryenpBm6WNM2jnq8">Esprit,Bloc H, Ariana Soughra</a>
                        </div>
                     </li>
                     <li class="d-flex align-items-center">
                        <div class="offcanvas__contact-icon mr-15">
                           <i class="far fa-phone"></i>
                        </div>
                        <div class="offcanvas__contact-text">
                           <a href="tel:+216 222 33 555">+216 222 33 555</a>
                        </div>
                     </li>
                     <li class="d-flex align-items-center">
                        <div class="offcanvas__contact-icon mr-15">
                           <i class="fal fa-envelope"></i>
                        </div>
                        <div class="offcanvas__contact-text">
                           <a href="tel:+012-345-6789"><span class="mailto:khomssaoukhmiss@gmail.com">khomssaoukhmiss@gmail.com</span></a>
                        </div>
                     </li>
                  </ul>
               </div>
               <div class="offcanvas__social">
                  <ul>
                     <li><a href="https://www.facebook.com/profile.php?id=61568903216448"><i class="fab fa-facebook-f"></i></a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="offcanvas__overlay"></div>
   <div class="offcanvas__overlay-white"></div>
   <!-- Offcanvas area start -->
    


    <!-- Header area start -->
    <header>
      <div class="header">
        <div class="header-top-area grocery__top-header">
          <div class="header-layout-4">
            <div class="header-to-main d-none d-sm-flex">
              <div class="link-text">
                <span><img src="../../assets/imgs/icons/call.png" alt="" /></span>
                <a href="tel:+380961381876">+380961381876</a>
              </div>
              <div class="header-top-notice d-none d-lg-block">
                <p>
                  TAKE CARE OF YOUR Health
                  <span class="text-white">25% OFF</span> USE CODE “ DOFIX03 ”
                </p>
              </div>
              <div
                class="tp-header-top-menu d-flex align-items-center justify-content-end"
              >
                <div class="header-lang-item header-lang">
                  <span
                    class="header-lang-toggle text-white"
                    id="header-lang-toggle"
                    >English</span
                  >
                  <ul class="">
                    <li>
                      <a class="furniture-clr-hover" href="#">Spanish</a>
                    </li>
                    <li>
                      <a class="furniture-clr-hover" href="#">Russian</a>
                    </li>
                    <li>
                      <a class="furniture-clr-hover" href="#">Portuguese</a>
                    </li>
                  </ul>
                </div>
                <div class="header-lang-item tp-header-currency">
                  <span
                    class="header-currency-toggle text-white"
                    id="header-currency-toggle"
                    >DT</span
                  >
                  <ul>
                    <li>
                      <a class="furniture-clr-hover" href="#">EUR</a>
                    </li>
                    <li>
                      <a class="furniture-clr-hover" href="#">CHF</a>
                    </li>
                    <li>
                      <a class="furniture-clr-hover" href="#">GBP</a>
                    </li>
                    <li>
                      <a class="furniture-clr-hover" href="#">KWD</a>
                    </li>
                  </ul>
                </div>
                <div class="header-lang-item tp-header-setting">
                  <span
                    class="header-setting-toggle text-white"
                    id="header-setting-toggle"
                    >Setting</span
                  >
                  <ul>
                    <li>
                      <a class="furniture-clr-hover" href="../View/profile.php">My Profile</a>
                    </li>
                    <li>
                      <a class="furniture-clr-hover" href="../View/update_profile.php"
                        >Profile settings</a
                      >
                    </li>
                    <li>
                      <a class="furniture-clr-hover" href="cart.php">Cart</a>
                    </li>
                    <li>
                      <a class="furniture-clr-hover" href="../usrview/logout.php">Logout</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="header-layout-4 header-bottom">
          <div id="header-sticky" class="header-4">
            <div class="mega-menu-wrapper">
              <div class="header-main-4">
                <div class="header-left">
                  <div class="header-logo">
                    <a href="index.php">
                      <img
                        src="../../assets/imgs/furniture/logo/black-logo.png"
                        alt="logo not found"
                      />
                    </a>
                  </div>
                  <div
                    class="mean__menu-wrapper furniture__menu d-none d-lg-block"
                  >
                    <div class="main-menu">
                      <nav id="mobile-menu">
                        <ul>
                          <li class="has-dropdown">
                            <a href="../Backoff/manage.php">My Blogs</a>
                          </li>
                          <li class="has-dropdown">
                          <a href="../Backoff/indexB.php">Create</a>
                          </li>
                          <li class="has-dropdown">
                            <a href="../Backoff/view_blog.php">Manage Blogs</a>
                          </li>
                          <li>
                            <a href="rymcontact.html">Contact</a>
                          </li>
                        </ul>
                      </nav>
                    </div>
                  </div>
                </div>
                <div
                  class="header-right d-inline-flex align-items-center justify-content-end"
                >

                  <div class="header-action d-flex align-items-center ml-30">
                    <div class="header-action-item">
                      <a href="" class="header-action-btn">
                        <svg
                          width="23"
                          height="21"
                          viewBox="0 0 23 21"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            d="M21.2743 2.33413C20.6448 1.60193 19.8543 1.01306 18.9596 0.609951C18.0649 0.206838 17.0883 -0.0004864 16.1002 0.00291444C14.4096 -0.0462975 12.7637 0.529279 11.5011 1.61122C10.2385 0.529279 8.59252 -0.0462975 6.90191 0.00291444C5.91383 -0.0004864 4.93727 0.206838 4.04257 0.609951C3.14788 1.01306 2.35732 1.60193 1.72785 2.33413C0.632101 3.61193 -0.514239 5.92547 0.245772 9.69587C1.4588 15.7168 10.5548 20.6578 10.9388 20.8601C11.11 20.9518 11.3028 21 11.4988 21C11.6948 21 11.8875 20.9518 12.0587 20.8601C12.445 20.6534 21.541 15.7124 22.7518 9.69587C23.5164 5.92547 22.37 3.61193 21.2743 2.33413ZM20.4993 9.27583C19.6416 13.5326 13.4074 17.492 11.5011 18.6173C8.81516 17.0587 3.28927 13.1457 2.50856 9.27583C1.91872 6.35103 2.72587 4.65208 3.50773 3.74126C3.9212 3.26166 4.43995 2.87596 5.02678 2.61185C5.6136 2.34774 6.25396 2.21175 6.90191 2.21365C7.59396 2.16375 8.28765 2.2871 8.91534 2.57168C9.54304 2.85626 10.0833 3.29235 10.4835 3.83743C10.5822 4.012 10.7278 4.15794 10.9051 4.26003C11.0824 4.36212 11.2849 4.41662 11.4916 4.41787C11.6983 4.41911 11.9015 4.36704 12.0801 4.26709C12.2587 4.16714 12.4062 4.02296 12.5071 3.84959C12.9065 3.30026 13.448 2.86048 14.0781 2.57361C14.7081 2.28674 15.4051 2.16267 16.1002 2.21365C16.7495 2.21061 17.3915 2.34604 17.9798 2.6102C18.5681 2.87435 19.0881 3.26065 19.5025 3.74126C20.282 4.65208 21.0892 6.35103 20.4993 9.27583Z"
                            fill="black"
                          />
                        </svg>
                      </a>
                    </div>
                    <div class="header-action-item">
                          <a
                            href="cart.php"
                            class="header-action-btn cartmini-open-btn"
                            id="cart-icon"
                          >
                            <svg
                              width="21"
                              height="23"
                              viewBox="0 0 21 23"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M14.0625 10.6C14.0625 12.5883 12.4676 14.2 10.5 14.2C8.53243 14.2 6.9375 12.5883 6.9375 10.6M1 5.8H20M1 5.8V13C1 20.6402 2.33946 22 10.5 22C18.6605 22 20 20.6402 20 13V5.8M1 5.8L2.71856 2.32668C3.12087 1.5136 3.94324 1 4.84283 1H16.1571C17.0568 1 17.8791 1.5136 18.2814 2.32668L20 5.8"
                                stroke="black"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                            </svg>
                          </a>
                        </div>

                        <script>
                          // Attach a click event listener to the cart icon
                          document.getElementById("cart-icon").addEventListener("click", function (event) {
                            if (!isLoggedIn || isLoggedIn === "false") {
                              // Prevent navigation
                              event.preventDefault();
                              // Show an alert message
                              alert("Please login to access the cart.");
                            }
                          });
                        </script>

                  </div>
                  <div class="header-humbager ml-30">
                    <a class="sidebar__toggle" href="javascript:void(0)">
                      <div class="bar-icon-2">
                        <span></span>
                        <span></span>
                        <span></span>
                      </div>
                    </a>
                    <!-- for wp -->
                    <div class="header__hamburger ml-50 d-none">
                      <button
                        type="button"
                        class="hamburger-btn offcanvas-open-btn"
                      >
                        <span>01</span>
                        <span>01</span>
                        <span>01</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- Header area end -->



    <main>
        <section class="blog-list">
            <h1>Blog List</h1>

            <!-- Search Bar -->
            <form action="../Backoff/search.php" method="get" class="search-form">
                <input type="text" name="search" placeholder="Search for a blog" class="search-input">
                <button type="submit" class="search-button">Search</button>
            </form>

            <!-- Display Blogs -->
            <?php if (count($blogs) > 0): ?>
                <div class="blog-items">
                    <?php foreach ($blogs as $blog): ?>
                        <div class="blog-item">
                            <h2><?= htmlspecialchars($blog['title']) ?></h2>
                            <p><strong>By: <?= htmlspecialchars($blog['firstname']) ?></strong></p>
                            <p><?= nl2br(htmlspecialchars($blog['content'])) ?></p>
                            <small class="blog-date">Created on: <?= $blog['created_at'] ?></small>
                            <!-- Like/Dislike Reactions -->
                            <div class="blog-reactions">
                                <p>Likes: <?= $blog['likes'] ?> | Dislikes: <?= $blog['dislikes'] ?></p>
                                <form method="post" action="react.php" class="reaction-form">
                                    <input type="hidden" name="blog_id" value="<?= $blog['id'] ?>">
                                    <button type="submit" name="reaction" value="like" class="reaction-button like-button">Like</button>
                                    <button type="submit" name="reaction" value="dislike" class="reaction-button dislike-button">Dislike</button>
                                </form>
                            </div>

                                    <!-- Comments Section -->
                                    <h3>Comments</h3>
                                    <div class="comments-container">
                                        <?php 
                                        // Fetch the comments along with the user names
                                        $stmt = $conn->prepare(
                                            "SELECT comments.*, user.firstname AS user_name 
                                            FROM comments 
                                            JOIN user ON comments.user_id = user.id 
                                            WHERE comments.blog_id = :blog_id"
                                        );
                                        $stmt->bindParam(':blog_id', $blog_id, PDO::PARAM_INT);
                                        $stmt->execute();
                                        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        
                                        if (!empty($comments)): ?>
                                            <div class="comment-list">
                                                <?php foreach ($comments as $comment): ?>
                                                    <div class="comment-item">
                                                        <div class="comment-header">
                                                            <strong class="comment-author"><?= htmlspecialchars($comment['user_name']) ?></strong>
                                                            <span class="comment-date"><?= htmlspecialchars($comment['created_at']) ?></span>
                                                        </div>
                                                        <p class="comment-content"><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php else: ?>
                                            <p class="no-comments">No comments yet.</p>
                                        <?php endif; ?>
                                    </div>

                            <!-- Add Comment Form -->
                            <div id="comment-form-container">
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <form method="post" action="add_comment.php" class="comment-form">
                                        <input type="hidden" name="blog_id" value="<?= $blog['id'] ?>">
                                        <textarea name="content" placeholder="Write a comment..." required></textarea>
                                        <button type="submit" class="submit-comment-button">Add Comment</button>
                                    </form>
                                <?php else: ?>
                                    <p class="login-prompt">You must <a href="login.php">log in</a> to leave a comment.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No blogs found.</p>
            <?php endif; ?>
        </section>
    </main>

    <!-- Footer Section -->
   <footer>
        <div class="footer-links">
            <p><a href="#" aria-label="About Us">About Us</a></p>
            <p><a href="#" aria-label="Terms of Service">Terms of Service</a></p>
            <p><a href="#" aria-label="Privacy Policy">Privacy Policy</a></p>
        </div>
        <div class="footer-socials">
            <h4>Our Socials</h4>
            <p><a href="https://www.facebook.com" aria-label="Facebook">Facebook</a></p>
        </div>
        <div class="footer-contacts">
            <h4>Our Contacts</h4>
            <p><a href="mailto:contact@forumblog.com" aria-label="Email">Email</a></p>
            <p>Call us on +216 999 555 222</p>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Forum Blog Tunisia. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // JavaScript to handle login check for posting comments
        document.querySelectorAll('.comment-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                if (!isLoggedIn || isLoggedIn === "false") {
                    event.preventDefault(); // Prevent form submission
                    alert("Please log in to post a comment.");
                }
            });
        });
    </script>

</body>

</html>
