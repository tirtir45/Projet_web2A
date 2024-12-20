<?php
session_start();
ob_start();
// Vérifier si l'utilisateur est connecté et a un rôle d'administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    ob_end_clean();
    header("Location: login.php");
    exit();
}

include '../../Controller/UserController.php';
$userController = new UserController();

if (isset($_GET['search_id']) && !empty($_GET['search_id'])) {
    $searchId = intval($_GET['search_id']);
    $users = [];
    $user = $userController->getUserById($searchId);
    if ($user) {
        $users[] = $user; // Ajouter le résultat dans le tableau
    }
} else {
    // Récupérer la liste des utilisateurs si aucune recherche n'est effectuée
    $users = $userController->listUsers();
}

?>


<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <!-- Basic metas
    ======================================== -->
    <meta charset="utf-8">
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Mobile specific metas
    ======================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="og:title" content="Documentation">
    <meta property="og:url" content="index.html">
    <!-- Page Title
    ======================================== -->
    <title>DashBoard</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
    <!-- fonts
	======================================== -->
    <link rel="stylesheet" type="text/css" href="css/elegantFont.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="css/vendor/bootstrap.min.css">
    <!-- Custom css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <link rel="stylesheet" href="../../Assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../Assets/css/meanmenu.min.css" />
    <link rel="stylesheet" href="../../Assets/css/animate.css" />
    <link rel="stylesheet" href="../../Assets/css/swiper.min.css" />
    <link rel="stylesheet" href="../../assets/css/slick.css" />
    <link rel="stylesheet" href="../../assets/css/magnific-popup.css" />
    <link rel="stylesheet" href="../../assets/css/fontawesome-pro.css" />
    <link rel="stylesheet" href="../../assets/css/spacing.css" />
    <link rel="stylesheet" href="../../assets/css/main.css" />
    <link rel="stylesheet" href="../../assets/css/shopping.css" />
</head>

<body>
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->
    <!-- Header starts -->
    <a href="#top" class="back-to-top">
        <i class="fal fa-arrow-up"></i>
    </a>
     <header>
      <div class="header">
        <div class="header-top-area grocery__top-header">
          <div class="header-layout-4">
            <div class="header-to-main d-none d-sm-flex">
              <div class="link-text">
                <span><img src="../../Assets/imgs/icons/call.png" alt="" /></span>
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
                      <a class="furniture-clr-hover" href="#">Users</a>
                    </li>
                    <li>
                      <a class="furniture-clr-hover" href="update_profile.php"
                        >Profile settings</a
                      >
                    </li>
                    <li>
                      <a class="furniture-clr-hover" href="../Backoff/dashboard.php">Cart</a>
                    </li>
                    <li>
                      <a class="furniture-clr-hover" href="logout.php">Logout</a>
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
                    <a href="../Frontoff/index.php">
                      <img
                         id="logo" src="../../Assets/imgs/furniture/logo/black-logo.png"
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
                            <a href="../Frontoff/index.php">Home</a>
                          </li>
                          <li>
                            <a href="../Frontoff/about.html">About</a>
                          </li>
                          <li>
                            <a href="profile.php">Profile</a>
                          </li>
                          <li class="has-dropdown">
                          <a href="http://localhost/Tste/php/Views/Frontoff/index.php">Shop</a>
                                <ul class="submenu">
                                    <li><a href="../Backoff/dashboard.php">Product</a></li>
                                    <li><a href="../Backoff/dashboard.php">Cart</a></li>
                                </ul>
                          </li>
                            <li class="has-dropdown">
                          <a href="index.php">Dicover Tunisia</a>
                                <ul class="submenu">
                                    <li><a href="../BackOff/EventList.php">Events</a></li>
                                    <li><a href="../Backoff/listReservation.php">Reservations</a></li>
                                </ul>
                          </li>
                          <li class="has-dropdown">
                            <a href="../Forntoff/view.php">Blog</a>
                          </li>
                          <li>
                            <a href="../Frontoff/rymcontact.html">Contact</a>
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
    <div class="main-content-wrapper">
        <div class="container ">





        <h2>Liste des utilisateurs</h2>
<!-- Bouton pour ajouter un nouvel utilisateur -->
<a href="adduser.php" class="btn btn-success btn-sm">Ajouter un utilisateur</a>
<form method="GET" action="" class="form-inline mb-3">
    <label for="search-id" class="mr-2">Rechercher par ID :</label>
    <input type="text" id="search-id" name="search_id" class="form-control mr-2" placeholder="Entrer l'ID" >
    <button type="submit" class="btn btn-primary">Rechercher</button>
</form>

<br><br> <!-- Ajouter un peu d'espace avant la table -->
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['firstname']; ?></td>
                <td><?php echo $user['lastname']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['role']; ?></td>
                <td>
                    <a href="updateuser.php?id=<?php echo $user['id']; ?>" class="btn btn-warning">Modifier</a>
                   <a href="deleteuser.php?id=<?php echo $user['id']; ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?');">Supprimer</a>
                   <a href="blockuser.php?id=<?php echo $user['id']; ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir blocker cet utilisateur?');">block</a>
                   <a href="unblockuser.php?id=<?php echo $user['id']; ?>" 
   class="btn btn-success" 
   onclick="return confirm('Êtes-vous sûr de vouloir débloquer cet utilisateur ?');">
   Débloquer l'utilisateur
