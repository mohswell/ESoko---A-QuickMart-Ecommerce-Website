document.addEventListener('DOMContentLoaded', function () {
    // Retrieve cart items from local storage or initialize an empty array
    var cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    var cartItemsList = document.getElementById('cart-items-list');
    var totalElement = document.getElementById('total');

    // Function to calculate the total price for each item
    function calculateItemTotal(item) {
        return item.price * item.quantity;
    }

    // Function to calculate the total price of all items in the cart
    function calculateTotal() {
        return cartItems.reduce(function (total, item) {
            return total + calculateItemTotal(item);
        }, 0);
    }

    // Function to render cart items in the table
    function renderCartItems() {
        cartItemsList.innerHTML = '';
        var subtotal = 0;
        cartItems.forEach(function (item) {
            // Check if any necessary properties are undefined and remove them
            for (var key in item) {
                if (item.hasOwnProperty(key) && item[key] === undefined) {
                    delete item[key];
                }
            }
    
            // Create a table row for each item
            var row = document.createElement('tr');
            row.innerHTML = `
                <td class="shoping__cart__item">
                    <img src="${item.image}" alt="${item.name}" class="cart-item-image">
                    ${item.name}
                </td>
                <td class="shoping__cart__price">$${item.price.toFixed(2)}</td>
                <td class="shoping__cart__quantity">
                    <div>
                        <button class="decrement-quantity" data-index="${cartItems.indexOf(item)}">-</button>
                        <span>${item.quantity}</span>
                        <button class="increment-quantity" data-index="${cartItems.indexOf(item)}">+</button>
                    </div>
                </td>
                <td class="shoping__cart__total">$${calculateItemTotal(item).toFixed(2)}</td>
            `;
            cartItemsList.appendChild(row);
    
            // Add item price to subtotal
            subtotal += calculateItemTotal(item);
        });
    
        // Update subtotal and total prices
        var subtotalElement = document.getElementById('subtotal');
        var totalElement = document.getElementById('total');
        subtotalElement.querySelector('span').textContent = `$${subtotal.toFixed(2)}`;
        totalElement.querySelector('span').textContent = `$${subtotal.toFixed(2)}`;
    }    

    // Event listener for incrementing quantity of items in the cart
    cartItemsList.addEventListener('click', function (event) {
        if (event.target.classList.contains('increment-quantity')) {
            var index = parseInt(event.target.getAttribute('data-index'));
            cartItems[index].quantity++;
            localStorage.setItem('cartItems', JSON.stringify(cartItems)); // Update cart items in local storage
            renderCartItems();
        } else if (event.target.classList.contains('decrement-quantity')) {
            var index = parseInt(event.target.getAttribute('data-index'));
            if (cartItems[index].quantity > 1) {
                cartItems[index].quantity--;
                localStorage.setItem('cartItems', JSON.stringify(cartItems)); // Update cart items in local storage
                renderCartItems();
            }
        }
    });

    // Render cart items when the page loads
    renderCartItems();
});
