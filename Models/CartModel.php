<?php
namespace app\models;

class CartModel {
    public static function getCartItems() {
        return isset($_SESSION['panier']) ? $_SESSION['panier'] : [];
    }

    public static function clearCart() {
        unset($_SESSION['panier']);
    }

    public static function removeItem($productName) {
        if (isset($_SESSION['panier'][$productName])) {
            unset($_SESSION['panier'][$productName]);
        }
    }

    public static function updateCart($quantities, $conn) {
        foreach ($quantities as $productName => $newQuantity) {
            if (isset($_SESSION['panier'][$productName])) {
                $_SESSION['panier'][$productName]['quantity'] = max(1, (int)$newQuantity); // Ensure quantity is at least 1
            }
        }

        // Update the database
        return self::updateDatabase($conn);
    }

    private static function updateDatabase($conn) {
        foreach ($_SESSION['panier'] as $productName => $item) {
            $stmt = $conn->prepare("UPDATE panier SET quantity = ? WHERE product_name = ?");
            $stmt->bind_param("is", $item['quantity'], $productName);
            $stmt->execute();
            $stmt->close();
        }
        return true;
    }
}
?>