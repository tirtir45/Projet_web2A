<?php
header('Content-Type: application/json');

// Start the session only if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include the CartController
require_once '../../controllers/CartController.php';

$response = ["success" => false, "message" => ""];

// Ensure the user is logged in and has a valid session
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Retrieve the user_id from the session

    if (isset($_GET['add']) && $_GET['add'] === 'true') {
        // Get the product data from the URL parameters
        $productName = isset($_GET['name']) ? trim($_GET['name']) : null;
        $productPrice = isset($_GET['price']) ? floatval($_GET['price']) : null;
        $productImage = isset($_GET['image']) ? trim($_GET['image']) : null;
        $quantity = isset($_GET['quantity']) ? intval($_GET['quantity']) : 1; // Default to 1 if no quantity is specified

        // Validate the parameters
        if (empty($productName) || empty($productImage) || !is_numeric($productPrice) || $productPrice <= 0 || !is_numeric($quantity) || $quantity <= 0) {
            $response['message'] = "Invalid or missing product data.";
        } else {
            // Instantiate the CartController to handle the cart logic
            $cartController = new CartController();
            $addResult = $cartController->addToCart($productName, $productPrice, $productImage, $quantity, $userId);

            // If the product was successfully added to the cart
            if ($addResult['success']) {
                $response['success'] = true;
                $response['message'] = "$productName has been added to the cart.";
            } else {
                $response['message'] = "Failed to add the item to the cart.";
            }
        }
    } else {
        $response['message'] = "No valid 'add' parameter found.";
    }
} else {
    $response['message'] = "User not logged in.";
}

echo json_encode($response); // Send back the response as JSON
?>
