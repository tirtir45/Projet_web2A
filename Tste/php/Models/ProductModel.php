<?php
class ProductModel {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo; // Set the database connection
    }

    // Fetch all products
    public function getAllProducts() {
        try {
            $query = "SELECT id, product_name, price, image FROM products";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("ProductModel::getAllProducts error: " . $e->getMessage());
            return [];
        }
    }

    // Fetch a single product by ID
    public function getProductById($productId) {
        try {
            $query = "SELECT id, product_name, price, image FROM products WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Return the product details
        } catch (Exception $e) {
            error_log("ProductModel::getProductById error: " . $e->getMessage());
            return null;
        }
    }

    // Delete a product by ID
    public function deleteProductById($productId) {
        try {
            $query = "DELETE FROM products WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("ProductModel::deleteProductById error: " . $e->getMessage());
            return false;
        }
    }
}
?>
