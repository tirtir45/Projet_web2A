<?php
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the product name from the request
    $productName = $_POST['productName'] ?? '';

    // Check if the product exists in the session cart
    if (!empty($productName) && isset($_SESSION['panier'][$productName])) {
        // Remove the product from the cart
        unset($_SESSION['panier'][$productName]);

        // Respond with success
        echo json_encode([
            'success' => true,
            'message' => 'Product removed successfully from the cart.'
        ]);
    } else {
        // Respond with an error if the product is not found
        echo json_encode([
            'success' => false,
            'message' => 'Product not found in the cart.'
        ]);
    }
} else {
    // Respond with an error for invalid request methods
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method. Please use POST.'
    ]);
}
