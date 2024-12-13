<?php
namespace app\models;

class DeliveryModel {
    private $conn;
    private $lastError;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    /**
     * Save delivery information to the livetransaction table
     * @param string $email
     * @param string $phone_number
     * @param string $address
     * @param string $payment_method
     * @param string $cart_id Unique identifier for the cart
     * @return bool
     */
    public function saveDelivery($email, $phone_number, $address, $payment_method, $cart_id) {
        $stmt = $this->conn->prepare("INSERT INTO livetransaction (cart_id, email, phone_number, address, payment_method, transaction_date) 
                                     VALUES (:cart_id, :email, :phone_number, :address, :payment_method, NOW())");

        $stmt->bindParam(':cart_id', $cart_id);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':payment_method', $payment_method);

        try {
            $stmt->execute();
            error_log("Transaction saved: cart_id=$cart_id, email=$email, Phone=$phone_number, Address=$address, Payment=$payment_method");
            return true;
        } catch (\PDOException $e) {
            $this->setLastError($e->getMessage());
            error_log("Error saving transaction: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get the last error message
     * @return string
     */
    public function getLastError() {
        return $this->lastError;
    }

    /**
     * Set the last error message
     * @param string $error
     */
    private function setLastError($error) {
        $this->lastError = $error;
    }
}

?>