<?php
namespace app\models;

class DeliveryModel {
    private $conn;
    private $lastError;

    public function __construct($connection) {
        $this->conn = $connection;
        $this->lastError = '';
    }

    public function saveDelivery($cin, $phone_number, $address, $payment_method) {
        // Prepare and bind
        $stmt = $this->conn->prepare("INSERT INTO delivery (cin, phone_number, address, payment_method) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $cin, $phone_number, $address, $payment_method);

        // Execute the statement
        if ($stmt->execute()) {
            return true;
        } else {
            $this->lastError = $stmt->error; // Store the error message
            return false;
        }
    }

    public function getLastError() {
        return $this->lastError; // Return the last error message
    }
}
?>