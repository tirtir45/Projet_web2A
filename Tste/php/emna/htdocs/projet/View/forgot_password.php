<?php
// Inclure le fichier de configuration de la base de données
include '../config.php';
include 'send.php'; // Inclure le fichier pour l'envoi d'emails

// Obtenir la connexion à la base de données
$conn = config::getConnexion();

$error = '';
$success = '';
$step = 1; // Étape par défaut : formulaire pour entrer l'email

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['send_code'])) {
        // Étape 1 : Envoi du code par email
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

        if (!$email) {
            $error = "Invalid email format.";
        } else {
            // Vérification de l'existence de l'email
            $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
            $stmt->bindValue(1, $email, PDO::PARAM_STR); // Utilisation de bindValue()
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Générer un code aléatoire
                $code = rand(100000, 999999);

                // Stocker le code dans la base de données
                $stmt = $conn->prepare("UPDATE user SET reset_code = ? WHERE email = ?");
                $stmt->bindValue(1, $code, PDO::PARAM_INT); // Utilisation de bindValue()
                $stmt->bindValue(2, $email, PDO::PARAM_STR); // Utilisation de bindValue()
                $stmt->execute();

                // Envoyer le code par email
                $subject = "Password Reset Code";
                $message = "Your password reset code is: $code";

                if (send($email, $subject, $message)) {
                    $success = "A code has been sent to your email.";
                    $step = 2; // Passer à l'étape de vérification du code
                } else {
                    $error = "Failed to send the email. Please try again.";
                }
            } else {
                $error = "This email does not exist in our records.";
            }
        }
    } elseif (isset($_POST['verify_code'])) {
        // Étape 2 : Vérification du code
        $email = $_POST['email'];
        $reset_code = $_POST['reset_code'];

        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ? AND reset_code = ?");
        $stmt->bindValue(1, $email, PDO::PARAM_STR); // Utilisation de bindValue()
        $stmt->bindValue(2, $reset_code, PDO::PARAM_INT); // Utilisation de bindValue()
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $success = "Code verified successfully.";
            $step = 3; // Passer à l'étape de réinitialisation du mot de passe
        } else {
            $error = "Invalid code. Please try again.";
            $step = 2; // Rester à l'étape 2
        }
    } elseif (isset($_POST['reset_password'])) {
        // Étape 3 : Réinitialisation du mot de passe
        $email = $_POST['email'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if ($new_password === $confirm_password) {
            // Hacher le mot de passe et mettre à jour dans la base de données
          //  $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            $stmt = $conn->prepare("UPDATE user SET password = ?, reset_code = NULL WHERE email = ?");
            $stmt->bindValue(1, $new_password, PDO::PARAM_STR); // Utilisation de bindValue()
            $stmt->bindValue(2, $email, PDO::PARAM_STR); // Utilisation de bindValue()
            $stmt->execute();

            $success = "Password reset successfully. You can now log in.";
            header("Location: login.php");
        } else {
            $error = "Passwords do not match. Please try again.";
            $step = 3; // Rester à l'étape 3
        }
    }
}
?>



