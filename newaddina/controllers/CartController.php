<?php
// Include the Database class
require_once __DIR__ . '/../connect.php';

class CartController {
    private $db;

    public function __construct() {
        // Create a new instance of the Database class
        $this->db = new Database(); // This will automatically call the connect() method
    }

    public function addToCart($productName, $productPrice, $productImage, $quantity) {
        try {
            // Check if the product already exists in the cart (same product)
            $stmt = $this->db->connect()->prepare("SELECT * FROM cart WHERE product_name = :name AND image = :image");
            $stmt->bindParam(':name', $productName);
            $stmt->bindParam(':image', $productImage);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                // Product exists in the cart, update the quantity
                $existingProduct = $stmt->fetch(PDO::FETCH_ASSOC);
                $newQuantity = $existingProduct['quantity'] + $quantity;

                $updateStmt = $this->db->connect()->prepare("UPDATE cart SET quantity = :quantity WHERE id = :id");
                $updateStmt->bindParam(':quantity', $newQuantity);
                $updateStmt->bindParam(':id', $existingProduct['id']);
                $updateStmt->execute();

                return ['success' => true, 'message' => "Product quantity updated."];
            } else {
                // Product doesn't exist, insert it into the cart
                $stmt = $this->db->connect()->prepare("INSERT INTO cart (product_name, price, image, quantity) VALUES (:name, :price, :image, :quantity)");

                // Bind parameters
                $stmt->bindParam(':name', $productName);
                $stmt->bindParam(':price', $productPrice);
                $stmt->bindParam(':image', $productImage);
                $stmt->bindParam(':quantity', $quantity);

                // Execute the query
                if ($stmt->execute()) {
                    return ['success' => true, 'message' => "$productName has been added to the cart."];
                } else {
                    return ['success' => false, 'message' => "Error adding product to cart."];
                }
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => "Error: " . $e->getMessage()];
        }
    }
}
?>
