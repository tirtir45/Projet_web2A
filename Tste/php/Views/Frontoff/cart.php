<?php
session_start();
require_once '../../connect.php'; // Adjust the path as per your project structure

// Create a Database instance and get the PDO connection
$database = new config();
$conn = $database::getConnexion();

// Retrieve cart items from the database
$stmt = $conn->prepare("SELECT * FROM cart");
$stmt->execute();
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle product deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteProduct'])) {
    $productName = $_POST['deleteProduct'];

    // Database deletion logic
    $stmt = $conn->prepare("DELETE FROM cart WHERE product_name = :product_name");
    $stmt->bindParam(":product_name", $productName, PDO::PARAM_STR);
    $stmt->execute();

    // Respond with a success message
    echo json_encode(["status" => "success", "message" => "Product '$productName' has been removed from the cart."]);
    exit();
}

// Handle quantity updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateQuantity'])) {
    $productName = $_POST['updateQuantity'];
    $newQuantity = $_POST['newQuantity'];

    // Update quantity in the database
    $stmt = $conn->prepare("UPDATE cart SET quantity = :quantity WHERE product_name = :product_name");
    $stmt->bindParam(":quantity", $newQuantity, PDO::PARAM_INT);
    $stmt->bindParam(":product_name", $productName, PDO::PARAM_STR);
    $stmt->execute();

    // Respond with a success message
    echo json_encode(["status" => "success", "message" => "Quantity of '$productName' has been updated to $newQuantity."]);
    exit();
}