<!doctype html>
    <html class="no-js" lang="zxx">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Forgot Password</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico in the root directory -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/imgs/furniture/favicon.png">

        <!-- CSS here -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/meanmenu.min.css">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" href="assets/css/swiper.min.css">
        <link rel="stylesheet" href="assets/css/slick.css">
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <link rel="stylesheet" href="assets/css/fontawesome-pro.css">
        <link rel="stylesheet" href="assets/css/spacing.css">
        <link rel="stylesheet" href="assets/css/main.css">
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
    async defer></script>
    <style>
        .form-box { width: 100%; max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ccc; }
        .input-field { width: 100%; padding: 10px; margin: 10px 0; }
        .submit-btn { width: 100%; padding: 10px; background: #007BFF; color: #fff; border: none; cursor: pointer; }
        .error-message { color: red; }
        .success-message { color: green; }
    </style>
    </head>

    <body>

        <!-- preloader start -->
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
        <!-- preloader start -->
        <!-- Header area start -->
        <header>
            <div class="header">

                <div class="header-lang-item tp-header-currency">
                    <span class="header-currency-toggle text-white" id="header-currency-toggle">USD</span>
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
                    <span class="header-setting-toggle text-white" id="header-setting-toggle">Setting</span>
                    <ul>
                        <li>
                            <a class="furniture-clr-hover" href="#">My Profile</a>
                        </li>
                        <li>
                            <a class="furniture-clr-hover" href="wishlist.html">Wishlist</a>
                        </li>
                        <li>
                            <a class="furniture-clr-hover" href="cart.html">Cart</a>
                        </li>
                        <li>
                            <a class="furniture-clr-hover" href="#">Logout</a>
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
                                    <a href="index.html">
                                        <img src="assets/imgs/furniture/logo/logo.svg" alt="logo not found">
                                    </a>
                                </div>
                                <div class="mean__menu-wrapper furniture__menu d-none d-lg-block">
                                    <div class="main-menu">
                                        <nav id="mobile-menu">
                                            <ul>
                                                <li class="has-dropdown">
                                                    <a href="index.html">Home</a>
                                                    <ul class="submenu">
                                                        <li><a href="pharmacy.html">Pharmacy Store</a></li>
                                                        <li><a href="index.html">Furniture Store</a></li>
                                                        <li><a href="grocery.html">Grocery Store</a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <a href="about.html">About</a>
                                                </li>
                                                <li class="has-dropdown">
                                                    <a href="product.html">Shop</a>
                                                    <ul class="submenu">
                                                        <li><a href="product.html">Product</a></li>
                                                        <li><a href="product-details.html">Product Details</a></li>
                                                        <li><a href="wishlist.html">Wishlist</a></li>
                                                        <li><a href="cart.html">Cart</a></li>
                                                        <li><a href="checkout.html">Checkout</a></li>
                                                    </ul>
                                                </li>
                                                <li class="has-dropdown">
                                                    <a href="about.html">Pages</a>
                                                    <ul class="submenu">
                                                        <li><a href="about.html">About Us</a></li>
                                                        <li><a href="store.html">Find a Store</a></li>
                                                        <li><a href="portfolio.html">Portfolio</a></li>
                                                        <li><a href="portfolio-details.html">Portfolio Details</a></li>
                                                        <li><a href="faq.html">Faq</a></li>
                                                        <li><a href="coming-soon.html">Coming Soon</a></li>
                                                        <li><a href="error.html">404</a></li>
                                                    </ul>
                                                </li>
                                                <li class="has-dropdown">
                                                    <a href="blog.html">Blog</a>
                                                    <ul class="submenu">
                                                        <li><a href="blog.html">Blog Default</a></li>
                                                        <li><a href="blog-grid.html">Blog Grid</a></li>
                                                        <li><a href="blog-details.html">Blog Details</a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <a href="contact.html">Contact</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="header-right d-inline-flex align-items-center justify-content-end">
                                <div class="header-search d-none d-xxl-block">
                                    <form action="#">
                                        <input type="text" placeholder="Search...">
                                        <button type="submit">
                                 <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.4443 13.4445L16.9999 17" stroke="white" stroke-width="2"
                                       stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                       d="M15.2222 8.11111C15.2222 12.0385 12.0385 15.2222 8.11111 15.2222C4.18375 15.2222 1 12.0385 1 8.11111C1 4.18375 4.18375 1 8.11111 1C12.0385 1 15.2222 4.18375 15.2222 8.11111Z"
                                       stroke="white" stroke-width="2" />
                                 </svg>
                              </button>
                                    </form>
                                </div>
                                <div class="header-action d-flex align-items-center ml-30">
                                    <div class="header-action-item">
                                        <a href="wishlist.html" class="header-action-btn">
                                            <svg width="23" height="21" viewBox="0 0 23 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                       d="M21.2743 2.33413C20.6448 1.60193 19.8543 1.01306 18.9596 0.609951C18.0649 0.206838 17.0883 -0.0004864 16.1002 0.00291444C14.4096 -0.0462975 12.7637 0.529279 11.5011 1.61122C10.2385 0.529279 8.59252 -0.0462975 6.90191 0.00291444C5.91383 -0.0004864 4.93727 0.206838 4.04257 0.609951C3.14788 1.01306 2.35732 1.60193 1.72785 2.33413C0.632101 3.61193 -0.514239 5.92547 0.245772 9.69587C1.4588 15.7168 10.5548 20.6578 10.9388 20.8601C11.11 20.9518 11.3028 21 11.4988 21C11.6948 21 11.8875 20.9518 12.0587 20.8601C12.445 20.6534 21.541 15.7124 22.7518 9.69587C23.5164 5.92547 22.37 3.61193 21.2743 2.33413ZM20.4993 9.27583C19.6416 13.5326 13.4074 17.492 11.5011 18.6173C8.81516 17.0587 3.28927 13.1457 2.50856 9.27583C1.91872 6.35103 2.72587 4.65208 3.50773 3.74126C3.9212 3.26166 4.43995 2.87596 5.02678 2.61185C5.6136 2.34774 6.25396 2.21175 6.90191 2.21365C7.59396 2.16375 8.28765 2.2871 8.91534 2.57168C9.54304 2.85626 10.0833 3.29235 10.4835 3.83743C10.5822 4.012 10.7278 4.15794 10.9051 4.26003C11.0824 4.36212 11.2849 4.41662 11.4916 4.41787C11.6983 4.41911 11.9015 4.36704 12.0801 4.26709C12.2587 4.16714 12.4062 4.02296 12.5071 3.84959C12.9065 3.30026 13.448 2.86048 14.0781 2.57361C14.7081 2.28674 15.4051 2.16267 16.1002 2.21365C16.7495 2.21061 17.3915 2.34604 17.9798 2.6102C18.5681 2.87435 19.0881 3.26065 19.5025 3.74126C20.282 4.65208 21.0892 6.35103 20.4993 9.27583Z"
                                       fill="black" />
                                 </svg>
                                            <span class="header-action-badge bg-furniture">3</span>
                                        </a>
                                    </div>
                                    <div class="header-action-item">
                                        <a href="cart.html" class="header-action-btn cartmini-open-btn">
                                            <svg width="21" height="23" viewBox="0 0 21 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                       d="M14.0625 10.6C14.0625 12.5883 12.4676 14.2 10.5 14.2C8.53243 14.2 6.9375 12.5883 6.9375 10.6M1 5.8H20M1 5.8V13C1 20.6402 2.33946 22 10.5 22C18.6605 22 20 20.6402 20 13V5.8M1 5.8L2.71856 2.32668C3.12087 1.5136 3.94324 1 4.84283 1H16.1571C17.0568 1 17.8791 1.5136 18.2814 2.32668L20 5.8"
                                       stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                 </svg>
                                            <span class="header-action-badge bg-furniture">12</span>
                                        </a>
                                    </div>
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
                                        <button type="button" class="hamburger-btn offcanvas-open-btn">
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
    <div class="form-box">


<br>

        <h3>Forgot Password</h3>

        <!-- Affichage des messages -->
        <?php if (!empty($error)): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <p class="success-message"><?php echo $success; ?></p>
        <?php endif; ?>

        <!-- Étape 1 : Entrer l'email -->
        <?php if ($step === 1): ?>
            <form method="POST" action="">
                <input type="email" name="email" class="input-field" placeholder="Enter your email address" required>
                <button type="submit" name="send_code" class="submit-btn">Send Code</button>
            </form>
        <?php endif; ?>

        <!-- Étape 2 : Vérification du code -->
        <?php if ($step === 2): ?>
            <form method="POST" action="">
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($_POST['email']); ?>">
                <input type="text" name="reset_code" class="input-field" placeholder="Enter the code" required>
                <button type="submit" name="verify_code" class="submit-btn">Verify Code</button>
            </form>
        <?php endif; ?>

        <!-- Étape 3 : Réinitialisation du mot de passe -->
        <?php if ($step === 3): ?>
            <form method="POST" action="">
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($_POST['email']); ?>">
                <input type="password" name="new_password" class="input-field" placeholder="Enter new password" required>
                <input type="password" name="confirm_password" class="input-field" placeholder="Confirm new password" required>
                <button type="submit" name="reset_password" class="submit-btn">Reset Password</button>
            </form>
        <?php endif; ?>
    </div>
  <!-- Footer area start -->
  <footer class="footer-bg">
            <div class="footer-area pt-100 pb-20">
                <div class="footer-style-4">
                    <div class="container">
                        <div class="footer-grid-3">
                            <div class="footer-widget-4">
                                <div class="footer-logo mb-35">
                                    <a href="index.html"><img src="assets/imgs/furniture/logo/logo-light.svg" alt="image bnot found"></a>
                                </div>
                                <p>It helps designers plan out where the content will sit, the content to be written and approved.
                                </p>
                                <div class="theme-social">
                                    <a class="furniture-bg-hover" href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                    <a class="furniture-bg-hover" href="#"><i class="fa-brands fa-twitter"></i></a>
                                    <a class="furniture-bg-hover" href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                                    <a class="furniture-bg-hover" href="#"><i class="fa-brands fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="footer-widget-4">
                                <div class="footer-widget-title">
                                    <h4>Services</h4>
                                </div>
                                <div class="footer-link">
                                    <ul>
                                        <li><a href="error.html">Log In</a></li>
                                        <li><a href="wishlist.html">Wishlist</a></li>
                                        <li><a href="error.html">Return Policy</a></li>
                                        <li><a href="error.html">Privacy policy</a></li>
                                        <li><a href="faq.html">Shopping FAQs</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="footer-widget-4">
                                <div class="footer-widget-title">
                                    <h4>Company</h4>
                                </div>
                                <div class="footer-link">
                                    <ul>
                                        <li><a href="index.html">Home</a></li>
                                        <li><a href="about.html">About us </a></li>
                                        <li><a href="about.html">Pages</a></li>
                                        <li><a href="blog.html">Blog</a></li>
                                        <li><a href="contact.html">Contact us</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="footer-widget footer-col-4">
                                <div class="footer-widget-title">
                                    <h4>Contact</h4>
                                </div>
                                <div class="footer-info mb-35">
                                    <p class="w-75">4517 Washington Ave. Manchester, Kentucky 39495</p>
                                    <div class="footer-info-item d-flex align-items-start pb-15 pt-15">
                                        <div class="footer-info-icon mr-20">
                                            <span> <i class="fa-solid fa-location-dot furniture-icon"></i></span>
                                        </div>
                                        <div class="footer-info-text">
                                            <a class="furniture-clr-hover" target="_blank" href="https://www.google.com/maps/place/Orville+St,+La+Presa,+CA+91977,+USA/@32.7092048,-117.0082772,17z/data=!3m1!4b1!4m5!3m4!1s0x80d9508a9aec8cd1:0x72d1ac1c9527b705!8m2!3d32.7092003!4d-117.0060885">711-2880
                                 Nulla St.</a>
                                        </div>
                                    </div>
                                    <div class="footer-info-item d-flex align-items-start">
                                        <div class="footer-info-icon mr-20">
                                            <span><i class="fa-solid fa-phone furniture-icon"></i></span>
                                        </div>
                                        <div class="footer-info-text">
                                            <a class="furniture-clr-hover" href="tel:012-345-6789">+964 742 44 763</a>
                                            <p>Mon - Sat: 9 AM - 5 PM</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="footer-copyright-area b-t">
                    <div class="footer-copyright-wrapper">
                        <div class="footer-copyright-text">
                            <p class="mb-0">© All Copyright 2024 by <a target="_blank" class="furniture-clr-hover" href="#">Addina</a></p>
                        </div>
                        <div class="footer-payment d-flex align-items-center gap-2">
                            <div class="footer-payment-item mb-0">
                                <div class="footer-payment-thumb">
                                    <img src="assets/imgs/icons/payoneer.png" alt="">
                                </div>
                            </div>
                            <div class="footer-payment-item mb-0">
                                <div class="footer-payment-thumb">
                                    <img src="assets/imgs/icons/maser.png" alt="">
                                </div>
                            </div>
                            <div class="footer-payment-item">
                                <div class="footer-payment-thumb">
                                    <img src="assets/imgs/icons/paypal.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="footer-conditions">
                            <ul>
                                <li><a class="furniture-clr-hover" href="#">Terms & Condition</a></li>
                                <li><a class="furniture-clr-hover" href="#">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer area end -->
        <!-- JS here -->
       
        <script src="assets/js/jquery-3.6.0.min.js"></script>
        <script src="assets/js/waypoints.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/meanmenu.min.js"></script>
        <script src="assets/js/swiper.min.js"></script>
        <script src="assets/js/slick.min.js"></script>
        <script src="assets/js/magnific-popup.min.js"></script>
        <script src="assets/js/counterup.js"></script>
        <script src="assets/js/wow.js"></script>
        <script src="assets/js/ajax-form.js"></script>
        <script src="assets/js/beforeafter.jquery-1.0.0.min.js"></script>
        <script src="assets/js/main.js"></script>
    </body>

    </html>