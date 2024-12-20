<?php
session_start(); // Start the session
require_once(__DIR__ . '/../../connect.php');

// Create an instance of the Database class
$database = new config();

// Get the PDO connection
$pdo = $database::getConnexion();

// Now you can use the $pdo variable for database operations

require_once '../../controller/ProductController.php'; // Include the product controller
$productController = new ProductController($pdo); // Pass $pdo to the controller

// Fetch products (you can add other logic here for adding/deleting products)
$products = $productController->getProducts(); // Get the products from the model
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Manage Products</title>
    <link rel="stylesheet" href="../../assets/css/styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <!-- Header Section -->
    <div class="header-layout-4 header-bottom">
        <div id="header-sticky" class="header-4">
            <div class="mega-menu-wrapper">
                <div class="header-main-4">
                    <div class="header-left">
                        <div class="header-logo">
                            <a href="index.php">
                                <img src="assets/imgs/furniture/logo/black-logo.png" alt="logo not found" />
                                <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
                                <link rel="stylesheet" href="../../assets/css/meanmenu.min.css" />
                                <link rel="stylesheet" href="../../assets/css/animate.css" />
                                <link rel="stylesheet" href="../../assets/css/swiper.min.css" />
                                <link rel="stylesheet" href="../../assets/css/slick.css" />
                                <link rel="stylesheet" href="../../assets/css/magnific-popup.css" />
                                <link rel="stylesheet" href="../../assets/css/fontawesome-pro.css" />
                                <link rel="stylesheet" href="../../assets/css/spacing.css" />
                                <link rel="stylesheet" href="../../assets/css/main.css" />
                                <link rel="stylesheet" href="../../assets/css/shopping.css" />
                            </a>
                        </div>
                        <div class="mean__menu-wrapper furniture__menu d-none d-lg-block">
                            <div class="main-menu">
                                <nav id="mobile-menu">
                                    <ul>
                                        <li><a href="../Frontoff/index.php">Home</a></li>
                                        <li><a href="../Frontoff/about.html">About</a></li>
                                        <li><a href="../Frontoff/index.php">Shop</a></li>
                                        <li><a href="../Frontoff/view.php">Blog</a></li>
                                        <li><a href="../Frontoff/rymcontact.html">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="header-right d-inline-flex align-items-center justify-content-end">
                        <div class="header-action d-flex align-items-center ml-30">
                            <div class="header-action-item">
                                <a href="" class="header-action-btn">
                                    <svg width="23" height="21" viewBox="0 0 23 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M21.2743 2.33413C20.6448 1.60193 19.8543 1.01306 18.9596 0.609951C18.0649 0.206838 17.0883 -0.0004864 16.1002 0.00291444C14.4096 -0.0462975 12.7637 0.529279 11.5011 1.61122C10.2385 0.529279 8.59252 -0.0462975 6.90191 0.00291444C5.91383 -0.0004864 4.93727 0.206838 4.04257 0.609951C3.14788 1.01306 2.35732 1.60193 1.72785 2.33413C0.632101 3.61193 -0.514239 5.92547 0.245772 9.69587C1.4588 15.7168 10.5548 20.6578 10.9388 20.8601C11.11 20.9518 11.3028 21 11.4988 21C11.6948 21 11.8875 20.9518 12.0587 20.8601C12.445 20.6534 21.541 15.7124 22.7518 9.69587C23.5164 5.92547 22.37 3.61193 21.2743 2.33413ZM20.4993 9.27583C19.6416 13.5326 13.4074 17.492 11.5011 18.6173C8.81516 17.0587 3.28927 13.1457 2.50856 9.27583C1.91872 6.35103 2.72587 4.65208 3.50773 3.74126C3.9212 3.26166 4.43995 2.87596 5.02678 2.61185C5.6136 2.34774 6.25396 2.21175 6.90191 2.21365C7.59396 2.16375 8.28765 2.2871 8.91534 2.57168C9.54304 2.85626 10.0833 3.29235 10.4835 3.83743C10.5822 4.012 10.7278 4.15794 10.9051 4.26003C11.0824 4.36212 11.2849 4.41662 11.4916 4.41787C11.6983 4.41911 11.9015 4.36704 12.0801 4.26709C12.2587 4.16714 12.4062 4.02296 12.5071 3.84959C12.9065 3.30026 13.448 2.86048 14.0781 2.57361C14.7081 2.28674 15.4051 2.16267 16.1002 2.21365C16.7495 2.21061 17.3915 2.34604 17.9798 2.6102C18.5681 2.87435 19.0881 3.26065 19.5025 3.74126C20.282 4.65208 21.0892 6.35103 20.4993 9.27583Z" fill="black"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Section -->
    <div class="dashboard-container">
        <h1 class="dashboard-title">Manage Products</h1>
        
        <h2 class="section-title">Products List</h2>
        <div class="product-list">
            <?php foreach ($products as $product): ?>
                <div class="product-item">
                    <img class="product-image" src="../../assets/images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" />
                    <div class="product-info">
                        <h3 class="product-name"><?php echo htmlspecialchars($product['product_name']); ?></h3>
                        <p class="product-price">Price: $<?php echo htmlspecialchars($product['price']); ?></p>
                        <!-- Delete button -->
                        <a href="delete_product.php?id=<?php echo $product['id']; ?>" class="delete-button">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <h2 class="section-title">Add New Product</h2>
        <form action="add_product.php" method="POST" enctype="multipart/form-data" class="add-product-form">
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" name="product_name" id="product_name" required class="form-input">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" name="price" id="price" required class="form-input">
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" required class="form-input">
            </div>
            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" name="image" id="image" required class="form-input">
            </div>
            <button type="submit" name="submit" class="submit-btn">Add Product</button>
        </form>
    </div>

</body>
</html>
