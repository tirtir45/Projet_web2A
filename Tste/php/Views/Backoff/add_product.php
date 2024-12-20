<?php
include_once '../../connect.php';

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get product details from the form
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Handle the image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Get the image file details
        $image = $_FILES['image'];
        $image_name = $image['name'];
        $image_tmp_name = $image['tmp_name'];
        $image_size = $image['size'];
        $image_error = $image['error'];

        // Set the target directory for the image
        $target_dir = "../../assets/images/";
        $target_file = $target_dir . basename($image_name);

        // Check if the file is a valid image (optional)
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($image_file_type, $allowed_types) && $image_size < 5000000) { // Limit size to 5MB
            // Move the uploaded file to the target directory
            if (move_uploaded_file($image_tmp_name, $target_file)) {
                // Insert the product details into the database
                $db = new config();
                $pdo = $db::getConnexion();

                $query = "INSERT INTO products (product_name, price, quantity, image) VALUES (:product_name, :price, :quantity, :image)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':product_name', $product_name);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':quantity', $quantity);
                $stmt->bindParam(':image', $image_name); // Store the image filename in the database

                if ($stmt->execute()) {
                    echo "Product added successfully!";
                } else {
                    echo "Error adding product.";
                }
            } else {
                echo "Error uploading the image.";
            }
        } else {
            echo "Invalid image file type or size.";
        }
    } else {
        echo "No image uploaded or there was an error.";
    }
}
?>
