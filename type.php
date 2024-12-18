<?php
require_once('C:/xampp/htdocs/foued_benyou/controller/typec.php');
require_once('C:/xampp/htdocs/foued_benyou/model/type.php');

$typeC = new TypeC();
$types = $typeC->listTypes();
?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Ajouter un Produit</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/imgs/furniture/favicon.png" />

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/meanmenu.min.css" />
    <link rel="stylesheet" href="assets/css/animate.css" />
    <link rel="stylesheet" href="assets/css/swiper.min.css" />
    <link rel="stylesheet" href="assets/css/slick.css" />
    <link rel="stylesheet" href="assets/css/magnific-popup.css" />
    <link rel="stylesheet" href="assets/css/fontawesome-pro.css" />
    <link rel="stylesheet" href="assets/css/spacing.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <style>
        /* Général */
        .product-form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Espacement des champs du formulaire */
        .form-group {
            margin-bottom: 15px;
        }

        /* Style des labels */
        .form-group label {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
            display: inline-block;
        }

        /* Style des champs de texte, select et input */
        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        /* Champs de texte ou nombre spécifiques */
        input[type="text"],
        input[type="number"],
        select {
            background-color: #fff;
        }

        /* Champs en focus */
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        /* Style pour le bouton */
        .btn {
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Bouton Soumettre */
        .btn-primary {
            background-color: #007bff;
            border: none;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Bouton Réinitialiser */
        .btn-secondary {
            background-color: #6c757d;
            border: none;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        /* Centrer les boutons */
        .text-center {
            text-align: center;
        }

        /* Espacement entre les boutons */
        .btn+.btn {
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="header">
            <div class="header-top-area grocery__top-header">
                <div class="header-layout-4">
                    <div class="header-to-main d-none d-sm-flex">
                        <div class="link-text">
                            <span><img src="assets/imgs/icons/call.png" alt="" /></span>
                            <a href="tel:+380961381876">+21627000435</a>
                        </div>
                        <div class="header-top-notice d-none d-lg-block">

                        </div>
                        <div class="tp-header-top-menu d-flex align-items-center justify-content-end">


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
                                        <img src="assets/imgs/furniture/logo/black-logo.png" alt="logo not found" />
                                    </a>
                                </div>
                                <div class="mean__menu-wrapper furniture__menu d-none d-lg-block">
                                    <div class="main-menu">
                                        <nav id="mobile-menu">
                                            <ul>
                                                <li class=" ">
                                                    <a href="index.html">Home</a>
                                                </li>
                                                <li>
                                                    <a href="#"> produit </a>
                                                </li>


                                                <li><a href="#">Panier</a></li>
                                                <li><a href="#">Evenement </a></li>
                                                <li><a href="#">Reclamation </a></li>

                                                </li>

                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="header-right d-inline-flex align-items-center justify-content-end">
                                <div class="header-search d-none d-xxl-block">
                                    <form action="#">
                                        <input type="text" placeholder="Search..." />
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

                                <div class="header-humbager ml-30">
                                    <a class="sidebar__toggle" href="javascript:void(0)">
                                        <div class="bar-icon-2">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </a>
                                    <!-- for wp -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

        <div class="body-overlay"></div>
        <!-- search area end -->

        <!-- Offcanvas area start -->

        <div class="offcanvas__overlay"></div>
        <div class="offcanvas__overlay-white"></div>
        <!-- Offcanvas area start -->

        <!-- Add cart modal area start -->
        <div class="product-modal-sm modal fade" id="producQuickViewModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="product-modal">
                        <div class="product-modal-wrapper p-relative">
                            <button type="button" class="close product-modal-close" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i class="fal fa-times"></i>
                            </button>
                            <div class="modal__inner">
                                <div class="bd__shop-details-inner">
                                    <div class="row">
                                        <div class="col-xxl-6 col-lg-6">
                                            <div class="product__details-thumb-wrapper d-sm-flex align-items-start">
                                                <div class="product__details-thumb-tab mr-20">
                                                    <nav>
                                                        <div class="nav nav-tabs flex-nowrap flex-sm-column"
                                                            id="nav-tab" role="tablist">
                                                            <button class="nav-link active" id="img-1-tab"
                                                                data-bs-toggle="tab" data-bs-target="#img-1"
                                                                type="button" role="tab" aria-controls="img-1"
                                                                aria-selected="true">
                                                                <img src="assets/imgs/product/details/details-04.png"
                                                                    alt="product-sm-thumb" />
                                                            </button>
                                                            <button class="nav-link" id="img-2-tab" data-bs-toggle="tab"
                                                                data-bs-target="#img-2" type="button" role="tab"
                                                                aria-controls="img-3" aria-selected="false">
                                                                <img src="assets/imgs/product/details/details-05.png"
                                                                    alt="product-sm-thumb" />
                                                            </button>
                                                            <button class="nav-link" id="img-3-tab" data-bs-toggle="tab"
                                                                data-bs-target="#img-3" type="button" role="tab"
                                                                aria-controls="img-3" aria-selected="false">
                                                                <img src="assets/imgs/product/details/details-06.png"
                                                                    alt="product-sm-thumb" />
                                                            </button>
                                                        </div>
                                                    </nav>
                                                </div>
                                                <div class="product__details-thumb-tab-content">
                                                    <div class="tab-content" id="productthumbcontent">
                                                        <div class="tab-pane fade show active" id="img-1"
                                                            role="tabpanel" aria-labelledby="img-1-tab">
                                                            <div class="product__details-thumb-big w-img">
                                                                <img src="assets/imgs/product/details/details-04.png"
                                                                    alt="" />
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="img-2" role="tabpanel"
                                                            aria-labelledby="img-2-tab">
                                                            <div class="product__details-thumb-big w-img">
                                                                <img src="assets/imgs/product/details/details-05.png"
                                                                    alt="" />
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="img-3" role="tabpanel"
                                                            aria-labelledby="img-3-tab">
                                                            <div class="product__details-thumb-big w-img">
                                                                <img src="assets/imgs/product/details/details-06.png"
                                                                    alt="" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6">
                                            <div class="product__details-content">
                                                <div
                                                    class="product__details-top d-flex flex-wrap gap-3 align-items-center mb-15">
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
                                                <h3 class="product__details-title">
                                                    Disposable Surgical Face Mask
                                                </h3>
                                                <div class="product__details-price">
                                                    <span class="old-price">$30.35</span>
                                                    <span class="new-price">$19.25</span>
                                                </div>


                                                <div class="product__details-action mb-35">
                                                    <div class="product__quantity">
                                                        <div class="product-quantity-wrapper">
                                                            <form action="#">
                                                                <button class="cart-minus">
                                                                    <i class="fa-light fa-minus"></i>
                                                                </button>
                                                                <input class="cart-input" type="text" value="1" />
                                                                <button class="cart-plus">
                                                                    <i class="fa-light fa-plus"></i>
                                                                </button>
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
                                                        <a href="#" class="product__add-wish-btn"><i
                                                                class="fa-solid fa-heart"></i></a>
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


    </header>

    <!-- Main Content -->
    <main>
        <section class="product-form-area py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-10">
                        <h2 class="text-center mb-4">Formulaire</h2>
                        <form action="../ajout_type.php" method="POST">


                            <!-- Type de produit -->
                            <label for="type_produit">Type de Produit :</label>
                            <input type="text" class="form-control" id="type_produit" name="type_produit"
                                placeholder="Entrez le type de produit" required>
                            <input type="hidden" id="id" name="id" value="<?php echo uniqid(); ?>">

                            <!-- Boutons -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary me-2">Soumettre</button>
                                <button type="reset" class="btn btn-secondary">Réinitialiser</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer-bg">
        <div class="footer-area pt-100 pb-20">
            <div class="footer-style-4">
                <div class="container">
                    <div class="footer-grid-3">
                        <div class="footer-widget-4">
                            <div class="footer-logo mb-35">
                                <a href="index.html"><img src="assets/imgs/furniture/logo/logo-light.svg"
                                        alt="image bnot found" /></a>
                            </div>

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

                            </div>
                        </div>
                        <div class="footer-widget-4">

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

                        <div class="footer-info mb-35">
                            <p class="w-75">
                                Cité El Ghazzela ,Ariana ,Tunis
                            </p>
                            <div class="footer-info-item d-flex align-items-start pb-15 pt-15">
                                <div class="footer-info-icon mr-20">
                                    <span>
                                        <i class="fa-solid fa-location-dot furniture-icon"></i></span>
                                </div>
                                <div class="footer-info-text">
                                    <a class="furniture-clr-hover" target="_blank"
                                        href="https://www.google.com/maps/place/Orville+St,+La+Presa,+CA+91977,+USA/@32.7092048,-117.0082772,17z/data=!3m1!4b1!4m5!3m4!1s0x80d9508a9aec8cd1:0x72d1ac1c9527b705!8m2!3d32.7092003!4d-117.0060885">
                                    </a>
                                </div>
                            </div>
                            <div class="footer-info-item d-flex align-items-start">
                                <div class="footer-info-icon mr-20">
                                    <span><i class="fa-solid fa-phone furniture-icon"></i></span>
                                </div>
                                <div class="footer-info-text">
                                    <a class="furniture-clr-hover" href="tel:012-345-6789"> </a>
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
                            <a target="_blank" class="furniture-clr-hover" href="#"> </a>
                        </p>
                    </div>
                    <div class="footer-payment d-flex align-items-center gap-2">
                        <div class="footer-payment-item mb-0">
                            <div class="footer-payment-thumb">
                                <img src="assets/imgs/icons/payoneer.png" alt="" />
                            </div>
                        </div>
                        <div class="footer-payment-item mb-0">
                            <div class="footer-payment-thumb">
                                <img src="assets/imgs/icons/maser.png" alt="" />
                            </div>
                        </div>
                        <div class="footer-payment-item">
                            <div class="footer-payment-thumb">
                                <img src="assets/imgs/icons/paypal.png" alt="" />
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

    <!-- JS here -->

    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- <script src="controle_saisie.js"></script>     -->



</body>

</html>