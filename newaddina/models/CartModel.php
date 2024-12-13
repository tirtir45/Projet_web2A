<?php
class CartModel {
    private $db;

    public function __construct($db) {
        $this->db = $db; // Set the database connection
    }

    public function addToCart($productName, $productPrice, $productImage, $quantity) {
        try {
            // Check if the product already exists in the cart
            $query = "SELECT id, quantity FROM cart WHERE product_name = :product_name";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':product_name', $productName, PDO::PARAM_STR);
            $stmt->execute();
            $existingProduct = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($existingProduct) {
                // Update the quantity of the existing product
                $newQuantity = $existingProduct['quantity'] + $quantity;
                $updateQuery = "UPDATE cart SET quantity = :quantity WHERE id = :id";
                $updateStmt = $this->db->prepare($updateQuery);
                $updateStmt->bindParam(':quantity', $newQuantity, PDO::PARAM_INT);
                $updateStmt->bindParam(':id', $existingProduct['id'], PDO::PARAM_INT);
                return $updateStmt->execute();
            } else {
                // Insert the new product into the cart
                $insertQuery = "INSERT INTO cart (product_name, price, image, quantity) 
                                VALUES (:product_name, :price, :image, :quantity)";
                $insertStmt = $this->db->prepare($insertQuery);
                $insertStmt->bindParam(':product_name', $productName, PDO::PARAM_STR);
                $insertStmt->bindParam(':price', $productPrice);
                $insertStmt->bindParam(':image', $productImage, PDO::PARAM_STR);
                $insertStmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                return $insertStmt->execute();
            }
        } catch (Exception $e) {
            error_log("CartModel::addToCart error: " . $e->getMessage());
            return false;
        }
    }

    // Optionally, add other cart-related methods like removeItem, getCartItems, etc.
}
?>
