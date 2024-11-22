<?php
session_start();
header('Content-Type: application/json');

// Include your database connection file
include('connect.php'); // Adjust the path if necessary

class CartController {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function updateCart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            if (isset($data['quantity'])) {
                foreach ($data['quantity'] as $productName => $newQuantity) {
                    // Ensure the quantity is at least 1
                    if (isset($_SESSION['panier'][$productName])) {
                        $_SESSION['panier'][$productName]['quantity'] = max(1, (int)$newQuantity);

                        // Update the database
                        try {
                            $stmt = $this->conn->prepare("UPDATE panier SET quantity = :quantity WHERE product_name = :product_name");
                            $stmt->bindParam(':quantity', $_SESSION['panier'][$productName]['quantity'], PDO::PARAM_INT);
                            $stmt->bindParam(':product_name', $productName, PDO::PARAM_STR);
                            $stmt->execute();
                        } catch (PDOException $e) {
                            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
                            return;
                        }
                    }
                }
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid quantity data.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
        }
    }
}

// Create an instance of the CartController passing the database connection
$cartController = new CartController($conn);
$cartController->updateCart();