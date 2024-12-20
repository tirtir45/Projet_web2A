<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../usrview/login.php");
    exit();
}
require_once(__DIR__ . '/../../Controller/EventController.php');
$eventC = new EventController();
$list = $eventC->listEvent();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Home</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Place favicon.ico in the root directory -->
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="../../Assets/imgs/furniture/favicon.png"
    />
    <!-- CSS here -->
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
                      <a class="furniture-clr-hover" href="../usrview/profile.php">My Profile</a>
                    </li>
                    <li>
                      <a class="furniture-clr-hover" href="../usrview/update_profile.php"
                        >Profile settings</a
                      >
                    </li>
                    <li>
                      <a class="furniture-clr-hover" href="cart.php">Cart</a>
                    </li>
                    <li>
                      <a class="furniture-clr-hover" href="../../usrview/logout.php">Logout</a>
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
                          <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="/../../Assets/Images/black-logo.png" width="160" height="50" alt="Logo">
        </a>
        <div class="ml-auto navbar-nav">
            <a class="nav-item nav-link btn btn-outline-primary" href="../FrontOff/Home.php">Home</a>
            <a class="nav-item nav-link btn btn-outline-secondary" href="#" onclick="Alert()">Register</a>
            <a class="nav-item nav-link btn btn-outline-warning" href="#" onclick="Alert()">Login</a>
            <a class="nav-item nav-link btn btn-outline-success" href="addEvent.php">Add Event</a>
        </div>
    </nav>
                        <ul>
                          <li class="has-dropdown">
                            <a href="../Frontoff/index.php">Home</a>
                          </li>
                          <li>
                            <a href="about.html">About</a>
                          </li>
                          <li>
                            <a href="../usrview/profile.php">Profile</a>
                          </li>
                          <li class="has-dropdown">
                          <a href="http://localhost/Tste/php/Views/Frontoff/index.php">Shop</a>
                                <ul class="submenu">
                                    <li><a href="index.php">Product</a></li>
                                    <li><a href="cart.php">Cart</a></li>
                                </ul>
                          </li>
                            <li class="has-dropdown">
                          <a href="index.php">Dicover Tunisia</a>
                                <ul class="submenu">
                                    <li><a href="EventList.php">Events</a></li>
                                    <li><a href="listReservation.php">Reservations</a></li>
                                </ul>
                          </li>
                          <li class="has-dropdown">
                            <a href="view.php">Blog</a>
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

<main>
    <h1>Event List</h1>

    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Preview</th>
                        <th>Description</th>
                        <th>Availability</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($list as $Ev) {
                    ?>
                        <tr>
                            <td><?= $Ev['IdEvent']; ?></td>
                            <td><?= $Ev['title']; ?></td>
                            <td>
                                <img src="<?php echo htmlspecialchars($Ev['Pic']); ?>" width="250" height="100" class="card-img-top" alt="Pic">
                            </td>
                            <td><?= htmlspecialchars($Ev['description']); ?></td>
                            <td><?= $Ev['disponibility'] == 1 ? 'Yes' : 'No'; ?></td>
                            <td><?= htmlspecialchars($Ev['category']); ?></td>
                            <td><?= htmlspecialchars($Ev['price']); ?> TND</td>
                            <td>
                                <form method="POST" action="updateEvent.php">
                                    <input type="submit" class="btn btn-outline-primary" name="update" value="Update">
                                    <input type="hidden" value="<?= $Ev['IdEvent']; ?>" name="id">
                                </form>
                            </td>
                            <td>
                                <a href="deleteEvent.php?id=<?= $Ev['IdEvent']; ?>" class="btn btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<script src="../../jscript/script.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>