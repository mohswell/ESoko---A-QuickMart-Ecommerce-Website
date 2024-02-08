document.addEventListener('DOMContentLoaded', function () {
    // Get the cart count and total elements
    var cartCount = document.getElementById('cart-count');
    var cartTotal = document.getElementById('cart-total-price');
    var cartItemsList = document.getElementById('cart-items-list'); // Added cart items list

    // Initialize the cart items and total from localStorage
    var cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

    // Add click event listener to the "Add to cart" buttons
    var addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            // Get product details from the button's data attributes
            var productId = button.getAttribute('data-product-id');
            var productName = button.getAttribute('data-product-name'); // Added product name
            var productPrice = parseFloat(button.getAttribute('data-product-price'));
            var productImage = button.getAttribute('data-product-image');

            // Check if the product is already in the cart
            var existingItem = cartItems.find(function (item) {
                return item.id === productId;
            });

            // If the product is already in the cart, update the quantity
            if (existingItem) {
                existingItem.quantity++;
            } else {
                // Otherwise, add a new item to the cart
                cartItems.push({
                    id: productId,
                    name: productName, // Added product name
                    price: productPrice,
                    quantity: 1,
                    image: productImage
                });
            }

            // Update localStorage with the new cart items
            localStorage.setItem('cartItems', JSON.stringify(cartItems));

            // Update the cart count, total, and items list display
            updateCart();
        });
    });

    function updateCart() {
        // Update the cart count
        var totalCount = cartItems.reduce(function (acc, item) {
            return acc + item.quantity;
        }, 0);
        cartCount.textContent = totalCount;

        // Calculate the total price of items in the cart
        var total = cartItems.reduce(function (acc, item) {
            var itemTotal = item.price * item.quantity;
            return acc + itemTotal;
        }, 0);

        // Update the cart total price using the specified ID
        if (cartTotal) {
            cartTotal.textContent = '$' + total.toFixed(2);
        }

        // Update the cart items list display
        renderCartItems();
    }

    function renderCartItems() {
        // Clear the previous cart items
        cartItemsList.innerHTML = '';

        // Render each cart item in the list
        cartItems.forEach(function (item) {
            var listItem = document.createElement('li');
            listItem.textContent = item.name + ' - Quantity: ' + item.quantity + ' - Total: $' + (item.price * item.quantity).toFixed(2);
            cartItemsList.appendChild(listItem);
        });
    }

    // Initial update of the cart
    updateCart();
});
