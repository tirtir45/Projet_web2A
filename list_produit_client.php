<?php

require_once('C:/xampp/htdocs/foued_benyou/controller/produitc.php');

$produitC = new produitC();

if (isset($_GET['search']) && !empty($_GET['search'])) {
   $search = htmlspecialchars($_GET['search']);
   $tab = $produitC->searchProduitByType($search);
} else {
   $tab = $produitC->listeProduits();
}
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>Addina - Multipurpose eCommerce HTML Template

   </title>
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
                     <a href="index.html">
                        <img src="assets/imgs/furniture/logo/logo-light.svg" alt="logo not found">
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

   <!-- Add cart modal area start -->
   <div class="product-modal-sm modal fade" id="producQuickViewModal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="product-modal">
               <div class="product-modal-wrapper p-relative">
                  <button type="button" class="close product-modal-close" data-bs-dismiss="modal" aria-label="Close">
                     <i class="fal fa-times"></i>
                  </button>
                  <div class="modal__inner">
                     <div class="bd__shop-details-inner">
                        <div class="row">
                           <div class="col-xxl-6 col-lg-6">
                              <div class="product__details-thumb-wrapper d-sm-flex align-items-start">
                                 <div class="product__details-thumb-tab mr-20">
                                    <nav>
                                       <div class="nav nav-tabs flex-nowrap flex-sm-column" id="nav-tab" role="tablist">
                                          <button class="nav-link active" id="img-1-tab" data-bs-toggle="tab"
                                             data-bs-target="#img-1" type="button" role="tab" aria-controls="img-1"
                                             aria-selected="true">
                                             <img src="assets/imgs/product/details/details-04.png"
                                                alt="product-sm-thumb">
                                          </button>
                                          <button class="nav-link" id="img-2-tab" data-bs-toggle="tab"
                                             data-bs-target="#img-2" type="button" role="tab" aria-controls="img-3"
                                             aria-selected="false">
                                             <img src="assets/imgs/product/details/details-05.png"
                                                alt="product-sm-thumb">
                                          </button>
                                          <button class="nav-link" id="img-3-tab" data-bs-toggle="tab"
                                             data-bs-target="#img-3" type="button" role="tab" aria-controls="img-3"
                                             aria-selected="false">
                                             <img src="assets/imgs/product/details/details-06.png"
                                                alt="product-sm-thumb">
                                          </button>
                                       </div>
                                    </nav>
                                 </div>
                                 <div class="product__details-thumb-tab-content">
                                    <div class="tab-content" id="productthumbcontent">
                                       <div class="tab-pane fade show active" id="img-1" role="tabpanel"
                                          aria-labelledby="img-1-tab">
                                          <div class="product__details-thumb-big w-img">
                                             <img src="assets/imgs/product/details/details-04.png" alt="">
                                          </div>
                                       </div>
                                       <div class="tab-pane fade" id="img-2" role="tabpanel"
                                          aria-labelledby="img-2-tab">
                                          <div class="product__details-thumb-big w-img">
                                             <img src="assets/imgs/product/details/details-05.png" alt="">
                                          </div>
                                       </div>
                                       <div class="tab-pane fade" id="img-3" role="tabpanel"
                                          aria-labelledby="img-3-tab">
                                          <div class="product__details-thumb-big w-img">
                                             <img src="assets/imgs/product/details/2.webp" alt="">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-xxl-6 col-lg-6">
                              <div class="product__details-content">
                                 <div class="product__details-top d-flex flex-wrap gap-3 align-items-center mb-15">
                                    <div class="product__details-tag">
                                       <a href="#">Construction</a>
                                    </div>
                                    <div class="product__details-rating">
                                       <a href="#"><i class="fa-solid fa-star"></i></a>
                                       <a href="#"><i class="fa-solid fa-star"></i></a>
                                       <a href="#"><i class="fa-regular fa-star"></i></a>
                                    </div>
                                    <div class="product__details-review-count">
                                       <a href="#">10 Reviews</a>
                                    </div>
                                 </div>
                                 <h3 class="product__details-title">Disposable Surgical Face Mask</h3>
                                 <div class="product__details-price">
                                    <span class="old-price">$30.35</span>
                                    <span class="new-price">$19.25</span>
                                 </div>
                                 <p>Priyoshop has brought to you the Hijab 3 Pieces Combo Pack PS23. It is a completely
                                    modern design and you feel comfortable to put on this hijab. Buy it at the best
                                    price.</p>

                                 <div class="product__details-action mb-35">
                                    <div class="product__quantity">
                                       <div class="product-quantity-wrapper">
                                          <form action="#">
                                             <button class="cart-minus"><i class="fa-light fa-minus"></i></button>
                                             <input class="cart-input" type="text" value="1">
                                             <button class="cart-plus"><i class="fa-light fa-plus"></i></button>
                                          </form>
                                       </div>
                                    </div>
                                    <div class="product__add-cart">
                                       <a href="javascript:void(0)" class="fill-btn cart-btn">
                                          <span class="fill-btn-inner">
                                             <span class="fill-btn-normal">Add To Cart<i
                                                   class="fa-solid fa-basket-shopping"></i></span>
                                             <span class="fill-btn-hover">Add To Cart<i
                                                   class="fa-solid fa-basket-shopping"></i></span>
                                          </span>
                                       </a>
                                    </div>
                                    <div class="product__add-wish">
                                       <a href="#" class="product__add-wish-btn"><i class="fa-solid fa-heart"></i></a>
                                    </div>
                                 </div>
                                 <div class="product__details-meta">
                                    <div class="sku">
                                       <span>SKU:</span>
                                       <a href="#">BO1D0MX8SJ</a>
                                    </div>
                                    <div class="categories">
                                       <span>Categories:</span> <a href="#">Milk,</a> <a href="#">Cream,</a> <a
                                          href="#">Fermented.</a>
                                    </div>
                                    <div class="tag">
                                       <span>Tags:</span> <a href="#"> Cheese,</a> <a href="#">Custard,</a> <a
                                          href="#">Frozen</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Add cart modal area end -->

   <!-- Header area start -->
   <header>
      <div class="header">
         <div class="header-top-area grocery__top-header">
            <div class="header-layout-4">
               <div class="header-to-main d-none d-sm-flex">
                  <div class="link-text">
                     <span><img src="assets/imgs/icons/call.png" alt=""></span>
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
                           <a href="index.html">
                              <!-- <img src="assets/imgs/furniture/logo/logo.svg" alt="logo not found"> -->
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
                     <!-- mofication  -->
                     <div class="header-right d-inline-flex align-items-center justify-content-end">
                        <div class="header-search d-none d-xxl-block">
                           <form action="#">
                              <input type="text" name="search" class="form-control me-2" placeholder="Rechercher un produit..." id="searchInput"
                                 value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                              <button type="submit" class="btn btn-primary">
                                 <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.4443 13.4445L16.9999 17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M15.2222 8.11111C15.2222 12.0385 12.0385 15.2222 8.11111 15.2222C4.18375 15.2222 1 12.0385 1 8.11111C1 4.18375 4.18375 1 8.11111 1C12.0385 1 15.2222 4.18375 15.2222 8.11111Z" stroke="white" stroke-width="2" />
                                 </svg>
                              </button>
                           </form>
                        </div>
                     </div>

                     <!-- ggfjgjfg -->
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

   <!-- Body main wrapper start -->
   <main>

      <!-- Breadcrumb area start  -->
      <div class="breadcrumb__area theme-bg-1 p-relative z-index-11 pt-95 pb-95">
         <div class="breadcrumb__thumb" data-background="assets/imgs/bg/breadcrumb-bg-furniture.png"></div>
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-xxl-12">
                  <div class="breadcrumb__wrapper text-center">
                     <h2 class="breadcrumb__title">Product</h2>
                     <div class="breadcrumb__menu">
                        <nav>
                           <ul>
                              <li><span><a href="index.html">Home</a></span></li>
                              <li><span>Product</span></li>
                           </ul>
                        </nav>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Breadcrumb area start  -->

      <!-- Product area start -->
      <section class="bd-product__area section-space">
         <div class="container">
            <div class="row">
               <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                  <div class="bd-product__result mb-30">
                     <h4>20 Item On List</h4>
                  </div>
               </div>
               <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-6">
                  <div
                     class="product__filter-wrapper d-flex flex-wrap gap-3 align-items-center justify-content-md-end mb-30">
                     <div class="bd-product__filter-btn">
                        <button type="button"><i class="fa-solid fa-list">
                           </i> Filter</button>

                     </div>
                     <div class="product__filter-count d-flex align-items-center">
                        <div class="btn-dropdown__options">
                           <select>
                              <option>Show 20</option>
                              <option>This Past Week</option>
                              <option>This Past Month</option>
                              <option>This Past Year</option>
                              <option>All Time</option>
                           </select>
                        </div>
                        <div class="bd-product__filter-style nav nav-tabs" role="tablist">
                           <button class="nav-link active" id="nav-grid-tab" data-bs-toggle="tab"
                              data-bs-target="#nav-grid" type="button" role="tab" aria-selected="false"><i
                                 class="fa-solid fa-grid"></i></button>

                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-xxl-12">
                  <div class="product__filter-tab">
                     <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="nav-grid" role="tabpanel"
                           aria-labelledby="nav-grid-tab">
                           <div class="row g-5">
                              <?php foreach ($tab as $produit) { ?>


                                 <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                    <div class="product-item">
                                       <div class="product-badge">
                                          <span class="product-trending"><?= htmlspecialchars($produit["color"]); ?></span>
                                       </div>
                                       <div class="product-thumb">
                                          <a href="product-details.html"><img src="assets/imgs/furniture/product/1.webp"
                                                alt=""></a>
                                       </div>
                                       <div class="product-action-item">
                                          <button type="button" class="product-action-btn">
                                             <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                   d="M13.0768 10.1416C13.0768 11.9228 11.648 13.3666 9.88542 13.3666C8.1228 13.3666 6.69401 11.9228 6.69401 10.1416M1.375 5.84163H18.3958M1.375 5.84163V12.2916C1.375 19.1359 2.57494 20.3541 9.88542 20.3541C17.1959 20.3541 18.3958 19.1359 18.3958 12.2916V5.84163M1.375 5.84163L2.91454 2.73011C3.27495 2.00173 4.01165 1.54163 4.81754 1.54163H14.9533C15.7592 1.54163 16.4959 2.00173 16.8563 2.73011L18.3958 5.84163"
                                                   stroke="white" stroke-width="2" stroke-linecap="round"
                                                   stroke-linejoin="round" />
                                             </svg>
                                             <span class="product-tooltip">Add to Cart</span>
                                          </button>
                                          <button type="button" class="product-action-btn" data-bs-toggle="modal"
                                             data-bs-target="#producQuickViewModal">

                                             <svg width="26" height="18" viewBox="0 0 26 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                   d="M13.092 4.55026C10.5878 4.55026 8.55683 6.58125 8.55683 9.08541C8.55683 11.5896 10.5878 13.6206 13.092 13.6206C15.5961 13.6206 17.6271 11.5903 17.6271 9.08541C17.6271 6.5805 15.5969 4.55026 13.092 4.55026ZM13.092 12.1089C11.4246 12.1089 10.0338 10.7196 10.0338 9.05216C10.0338 7.38473 11.3898 6.02872 13.0572 6.02872C14.7246 6.02872 16.0807 7.38473 16.0807 9.05216C16.0807 10.7196 14.7594 12.1089 13.092 12.1089ZM25.0965 8.8768C25.0875 8.839 25.092 8.79819 25.0807 8.76115C25.0761 8.74528 25.0655 8.73621 25.0603 8.7226C25.0519 8.70144 25.0542 8.67574 25.0429 8.65533C22.8441 3.62131 18.1064 0.724854 13.0572 0.724854C8.00807 0.724854 3.17511 3.61677 0.975559 8.65079C0.966488 8.67196 0.968 8.69388 0.959686 8.71806C0.954395 8.73318 0.943812 8.74074 0.938521 8.7551C0.927184 8.7929 0.931719 8.83296 0.92416 8.8715C0.910555 8.93953 0.897705 9.00605 0.897705 9.07483C0.897705 9.14361 0.910555 9.20862 0.92416 9.2774C0.931719 9.31519 0.926428 9.35677 0.938521 9.39229C0.943057 9.40968 0.954395 9.41648 0.959686 9.4316C0.967244 9.45201 0.965732 9.4777 0.975559 9.49887C3.17511 14.5314 7.96121 17.381 13.0104 17.381C18.0595 17.381 22.8448 14.5374 25.0436 9.5034C25.055 9.48148 25.0527 9.45956 25.061 9.43538C25.0663 9.42253 25.0761 9.4127 25.0807 9.39758C25.092 9.36055 25.089 9.32049 25.0965 9.28118C25.1101 9.21315 25.1222 9.14739 25.1222 9.0771C25.1222 9.01058 25.1094 8.94482 25.0958 8.87604L25.0965 8.8768ZM13.0104 15.8692C8.72841 15.8692 4.51298 13.6123 2.44193 9.07407C4.49333 4.55177 8.76469 2.23582 13.0572 2.23582C17.349 2.23582 21.5251 4.55404 23.5773 9.07861C21.5266 13.6002 17.3036 15.8692 13.0104 15.8692Z"
                                                   fill="white" />
                                             </svg>
                                             <span class="product-tooltip">Quick View</span>
                                          </button>
                                          <button type="button" class="product-action-btn">

                                             <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                   d="M19.2041 2.63262C18.6402 1.97669 17.932 1.44916 17.1305 1.08804C16.329 0.726918 15.4541 0.54119 14.569 0.544237C13.0545 0.500151 11.58 1.01577 10.4489 1.98501C9.31782 1.01577 7.84334 0.500151 6.32883 0.544237C5.44368 0.54119 4.56885 0.726918 3.76735 1.08804C2.96585 1.44916 2.25764 1.97669 1.69374 2.63262C0.712132 3.77732 -0.314799 5.84986 0.366045 9.22751C1.45272 14.6213 9.60121 19.0476 9.94523 19.2288C10.0986 19.311 10.2713 19.3541 10.4469 19.3541C10.6224 19.3541 10.7951 19.311 10.9485 19.2288C11.2946 19.0436 19.4431 14.6173 20.5277 9.22751C21.2126 5.84986 20.1857 3.77732 19.2041 2.63262ZM18.5099 8.85122C17.7415 12.6646 12.1567 16.2116 10.4489 17.2196C8.04279 15.8234 3.09251 12.318 2.39312 8.85122C1.86472 6.23109 2.5878 4.70912 3.28821 3.89317C3.65861 3.46353 4.12333 3.11801 4.64903 2.88141C5.17473 2.64481 5.74838 2.52299 6.32883 2.52468C6.94879 2.47998 7.57022 2.59049 8.13253 2.84542C8.69484 3.10036 9.17884 3.49102 9.53734 3.97932C9.62575 4.13571 9.75616 4.26645 9.915 4.3579C10.0738 4.44936 10.2553 4.49819 10.4404 4.4993C10.6256 4.50041 10.8076 4.45377 10.9676 4.36423C11.1276 4.27469 11.2598 4.14553 11.3502 3.99022C11.708 3.49811 12.193 3.10414 12.7575 2.84715C13.3219 2.59016 13.9463 2.47902 14.569 2.52468C15.1507 2.52196 15.7257 2.64329 16.2527 2.87993C16.7798 3.11656 17.2456 3.46262 17.6168 3.89317C18.3152 4.70912 19.0383 6.23109 18.5099 8.85122Z"
                                                   fill="white" />
                                             </svg>
                                             <span class="product-tooltip">Add To Wishlist</span>
                                          </button>
                                       </div>
                                       <div class="product-content">
                                          <div class="product-tag">
                                             <span><?= htmlspecialchars($produit["category"]); ?></span>
                                          </div>
                                          <h4 class="product-title"><a href="product-details.html"><?= htmlspecialchars($produit["name"]); ?></a>
                                          </h4>
                                          <div class="product-price">
                                             <span class="product-old-price"><del>$15.00</del></span>
                                             <span class="product-new-price"><?= htmlspecialchars($produit["quantity"]); ?></span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>



                              <?php } ?>

                           </div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>
            <div class="row">
               <div class="bd-basic__pagination mt-50 d-flex align-items-center justify-content-center">
                  <nav>
                     <ul>
                        <li>
                           <span class="current">1</span>
                        </li>
                        <li>
                           <a href="#">2</a>
                        </li>
                        <li>
                           <a href="#">3</a>
                        </li>
                        <li>
                           <a href="#"><i class="fa-regular fa-angle-right"></i></a>
                        </li>
                     </ul>
                  </nav>
               </div>
            </div>
         </div>
      </section>
      <!-- Product area end -->

   </main>
   <!-- Body main wrapper end -->

   <!-- Footer area start -->
   <footer class="footer-bg">
      <div class="footer-area pt-100 pb-20">
         <div class="footer-style-4">
            <div class="container">
               <div class="footer-grid-3">
                  <div class="footer-widget-4">
                     <div class="footer-logo mb-35">
                        <a href="index.html"><img src="assets/imgs/furniture/logo/logo-light.svg"
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
                        href="#">Addina</a></p>
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