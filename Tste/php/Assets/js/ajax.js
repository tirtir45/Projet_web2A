// assets/js/ajax.js
function updateQuantity(productName, change) {
    const quantityInput = document.getElementById('quantity-' + productName);
    let currentQuantity = parseInt(quantityInput.value);

    // Update the quantity based on the button clicked
    if (change === 'increment') {
        quantityInput.value = currentQuantity + 1;
        console.log(`Incrementing quantity for ${productName}: ${quantityInput.value}`);
    } else if (change === 'decrement' && currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;
        console.log(`Decrementing quantity for ${productName}: ${quantityInput.value}`);
    }

    // Log the quantity being sent to the server
    console.log(`Sending quantity to server: ${quantityInput.value} for product: ${productName}`);

    // Send AJAX request to update the cart
    fetch('/newaddina/Controller/update_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            quantity: {
                [productName]: quantityInput.value
            }
        })
    })
    .then(response => {
        console.log('Response received from server:', response);
        return response.json();  // Parse the JSON response
    })
    .then(data => {
        console.log('Data returned from server:', data);
        if (data.success) {
            console.log('Quantity updated successfully.');
        } else {
            console.error('Error updating quantity:', data.message);
        }
    })
    .catch(error => console.error('Error during fetch:', error));
}

function removeFromCart(productName) {
    // Send AJAX request to remove the item from the cart
    fetch('/newaddina/Controller/remove_item.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            product_name: productName
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log(`${productName} removed successfully.`);
            // Optionally, remove the item from the UI
            document.getElementById('item-' + productName).remove(); // Change this to match your HTML structure
        } else {
            console.error('Error removing item:', data.message);
        }
    })
    .catch(error => console.error('Error during fetch:', error));
}