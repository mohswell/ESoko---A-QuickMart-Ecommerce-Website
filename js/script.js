document.addEventListener('DOMContentLoaded', function () {
    // Get the cart icon, count, and total elements
    var cartIcon = document.getElementById('cart-icon');
    var cartCount = document.getElementById('cart-count');
    var cartTotal = document.getElementById('cart-total-price');
   // var productImage = button.getAttribute('data-product-image');


    // Initialize the cart items and total from localStorage
    var cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

    // Add click event listener to the "Add to cart" buttons
    var addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            // Get product details from the button's data attributes
            var productId = button.getAttribute('data-product-id');
            var productPrice = parseFloat(button.getAttribute('data-product-price'));
            var productImage = button.getAttribute('data-product-image'); // Add this line

            // Check if the product price is a valid number
            if (isNaN(productPrice)) {
                console.error('Invalid product price for product ID ' + productId);
                return;
            }

            // Check if the product is already in the cart
            var existingItem = cartItems.find(function (item) {
                return item.id === productId;
            });

            // If the product is already in the cart, update the quantity
            // Otherwise, add a new item to the cart
            if (existingItem) {
                existingItem.quantity++;
            } else {
                cartItems.push({
                 // You dont need to fetch the product id it becomes repetitive
                 //   id: productId,
                    price: productPrice,
                    quantity: 1,
                    image: productImage
                });
            }

            // Update localStorage with the new cart items
            localStorage.setItem('cartItems', JSON.stringify(cartItems));

            // Update the cart count, total, and price display
            updateCart();
        });
    });

    // Function to update the cart count, total, and price display
    function updateCart() {
        // Update the cart count
        var totalCount = cartItems.reduce(function (acc, item) {
            return acc + item.quantity;
        }, 0);
        cartCount.textContent = totalCount;

        // Calculate the total price of items in the cart
        var total = cartItems.reduce(function (acc, item) {
            return acc + item.price * item.quantity;
        }, 0);

        // Update the cart total price using the specified ID
        if (cartTotal) {
            cartTotal.textContent = '$' + total.toFixed(2);
        }
    }
});
