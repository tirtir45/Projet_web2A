<?php
try {
    // Adjust these values if needed
    $conn = new PDO("mysql:host=localhost;dbname=panier", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Sample data to insert
    $cin = '12345678';
    $phone_number = '1234567890';
    $address = 'Test Address';
    $payment_method = 'Credit Card';

    // Insert statement
    $stmt = $conn->prepare("
        INSERT INTO delivery (cin, phone_number, address, payment_method, created_at)
        VALUES (:cin, :phone_number, :address, :payment_method, NOW())
    ");
    $stmt->bindParam(':cin', $cin);
    $stmt->bindParam(':phone_number', $phone_number);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':payment_method', $payment_method);

    // Execute the query
    $stmt->execute();

    echo "Delivery record inserted successfully.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