// Handle the redirection after confirming the purchase (Buy Now)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buyNow'])) {
    // Store cart_id in session to use on delivery.php
    $_SESSION['cart_id'] = session_id();  // or use your own method to generate cart_id

    // Respond with success message to trigger the redirection on the client side
    echo json_encode(["status" => "success", "message" => "Your purchase is confirmed. Redirecting to the delivery page."]);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="../../assets/css/meanmenu.min.css">
   <link rel="stylesheet" href="../../assets/css/animate.css">
   <link rel="stylesheet" href="../../assets/css/swiper.min.css">
   <link rel="stylesheet" href="../../assets/css/slick.css">
   <link rel="stylesheet" href="../../assets/css/magnific-popup.css">
   <link rel="stylesheet" href="../../assets/css/fontawesome-pro.css">
   <link rel="stylesheet" href="../../assets/css/spacing.css">
   <link rel="stylesheet" href="../../assets/css/3asfoura.css">
   <link rel="stylesheet" href="../../assets/css/main.css">
    <title>Your Cart</title>
    <style>
        /* Add some basic styling */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        img {
            max-width: 100px; /* Set a fixed width for images */
            height: auto; /* Maintain aspect ratio */
        }

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

            .alert.success {
                color: green;
                border-color: green;
            }

            .alert.error {
                color: red;
                border-color: red;
            }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
            text-align: left;
        }

            .cart-table th, .cart-table td {
                padding: 12px 15px;
                border: 1px solid #ddd;
            }

            .cart-table thead {
                background-color: #f4f4f4;
            }

            .cart-table tbody tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            .cart-table .empty-cart {
                text-align: center;
                font-size: 18px;
                color: #888;
            }

        .cart-image {
            width: 80px;
            height: auto;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .quantity-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
        }

            .quantity-btn:hover {
                background-color: #0056b3;
            }

        .quantity-input {
            width: 50px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        .remove-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
        }

            .remove-btn:hover {
                background-color: #b02a37;
            }

        .cart-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 25px;
        }

        .buy-now-btn, .return-shop-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

            .buy-now-btn:hover {
                background-color: #218838;
            }

        .return-shop-btn {
            background-color: #007bff;
        }

            .return-shop-btn:hover {
                background-color: #0056b3;
            }

        .cart-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .buy-now-btn {
            background: linear-gradient(135deg, #28a745, #218838);
            color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

            .buy-now-btn:hover {
                background: linear-gradient(135deg, #218838, #28a745);
                transform: translateY(-2px);
                box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
            }

        .return-shop-btn {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

            .return-shop-btn:hover {
                background: linear-gradient(135deg, #0056b3, #007bff);
                transform: translateY(-2px);
                box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
            }

        <style >
        .cart-buttons button {
            padding: 10px 20px;
            background-color: #ff6347;
            color: white;
            border: none;
            cursor: pointer;
            margin: 10px;
        }

        .cart-buttons button:hover {
            background-color: #ff4500;
        }

        .alert {
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .empty-cart {
            text-align: center;
            font-size: 18px;
            color: gray;
        }

    </style>
    <script src="../../assets/js/ajax.js" defer></script> <!-- Include AJAX JS file -->
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

      <!-- Back to top start -->
      <div class="backtotop-wrap cursor-pointer">
      <svg class="backtotop-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
         <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
      </svg>
   </div>
   <!-- Back to top end -->

       <!-- search area start -->
       <div class="df-search-area">
      <div class="container">
         <div class="row">
            <div class="col-xl-12">
               <div class="df-search-form">
                  <div class="df-search-close text-center mb-20">
                     <button class="df-search-close-btn df-search-close-btn"></button>
                  </div>
                  <form action="#">
                     <div class="df-search-input mb-10">
                        <input type="text" placeholder="Search for product...">
                        <button type="submit"><i class="flaticon-search-1"></i></button>
                     </div>
                     <div class="df-search-category">
                        <span>Search by : </span>
                        <a href="#">Healthline, </a>
                        <a href="#">COVID-19, </a>
                        <a href="#">Surgery, </a>
                        <a href="#">Surgeon, </a>
                        <a href="#">Medical research</a>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="body-overlay"></div>
   <!-- search area end -->

      <!-- Offcanvas area start -->
      <div class="fix">
      <div class="offcanvas__info">
         <div class="offcanvas__wrapper">
            <div class="offcanvas__content">
               <div class="offcanvas__top mb-40 d-flex justify-content-between align-items-center">
                  <div class="offcanvas__logo">
                     <a href="index.php">
                        <img src="../../assets/imgs/logo/new.png" alt="logo not found">
                     </a>
                  </div>
                  <div class="offcanvas__close">
                     <button>
                        <i class="fal fa-times"></i>
                     </button>
                  </div>
               </div>
               <div class="offcanvas__search mb-25">
                  <form action="#">
                     <input type="text" placeholder="What are you searching for?">
                     <button type="submit"><i class="far fa-search"></i></button>
                  </form>
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
                              href="https://www.google.com/maps/place/Dhaka/@23.7806207,90.3492859,12z/data=!3m1!4b1!4m5!3m4!1s0x3755b8b087026b81:0x8fa563bbdd5904c2!8m2!3d23.8104753!4d90.4119873">12/A,
                              Mirnada City Tower, NYC</a>
                        </div>
                     </li>
                     <li class="d-flex align-items-center">
                        <div class="offcanvas__contact-icon mr-15">
                           <i class="far fa-phone"></i>
                        </div>
                        <div class="offcanvas__contact-text">
                           <a href="tel:+088889797697">+088889797697</a>
                        </div>
                     </li>
                     <li class="d-flex align-items-center">
                        <div class="offcanvas__contact-icon mr-15">
                           <i class="fal fa-envelope"></i>
                        </div>
                        <div class="offcanvas__contact-text">
                           <a href="tel:+012-345-6789"><span class="mailto:support@mail.com">support@mail.com</span></a>
                        </div>
                     </li>
                  </ul>
               </div>
               <div class="offcanvas__social">
                  <ul>
                     <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                     <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                     <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                     <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
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
                     <span><img src="../../assets/imgs/icons/call.png" alt=""></span>
                     <a href="tel:+380961381876">+380961381876</a>
                  </div>
                  <div class="header-top-notice d-none d-lg-block">
                     <p>TAKE CARE OF YOUR Health <span class="text-white">25% OFF</span> USE CODE “ DOFIX03 ”</p>
                  </div>
                  <div class="tp-header-top-menu d-flex align-items-center justify-content-end">
                     <div class="header-lang-item header-lang">
                        <span class="header-lang-toggle text-white" id="header-lang-toggle">English</span>
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
                           <a href="index.php">
                              <img src="../../assets/imgs/furniture/logo/black-logo.png" alt="logo not found">
                           </a>
                        </div>
                        <div class="mean__menu-wrapper furniture__menu d-none d-lg-block">
                           <div class="main-menu">
                              <nav id="mobile-menu">
                                 <ul>
                                    <li class="has-dropdown">
                                       <a href="index.php">Home</a>
                                       <ul class="submenu">
                                          <li><a href="pharmacy.html">Pharmacy Store</a></li>
                                          <li><a href="index.php">Furniture Store</a></li>
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
                                 <svg width="23" height="21" viewBox="0 0 23 21" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                       d="M21.2743 2.33413C20.6448 1.60193 19.8543 1.01306 18.9596 0.609951C18.0649 0.206838 17.0883 -0.0004864 16.1002 0.00291444C14.4096 -0.0462975 12.7637 0.529279 11.5011 1.61122C10.2385 0.529279 8.59252 -0.0462975 6.90191 0.00291444C5.91383 -0.0004864 4.93727 0.206838 4.04257 0.609951C3.14788 1.01306 2.35732 1.60193 1.72785 2.33413C0.632101 3.61193 -0.514239 5.92547 0.245772 9.69587C1.4588 15.7168 10.5548 20.6578 10.9388 20.8601C11.11 20.9518 11.3028 21 11.4988 21C11.6948 21 11.8875 20.9518 12.0587 20.8601C12.445 20.6534 21.541 15.7124 22.7518 9.69587C23.5164 5.92547 22.37 3.61193 21.2743 2.33413ZM20.4993 9.27583C19.6416 13.5326 13.4074 17.492 11.5011 18.6173C8.81516 17.0587 3.28927 13.1457 2.50856 9.27583C1.91872 6.35103 2.72587 4.65208 3.50773 3.74126C3.9212 3.26166 4.43995 2.87596 5.02678 2.61185C5.6136 2.34774 6.25396 2.21175 6.90191 2.21365C7.59396 2.16375 8.28765 2.2871 8.91534 2.57168C9.54304 2.85626 10.0833 3.29235 10.4835 3.83743C10.5822 4.012 10.7278 4.15794 10.9051 4.26003C11.0824 4.36212 11.2849 4.41662 11.4916 4.41787C11.6983 4.41911 11.9015 4.36704 12.0801 4.26709C12.2587 4.16714 12.4062 4.02296 12.5071 3.84959C12.9065 3.30026 13.448 2.86048 14.0781 2.57361C14.7081 2.28674 15.4051 2.16267 16.1002 2.21365C16.7495 2.21061 17.3915 2.34604 17.9798 2.6102C18.5681 2.87435 19.0881 3.26065 19.5025 3.74126C20.282 4.65208 21.0892 6.35103 20.4993 9.27583Z"
                                       fill="black" />
                                 </svg>
                                 <span class="header-action-badge bg-furniture">3</span>
                              </a>
                           </div>
                           <div class="header-action-item">
                              <a href="cart.html" class="header-action-btn cartmini-open-btn">
                                 <svg width="21" height="23" viewBox="0 0 21 23" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
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
   <!-- Header area end -->

   <div class="breadcrumb__area theme-bg-1 p-relative z-index-11 pt-95 pb-95">
   <div class="breadcrumb__thumb" data-background="assets/imgs/bg/breadcrumb-bg.jpg"></div>
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-xxl-12">
            <div class="breadcrumb__wrapper text-center">
               <h2 class="breadcrumb__title">Cart</h2>
               <div class="breadcrumb__menu">
                  <nav>
                     <ul>
                        <li><span><a href="index.php">Home</a></span></li>
                        <li><span>Cart</span></li>
                     </ul>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

    <div class="container">
        <h1>Your Shopping Cart</h1>

        <!-- Display message -->
        <div id="message"></div>

        <!-- Cart Table -->
        <table id="cartTable">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($cartItems)): ?>
                    <tr>
                        <td colspan="5" class="empty-cart">Your cart is empty.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($cartItems as $item): ?>
                        <tr id="row-<?php echo htmlspecialchars($item['product_name']); ?>">
                            <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                            <td>
                                <img src="<?php echo str_replace('/newaddina', '../../', $item['image']); ?>" alt="Product Image" class="cart-image">
                            </td>
                            <td><?php echo htmlspecialchars($item['price']); ?> DT</td>
                            <td>
                                <div class="quantity-controls">
                                    <button class="quantity-btn" data-product="<?php echo htmlspecialchars($item['product_name']); ?>" data-action="decrease">-</button>
                                    <span id="quantity-<?php echo htmlspecialchars($item['product_name']); ?>"><?php echo htmlspecialchars($item['quantity']); ?></span>
                                    <button class="quantity-btn" data-product="<?php echo htmlspecialchars($item['product_name']); ?>" data-action="increase">+</button>
                                </div>
                            </td>
                            <td>
                                <!-- Delete Button -->
                                <button class="remove-btn" data-product="<?php echo htmlspecialchars($item['product_name']); ?>">Remove</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Buy Now and Return to Shop Buttons -->
        <div class="cart-buttons">
            <button 
                type="button" 
                class="cart-btn buy-now-btn" 
                id="buyNowBtn">
                🛒 Buy Now
            </button>

            <button 
                type="button" 
                class="cart-btn return-shop-btn" 
                onclick="window.location.href='index.php'">
                ⬅️ Return to Shop
            </button>
        </div>
    </div>


    <footer class="footer-bg">
      <div class="footer-area pt-100 pb-20">
         <div class="footer-style-4">
            <div class="container">
               <div class="footer-grid-3">
                  <div class="footer-widget-4">
                     <div class="footer-logo mb-35">
                        <a href="index.html"><img src="../../assets/imgs/furniture/logo/new.png"
                              alt="image bnot found"></a>
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
                              <a class="furniture-clr-hover" target="_blank"
                                 href="https://www.google.com/maps/place/Orville+St,+La+Presa,+CA+91977,+USA/@32.7092048,-117.0082772,17z/data=!3m1!4b1!4m5!3m4!1s0x80d9508a9aec8cd1:0x72d1ac1c9527b705!8m2!3d32.7092003!4d-117.0060885">711-2880
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
                  <p class="mb-0">© All Copyright 2024 by <a target="_blank" class="furniture-clr-hover"
                        href="#">Khomsa w Khmis</a></p>
               </div>
               <div class="footer-payment d-flex align-items-center gap-2">
                  <div class="footer-payment-item mb-0">
                     <div class="footer-payment-thumb">
                        <img src="../../assets/imgs/icons/payoneer.png" alt="">
                     </div>
                  </div>
                  <div class="footer-payment-item mb-0">
                     <div class="footer-payment-thumb">
                        <img src="../../assets/imgs/icons/maser.png" alt="">
                     </div>
                  </div>
                  <div class="footer-payment-item">
                     <div class="footer-payment-thumb">
                        <img src="../../assets/imgs/icons/paypal.png" alt="">
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

</body>

<!-- JavaScript to handle AJAX operations -->
<script>
    // Handle Buy Now button click event
    document.getElementById('buyNowBtn').addEventListener('click', function() {
        // Send AJAX request to confirm the purchase
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'cart.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                
                // Show the message
                var messageDiv = document.getElementById('message');
                messageDiv.innerHTML = `<div class="alert ${response.status === 'success' ? 'success' : 'error'}">${response.message}</div>`;

                // If successful, redirect to delivery page
                if (response.status === 'success') {
                    window.location.href = 'delivery.php';  // Redirect to the delivery page
                }
            }
        };

        // Sending the request to the server to simulate the 'Buy Now' functionality
        xhr.send('buyNow=true');
    });

    // Handle the removal of the product from the cart using AJAX
    document.querySelectorAll('.remove-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var productName = this.getAttribute('data-product');

            // Send AJAX request to remove the product
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'cart.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    
                    // Show the message
                    var messageDiv = document.getElementById('message');
                    messageDiv.innerHTML = `<div class="alert ${response.status === 'success' ? 'success' : 'error'}">${response.message}</div>`;

                    // If successful, remove the row from the table
                    if (response.status === 'success') {
                        var row = document.getElementById('row-' + productName);
                        row.remove();
                    }
                }
            };
            xhr.send('deleteProduct=' + encodeURIComponent(productName));
        });
    });

    // Handle the quantity increase/decrease buttons using AJAX
    document.querySelectorAll('.quantity-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var productName = this.getAttribute('data-product');
            var action = this.getAttribute('data-action');
            var quantitySpan = document.getElementById('quantity-' + productName);
            var currentQuantity = parseInt(quantitySpan.textContent);

            // Adjust quantity based on the action (increase/decrease)
            if (action === 'increase') {
                currentQuantity++;
            } else if (action === 'decrease' && currentQuantity > 1) {
                currentQuantity--;
            }

            // Send AJAX request to update the quantity in the database
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'cart.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    
                    // Show the message
                    var messageDiv = document.getElementById('message');
                    messageDiv.innerHTML = `<div class="alert ${response.status === 'success' ? 'success' : 'error'}">${response.message}</div>`;

                    // If successful, update the quantity on the page
                    if (response.status === 'success') {
                        quantitySpan.textContent = currentQuantity;
                    }
                }
            };
            xhr.send('updateQuantity=' + encodeURIComponent(productName) + '&newQuantity=' + encodeURIComponent(currentQuantity));
        });
    });
</script>

<!-- Include external JS files -->


<!-- CSS for the cart and alert styles -->

