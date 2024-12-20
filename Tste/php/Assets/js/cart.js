document.addEventListener("DOMContentLoaded", function () {
    // Get all the "Add to Cart" buttons
    const addToCartButtons = document.querySelectorAll('.add-to-cart');

    // Loop through each button and add event listener
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Retrieve product data from the button's data attributes
            const productName = this.getAttribute('data-name');
            const productPrice = this.getAttribute('data-price');
            const productImage = this.getAttribute('data-image');
            
            // Correct the path to match your file structure
            fetch("/1projet/newaddina/add_to_cart.php?add=true&name=" + encodeURIComponent(productName) +
            "&price=" + encodeURIComponent(productPrice) +
            "&image=" + encodeURIComponent(productImage), {
                method: "GET",
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Network response was not ok " + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                // Display the appropriate message based on the response
                if (data.success) {
                    alert(data.message); // Success message
                } else {
                    alert(data.message); // Error message
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("An error occurred while adding the item to the cart.");
            });
            
        });
    });
});
