<?php
require_once(__DIR__ . '/../Models/ProductModel.php');

class ProductController {
    private $productModel;

    public function __construct($pdo) {
        $this->productModel = new ProductModel($pdo);
    }

    // Fetch all products
    public function getProducts() {
        return $this->productModel->getAllProducts(); // Fetch all products
    }

    // Delete a product by ID
    public function deleteProduct($product_id) {
        return $this->productModel->deleteProductById($product_id); // Call the delete method in the model
    }

    // Add the method to fetch product by ID
    public function getProductById($productId) {
        // Call the method in the ProductModel to fetch the product by ID
        return $this->productModel->getProductById($productId);
    }
}
?>
