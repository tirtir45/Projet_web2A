<?php
header('Content-Type: application/json'); // Ensure JSON response
// Include the Database class
require_once __DIR__ . '/../connect.php';

class CartController {
    private $db;

    public function __construct() {
        // Create a new instance of the Database class
        $this->db = new config(); // This will automatically call the connect() method
    }

    public function getCartItems($userId) {
        $cartItems = []; // Initialize $cartItems as an empty array
    
        try {
            // Connect to the database
            $conn = $this->db::getConnexion(); // Assuming this is how your database connection works
    
            // Retrieve cart items for the logged-in user from the cart table
            $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
    
            // Fetch all the cart items associated with the user
            $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    
        return $cartItems;
    }
    

    public function addToCart($productName, $productPrice, $productImage, $quantity, $userId) {
        try {
            // Check if the product already exists in the cart for the user
            $stmt = $this->db::getConnexion()->prepare("SELECT * FROM cart WHERE product_name = :name AND image = :image AND user_id = :user_id");
            $stmt->bindParam(':name', $productName);
            $stmt->bindParam(':image', $productImage);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                // Product exists in the cart, update the quantity
                $existingProduct = $stmt->fetch(PDO::FETCH_ASSOC);
                $newQuantity = $existingProduct['quantity'] + $quantity;

                $updateStmt = $this->db::getConnexion()->prepare("UPDATE cart SET quantity = :quantity WHERE id = :id");
                $updateStmt->bindParam(':quantity', $newQuantity);
                $updateStmt->bindParam(':id', $existingProduct['id']);
                $updateStmt->execute();

                return ['success' => true, 'message' => "Product quantity updated."];
            } else {
                // Product doesn't exist, insert it into the cart
                $stmt = $this->db::getConnexion()->prepare("INSERT INTO cart (product_name, price, image, quantity, user_id) VALUES (:name, :price, :image, :quantity, :user_id)");

                // Bind parameters
                $stmt->bindParam(':name', $productName);
                $stmt->bindParam(':price', $productPrice);
                $stmt->bindParam(':image', $productImage);
                $stmt->bindParam(':quantity', $quantity);
                $stmt->bindParam(':user_id', $userId);

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
