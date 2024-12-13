<?php
session_start();
require_once '../connect.php'; // Ensure the correct path to your connection file
require_once '../controller/CartController.php'; // Include the controller


// Establish database connection
// If you're using the Database class for connection, you would use the following:
$db = (new Database())->connect();  // Use the correct class for DB connection

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $data = json_decode(file_get_contents("php://input"), true);

    // Ensure the product name is provided
    if (isset($data['product_name'])) {
        $productName = $data['product_name'];

        // Check if the product exists in the session cart
        if (isset($_SESSION['panier'][$productName])) {
            // Remove the item from the session
            unset($_SESSION['panier'][$productName]);

            // Optionally, remove the item from the database as well
            $stmt = $db->prepare("DELETE FROM panier WHERE product_name = :product_name");
            $stmt->bindParam(':product_name', $productName, PDO::PARAM_STR);

            // Execute the query and check if the deletion was successful
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Product removed from the cart.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to remove item from the database.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Product not found in the cart.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid product data.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
