<?php
session_start();
include '../connect.php'; // Ensure this path is correct

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['product_name'])) {
        $productName = $data['product_name'];

        // Remove the item from the session
        if (isset($_SESSION['panier'][$productName])) {
            unset($_SESSION['panier'][$productName]);

            // Optionally, remove from the database as well
            $stmt = $conn->prepare("DELETE FROM panier WHERE product_name = :product_name");
            $stmt->bindParam(':product_name', $productName, PDO::PARAM_STR);
            $stmt->execute();

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Product not found in cart.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid product data.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>