<?php
session_start();
include '../connect.php'; // Include the Database class

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer classes
require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

use app\models\DeliveryModel;
include '../Models/DeliveryModel.php'; // Ensure this path is correct

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize input data
    $email = trim($_POST['email']);
    $phone_number = trim($_POST['phone_number']);
    $address = trim($_POST['address']);
    $payment_method = trim($_POST['payment_method']);

    // Validate input
    if (empty($email) || empty($phone_number) || empty($address) || empty($payment_method)) {
        $_SESSION['response'] = ['message' => 'All fields are required.'];
        header('Location: ../Views/delivery.php');
        exit();
    }

    // Log input data for debugging
    error_log("Email: $email, Phone Number: $phone_number, Address: $address, Payment Method: $payment_method");

    // Create an instance of the Database class to get the connection
    $database = new Database();
    $conn = $database->connect(); // Get the PDO connection

    // Create an instance of the DeliveryModel
    $deliveryModel = new DeliveryModel($conn);

    try {
        // Retrieve cart items and total price
        $query = "SELECT product_name, price, quantity FROM cart"; // Changed from panier to cart
        $stmt = $conn->query($query);
        $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Calculate the total price
        $totalPrice = 0;
        $receiptDetails = "Your purchased items:\n";

        foreach ($cartItems as $item) {
            $productName = $item['product_name'];
            $price = $item['price'];
            $quantity = $item['quantity'];
            $itemTotal = $price * $quantity; // Calculate the total for each product
            $totalPrice += $itemTotal; // Add to the total price
            $receiptDetails .= "Product: $productName, Quantity: $quantity, Unit Price: $price, Total: $itemTotal\n";
        }
        $receiptDetails .= "\nGrand Total: $totalPrice";

        // Generate a unique cart_id for this transaction
        $cart_id = uniqid("cart_"); // Unique identifier for the cart

        // Save delivery information in the livetransaction table
        if ($deliveryModel->saveDelivery($email, $phone_number, $address, $payment_method, $cart_id)) {
            // Save the total to the history table
            $historyQuery = "INSERT INTO history (cart_id, total) VALUES (:cart_id, :total)";
            $historyStmt = $conn->prepare($historyQuery);
            $historyStmt->bindParam(':cart_id', $cart_id);
            $historyStmt->bindParam(':total', $totalPrice);
            $historyStmt->execute();

            // Delete all items from the cart table
            $deleteQuery = "DELETE FROM cart"; // Changed from panier to cart
            $stmt = $conn->prepare($deleteQuery);
            $stmt->execute();

            // Clear the cart from the session
            unset($_SESSION['cart']); // Clear cart session

            // Send receipt email to the user using PHPMailer
            $mail = new PHPMailer(true);

            try {
                $mail->SMTPDebug = 0; // Set to 2 or 3 for more detailed output
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'barchoumi0000@gmail.com';
                $mail->Password = 'rpphufdhdbemqqcw'; // Use the app password here
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('barchoumi0000@gmail.com', 'Your Store');
                $mail->addAddress($email);
                $mail->isHTML(false); // Send the email as plain text
                $mail->Subject = "Your Purchase Receipt";
                $mail->Body = $receiptDetails;

                $mail->send();
                $_SESSION['response'] = ['message' => 'Delivery information saved, cart cleared, and receipt sent successfully!'];
            } catch (Exception $e) {
                $_SESSION['response'] = ['message' => "Delivery saved, but email could not be sent: {$mail->ErrorInfo}"];
            }

            // Redirect to the confirmation page
            header('Location: ../Views/confirmation.php');
            exit();
        } else {
            throw new Exception('Failed to save delivery information.');
        }
    } catch (Exception $e) {
        error_log("Error: " . $e->getMessage());
        $_SESSION['response'] = ['message' => 'Failed to complete the delivery process.'];
        header('Location: ../Views/delivery.php');
        exit();
    }
} else {
    header('Location: ../Views/delivery.php');
    exit();
}
?>
