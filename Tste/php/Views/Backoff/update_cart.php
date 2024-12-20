<?php
session_start();
include '../../connect.php'; // Ensure this path is correct

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['quantity'])) {
        try {
            foreach ($data['quantity'] as $productName => $newQuantity) {
                // Ensure quantity is at least 1
                if (isset($_SESSION['panier'][$productName])) {
                    // Update the session quantity
                    $_SESSION['panier'][$productName]['quantity'] = max(1, (int)$newQuantity);
                    
                    // Update the database quantity
                    $stmt = $conn->prepare("UPDATE cart SET quantity = :quantity WHERE product_name = :product_name");
                    $stmt->bindParam(':quantity', $_SESSION['panier'][$productName]['quantity'], PDO::PARAM_INT);
                    $stmt->bindParam(':product_name', $productName, PDO::PARAM_STR);
                    $stmt->execute();
                }
            }
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid quantity data.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>