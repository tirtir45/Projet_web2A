<?php
session_start();
require_once '../connect.php'; // Adjust the path as per your project structure

// Create a Database instance and get the PDO connection
$database = new Database();
$conn = $database->connect();

// Retrieve cart items from the database
$stmt = $conn->prepare("SELECT * FROM cart");
$stmt->execute();
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle product deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteProduct'])) {
    $productName = $_POST['deleteProduct'];

    // Database deletion logic
    $stmt = $conn->prepare("DELETE FROM cart WHERE product_name = :product_name");
    $stmt->bindParam(":product_name", $productName, PDO::PARAM_STR);
    $stmt->execute();

    // Respond with a success message
    echo json_encode(["status" => "success", "message" => "Product '$productName' has been removed from the cart."]);
    exit();
}

// Handle quantity updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateQuantity'])) {
    $productName = $_POST['updateQuantity'];
    $newQuantity = $_POST['newQuantity'];

    // Update quantity in the database
    $stmt = $conn->prepare("UPDATE cart SET quantity = :quantity WHERE product_name = :product_name");
    $stmt->bindParam(":quantity", $newQuantity, PDO::PARAM_INT);
    $stmt->bindParam(":product_name", $productName, PDO::PARAM_STR);
    $stmt->execute();

    // Respond with a success message
    echo json_encode(["status" => "success", "message" => "Quantity of '$productName' has been updated to $newQuantity."]);
    exit();
}

// Handle the redirection after confirming the purchase (Buy Now)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buyNow'])) {
    // Store cart_id in session to use on delivery.php
    $_SESSION['cart_id'] = session_id();  // or use your own method to generate cart_id

    // Respond with success message to trigger the redirection on the client side
    echo json_encode(["status" => "success", "message" => "Your purchase is confirmed. Redirecting to the delivery page."]);
    exit();
}
?>

<div class="container">
    <h1>Your Shopping Cart</h1>

    <!-- Display message -->
    <div id="message"></div>

    <!-- Cart Table -->
    <table id="cartTable">
        <thead>
            <tr>
                <th>Product</th>
                <th>Image</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($cartItems)): ?>
                <tr>
                    <td colspan="5" class="empty-cart">Your cart is empty.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($cartItems as $item): ?>
                    <tr id="row-<?php echo htmlspecialchars($item['product_name']); ?>">
                        <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                        <td>
                            <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="Product Image" class="cart-image">
                        </td>
                        <td><?php echo htmlspecialchars($item['price']); ?> $</td>
                        <td>
                            <div class="quantity-controls">
                                <button class="quantity-btn" data-product="<?php echo htmlspecialchars($item['product_name']); ?>" data-action="decrease">-</button>
                                <span id="quantity-<?php echo htmlspecialchars($item['product_name']); ?>"><?php echo htmlspecialchars($item['quantity']); ?></span>
                                <button class="quantity-btn" data-product="<?php echo htmlspecialchars($item['product_name']); ?>" data-action="increase">+</button>
                            </div>
                        </td>
                        <td>
                            <!-- Delete Button -->
                            <button class="remove-btn" data-product="<?php echo htmlspecialchars($item['product_name']); ?>">Remove</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Buy Now and Return to Shop Buttons -->
    <div class="cart-buttons">
        <button 
            type="button" 
            class="cart-btn buy-now-btn" 
            id="buyNowBtn">
            🛒 Buy Now
        </button>

        <button 
            type="button" 
            class="cart-btn return-shop-btn" 
            onclick="window.location.href='/newaddina/'">
            ⬅️ Return to Shop
        </button>
    </div>
</div>

<!-- JavaScript to handle AJAX operations -->
<script>
    // Handle Buy Now button click event
    document.getElementById('buyNowBtn').addEventListener('click', function() {
        // Send AJAX request to confirm the purchase
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'cart.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                
                // Show the message
                var messageDiv = document.getElementById('message');
                messageDiv.innerHTML = `<div class="alert ${response.status === 'success' ? 'success' : 'error'}">${response.message}</div>`;

                // If successful, redirect to delivery page
                if (response.status === 'success') {
                    window.location.href = 'delivery.php';  // Redirect to the delivery page
                }
            }
        };

        // Sending the request to the server to simulate the 'Buy Now' functionality
        xhr.send('buyNow=true');
    });

    // Handle the removal of the product from the cart using AJAX
    document.querySelectorAll('.remove-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var productName = this.getAttribute('data-product');

            // Send AJAX request to remove the product
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'cart.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    
                    // Show the message
                    var messageDiv = document.getElementById('message');
                    messageDiv.innerHTML = `<div class="alert ${response.status === 'success' ? 'success' : 'error'}">${response.message}</div>`;

                    // If successful, remove the row from the table
                    if (response.status === 'success') {
                        var row = document.getElementById('row-' + productName);
                        row.remove();
                    }
                }
            };
            xhr.send('deleteProduct=' + encodeURIComponent(productName));
        });
    });

    // Handle the quantity increase/decrease buttons using AJAX
    document.querySelectorAll('.quantity-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var productName = this.getAttribute('data-product');
            var action = this.getAttribute('data-action');
            var quantitySpan = document.getElementById('quantity-' + productName);
            var currentQuantity = parseInt(quantitySpan.textContent);

            // Adjust quantity based on the action (increase/decrease)
            if (action === 'increase') {
                currentQuantity++;
            } else if (action === 'decrease' && currentQuantity > 1) {
                currentQuantity--;
            }

            // Send AJAX request to update the quantity in the database
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'cart.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    
                    // Show the message
                    var messageDiv = document.getElementById('message');
                    messageDiv.innerHTML = `<div class="alert ${response.status === 'success' ? 'success' : 'error'}">${response.message}</div>`;

                    // If successful, update the quantity on the page
                    if (response.status === 'success') {
                        quantitySpan.textContent = currentQuantity;
                    }
                }
            };
            xhr.send('updateQuantity=' + encodeURIComponent(productName) + '&newQuantity=' + encodeURIComponent(currentQuantity));
        });
    });
</script>

<!-- Include external JS files -->
<script src="/addina/assets/js/jquery-3.6.0.min.js"></script>
<script src="/addina/assets/js/waypoints.min.js"></script>
<script src="/addina/assets/js/bootstrap.bundle.min.js"></script>
<script src="/addina/assets/js/meanmenu.min.js"></script>
<script src="/addina/assets/js/swiper.min.js"></script>
<script src="/addina/assets/js/slick.min.js"></script>
<script src="/addina/assets/js/magnific-popup.min.js"></script>
<script src="/addina/assets/js/counterup.js"></script>
<script src="/addina/assets/js/wow.js"></script>
<script src="/addina/assets/js/ajax-form.js"></script>
<script src="/addina/assets/js/beforeafter.jquery-1.0.0.min.js"></script>
<script src="/addina/assets/js/main.js"></script>

<!-- CSS for the cart and alert styles -->
<style>
    .cart-buttons button {
        padding: 10px 20px;
        background-color: #ff6347;
        color: white;
        border: none;
        cursor: pointer;
        margin: 10px;
    }
    .cart-buttons button:hover {
        background-color: #ff4500;
    }
    .alert {
        padding: 10px;
        margin-top: 20px;
        border-radius: 5px;
    }
    .success {
        background-color: #d4edda;
        color: #155724;
    }
    .error {
        background-color: #f8d7da;
        color: #721c24;
    }
    .empty-cart {
        text-align: center;
        font-size: 18px;
        color: gray;
    }
</style>
