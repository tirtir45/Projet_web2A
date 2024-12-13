<?php
session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
</head>
<body>
    <h1>Thank You!</h1>
    
    <?php 
    // Display any session message set during the delivery process
    if (isset($_SESSION['response']['message'])): 
        ?>
        <p><?php echo htmlspecialchars($_SESSION['response']['message']); ?></p>
        <?php unset($_SESSION['response']); // Clear the message after displaying ?>
    <?php else: ?>
        <p>Your delivery information has been submitted successfully.</p>
    <?php endif; ?>

    <p><a href="/newaddina/index.php">Return to Cart</a></p>
</body>
</html>
