document.addEventListener('DOMContentLoaded', function () {
    // Retrieve cart items from session storage or initialize an empty array
    var cartItems = JSON.parse(sessionStorage.getItem('cartItems')) || [];
    
    var cartItemsList = document.getElementById('cart-items-list');
    var subtotalElement = document.getElementById('subtotal');
    var totalElement = document.getElementById('total');
    var discount = 0; // Initialize discount to 0

    // Function to calculate the total price for each item
    function calculateItemTotal(item) {
        return item.price * item.quantity;
    }

    // Function to calculate the total price of all items in the cart
    function calculateTotal() {
        var subtotal = cartItems.reduce(function (total, item) {
            return total + calculateItemTotal(item);
        }, 0);
        
        return subtotal - (subtotal * discount); // Apply discount
    }

    // Function to render cart items in the table
    function renderCartItems() {
        cartItemsList.innerHTML = '';
        var subtotal = 0;
        cartItems.forEach(function (item, index) {
            // Create a table row for each item
            var row = document.createElement('tr');
            row.innerHTML = `
                <td class="shoping__cart__item">
                    <img src="${item.image}" alt="${item.name}" class="cart-item-image">
                    ${item.name}
                </td>
                <td class="shoping__cart__price">Ksh${item.price.toFixed(2)}</td>
                <td class="shoping__cart__quantity">
                    <div>
                        <button class="decrement-quantity" data-index="${index}">-</button>
                        <span>${item.quantity}</span>
                        <button class="increment-quantity" data-index="${index}">+</button>
                    </div>
                </td>
                <td class="shoping__cart__total">Ksh${calculateItemTotal(item).toFixed(2)}</td>
                <td class="shoping__cart__remove">
                    <button class="remove-item" data-index="${index}">X</button>
                </td>
            `;
            cartItemsList.appendChild(row);
    
            // Add item price to subtotal
            subtotal += calculateItemTotal(item);
        });
    
        // Update subtotal and total prices
        subtotalElement.querySelector('span').textContent = `Ksh${subtotal.toFixed(2)}`;
        totalElement.querySelector('span').textContent = `Ksh${calculateTotal().toFixed(2)}`;

        // Update discount
        var discountElement = document.getElementById('discount');
        discountElement.querySelector('span').textContent = `Ksh ${(subtotal * discount).toFixed(2)}`;
    }    

    // Event listener for incrementing quantity of items in the cart
    cartItemsList.addEventListener('click', function (event) {
        if (event.target.classList.contains('increment-quantity')) {
            var index = parseInt(event.target.getAttribute('data-index'));
            cartItems[index].quantity++;
            sessionStorage.setItem('cartItems', JSON.stringify(cartItems)); // Update cart items in session storage
            localStorage.setItem('cartItems', JSON.stringify(cartItems)); // Update cart items in local storage
            renderCartItems();
        } else if (event.target.classList.contains('decrement-quantity')) {
            var index = parseInt(event.target.getAttribute('data-index'));
            if (cartItems[index].quantity > 1) {
                cartItems[index].quantity--;
                sessionStorage.setItem('cartItems', JSON.stringify(cartItems)); // Update cart items in session storage
                localStorage.setItem('cartItems', JSON.stringify(cartItems)); // Update cart items in local storage
                renderCartItems();
            }
        } else if (event.target.classList.contains('remove-item')) {
            var index = parseInt(event.target.getAttribute('data-index'));
            cartItems.splice(index, 1); // Remove the item from the cart
            sessionStorage.setItem('cartItems', JSON.stringify(cartItems)); // Update cart items in session storage
            localStorage.setItem('cartItems', JSON.stringify(cartItems)); // Update cart items in local storage
            renderCartItems();
        }
    });

    // Define an array to store coupon codes and their corresponding discounts
    var coupons = [
        { code: 'SAVE2', discount: 0.02 }, // 2% discount
        { code: 'SAVE6', discount: 0.06 }, // 6% discount
        { code: 'SAVE9', discount: 0.09 }, // 9% discount
        { code: 'SAVE10', discount: 0.10 }, // 10% discount
        { code: 'SAVE12', discount: 0.12 }  // 12% discount
    ];

    // Event listener for applying discount code
    var discountForm = document.getElementById('discount-form');
    var couponInput = document.getElementById('coupon-code');
    discountForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent form submission

        var couponCode = couponInput.value.trim();
        var validCoupon = coupons.find(function (coupon) {
            return coupon.code === couponCode;
        });

        // Check if the coupon code is valid
        if (validCoupon) {
            discount = validCoupon.discount; // Apply the discount
            sessionStorage.setItem('discount', discount); // Store the discount in session storage  
            renderCartItems(); // Update cart items with the discount applied
            alert(`Coupon applied successfully! You get ${validCoupon.discount * 100}% off on your purchase.`);
        } else {
            alert('Invalid coupon code. Please try again.');
        }

        // Reset the coupon input field
        couponInput.value = '';
    });


    // Render cart items when the page loads
    renderCartItems();
});
