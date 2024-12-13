<?php
session_start();

// Check if the cart exists using the cart_id
if (!isset($_SESSION['cart_id']) || empty($_SESSION['cart_id'])) {
    header('Location: cart.php'); // Redirect to cart if cart_id is not set
    exit;
}

// Handle response messages
$responseMessage = '';
if (isset($_SESSION['response'])) {
    $responseMessage = $_SESSION['response']['message'];
    unset($_SESSION['response']); // Clear the message after displaying
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Information</title>
    <style>
        /* Your styling goes here */
    </style>
</head>
<body>

<h1>Delivery Information</h1>

<?php if ($responseMessage): ?>
    <div class="alert <?php echo strpos($responseMessage, 'success') !== false ? 'success' : 'error'; ?>">
        <?php echo htmlspecialchars($responseMessage); ?>
    </div>
<?php endif; ?>

<form action="process_delivery.php" method="POST">
    <input type="hidden" name="send" value="1"> <!-- Hidden field to trigger the email sending logic -->
    
    <label for="email">Email Address:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="phone_number">Phone Number:</label>
    <input type="text" id="phone_number" name="phone_number" required pattern="^[0-9]{8,15}$">
    
    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required>
    
    <label for="payment_method">Payment Method:</label>
    <input type="text" id="payment_method" name="payment_method" required>
    
    <button type="submit">Confirm</button>
</form>

</body>
</html>