</a>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>









            <!-- End of .main-content -->
        </div>
        <!-- End of .container -->
    </div>
    <!-- End of .main-content -->
     <footer class="footer-bg">
      <div class="footer-area pt-100 pb-20">
        <div class="footer-style-4">
          <div class="container">
            <div class="footer-grid-3">
              <div class="footer-widget-4">
                <div class="footer-logo mb-35">
                  <a href="index.html"
                    ><img id="logow"
                      src="../../assets/imgs/furniture/logo/new.png"
                      alt="image bnot found"
                  /></a>
                </div>
                <p>
                  It helps designers plan out where the content will sit, the
                  content to be written and approved.
                </p>
                <div class="theme-social">
                  <a class="furniture-bg-hover" href="#"
                    ><i class="fa-brands fa-facebook-f"></i
                  ></a>
                  <a class="furniture-bg-hover" href="#"
                    ><i class="fa-brands fa-twitter"></i
                  ></a>
                  <a class="furniture-bg-hover" href="#"
                    ><i class="fa-brands fa-linkedin-in"></i
                  ></a>
                  <a class="furniture-bg-hover" href="#"
                    ><i class="fa-brands fa-instagram"></i
                  ></a>
                </div>
              </div>
              <div class="footer-widget-4">
                <div class="footer-widget-title">
                  <h4>Services</h4>
                </div>
                <div class="footer-link">
                  <ul>
                    <li><a href="error.html">Log In</a></li>
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
                    <li><a href="http://localhost/Tste/php/index.php">Home</a></li>
                    <li><a href="about.html">About us </a></li>
                    <li><a href="about.html">Pages</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="../../FrontOff/Disco">Blog</a></li>

                    <li><a href="rymcontact.html">Contact us</a></li>
                  </ul>
                </div>
              </div>
              <div class="footer-widget footer-col-4">
                <div class="footer-widget-title">
                  <h4>Contact</h4>
                </div>
                <div class="footer-info mb-35">
                  <p class="w-75">
                    4517 Washington Ave. Manchester, Kentucky 39495
                  </p>
                  <div
                    class="footer-info-item d-flex align-items-start pb-15 pt-15"
                  >
                    <div class="footer-info-icon mr-20">
                      <span>
                        <i class="fa-solid fa-location-dot furniture-icon"></i
                      ></span>
                    </div>
                    <div class="footer-info-text">
                      <a
                        class="furniture-clr-hover"
                        target="_blank"
                        href="https://www.google.com/maps/place/Orville+St,+La+Presa,+CA+91977,+USA/@32.7092048,-117.0082772,17z/data=!3m1!4b1!4m5!3m4!1s0x80d9508a9aec8cd1:0x72d1ac1c9527b705!8m2!3d32.7092003!4d-117.0060885"
                        >711-2880 Nulla St.</a
                      >
                    </div>
                  </div>
                  <div class="footer-info-item d-flex align-items-start">
                    <div class="footer-info-icon mr-20">
                      <span
                        ><i class="fa-solid fa-phone furniture-icon"></i
                      ></span>
                    </div>
                    <div class="footer-info-text">
                      <a class="furniture-clr-hover" href="tel:012-345-6789"
                        >+964 742 44 763</a
                      >
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
              <p class="mb-0">
                © All Copyright 2024 by
                <a target="_blank" class="furniture-clr-hover" href="#"
                  >Khomsa w Khmiss</a
                >
              </p>
            </div>
            <div class="footer-payment d-flex align-items-center gap-2">
              <div class="footer-payment-item mb-0">
                <div class="footer-payment-thumb">
                  <img src="../../assets/imgs/icons/payoneer.png" alt="" />
                </div>
              </div>
              <div class="footer-payment-item mb-0">
                <div class="footer-payment-thumb">
                  <img src="../../assets/imgs/icons/maser.png" alt="" />
                </div>
              </div>
              <div class="footer-payment-item">
                <div class="footer-payment-thumb">
                  <img src="../../assets/imgs/icons/paypal.png" alt="" />
                </div>
              </div>
            </div>
            <div class="footer-conditions">
              <ul>
                <li>
                  <a class="furniture-clr-hover" href="#">Terms & Condition</a>
                </li>
                <li>
                  <a class="furniture-clr-hover" href="#">Privacy Policy</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- End of .page-footer -->
    <!-- Javascripts
		======================================= -->
    <!-- jQuery -->
    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/vendor/jquery-migrate.min.js"></script>
    <script src="js/vendor/bootstrap.bundle.min.js"></script>
    <!-- jQuery Easing Plugin -->
    <script src="js/vendor/easing-1.3.js"></script>
  
    <!-- Custom Script -->
    <script src="js/onpage-menu.js"></script>
    <script src="js/main.js"></script>
    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../../assets/js/waypoints.min.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/meanmenu.min.js"></script>
    <script src="../../assets/js/swiper.min.js"></script>
    <script src="../../assets/js/slick.min.js"></script>
    <script src="../../assets/js/magnific-popup.min.js"></script>
    <script src="../../assets/js/counterup.js"></script>
    <script src="../../assets/js/wow.js"></script>
    <script src="../../assets/js/ajax-form.js"></script>
    <script src="../../assets/js/beforeafter.jquery-1.0.0.min.js"></script>
    <script src="../../assets/js/main.js"></script>
    <script src="../../assets/cart.js"></script>
</body>

</html>