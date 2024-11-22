<?php
session_start(); // Start the session
$cartItems = isset($_SESSION['panier']) ? $_SESSION['panier'] : [];

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
    <title>Your Cart</title>
    <style>
        /* Add some basic styling */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        img {
            max-width: 100px; /* Set a fixed width for images */
            height: auto; /* Maintain aspect ratio */
        }
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert.success {
            color: green;
            border-color: green;
        }
        .alert.error {
            color: red;
            border-color: red;
        }
        .quantity-controls {
            display: flex;
            align-items: center;
        }
        .quantity-controls button {
            width: 30px;
            height: 30px;
        }
        .quantity-controls input {
            width: 40px;
            text-align: center;
            margin: 0 5px;
        }
    </style>
    <script src="/newaddina/assets/js/ajax.js" defer></script> <!-- Include AJAX JS file -->
</head>
<body>
    <h1>Your Shopping Cart</h1>

    <?php if ($responseMessage): ?>
        <div class="alert <?php echo strpos($responseMessage, 'removed') !== false ? 'success' : 'error'; ?>">
            <?php echo htmlspecialchars($responseMessage); ?>
        </div>
    <?php endif; ?>

    <form id="cart-form">
        <table>
            <tr>
                <th>Product</th>
                <th>Image</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
            <?php if (empty($cartItems)): ?>
                <tr>
                    <td colspan="5">Your cart is empty.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($cartItems as $productName => $item): ?>
                <tr id="item-<?php echo htmlspecialchars($productName); ?>">
                    <td><?php echo htmlspecialchars($productName); ?></td>
                    <td><img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($productName); ?>"></td>
                    <td><?php echo htmlspecialchars($item['price']); ?></td>
                    <td>
                        <div class="quantity-controls">
                            <button type="button" onclick="updateQuantity('<?php echo htmlspecialchars($productName); ?>', 'decrement')">-</button>
                            <input type="number" id="quantity-<?php echo htmlspecialchars($productName); ?>" name="quantity[<?php echo htmlspecialchars($productName); ?>]" value="<?php echo htmlspecialchars($item['quantity']); ?>" min="1">
                            <button type="button" onclick="updateQuantity('<?php echo htmlspecialchars($productName); ?>', 'increment')">+</button>
                        </div>
                    </td>
                    <td>
                        <button type="button" onclick="removeFromCart('<?php echo htmlspecialchars($productName); ?>')">Remove</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
        <button type="button" class="buy-now-btn" onclick="window.location.href='delivery.php'">Buy Now</button>
        <button type="button" class="buy-now-btn" onclick="window.location.href='/newaddina'">Return to shop</button>
    </form>
</body>
</html>