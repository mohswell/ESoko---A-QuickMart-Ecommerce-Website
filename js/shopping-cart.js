document.addEventListener('DOMContentLoaded', function () {
    const products = [
        { id: 1, price: 25.00, image: 'img/featured/feature-1.jpg' },
        { id: 2, price: 30.00, image: 'img/featured/feature-2.jpg' },
        { id: 3, price: 50.00, image: 'img/featured/feature-3.jpg' },
        { id: 4, price: 40.00, image: 'img/featured/feature-4.jpg' },
        { id: 5, price: 20.00, image: 'img/featured/feature-5.jpg' },
        { id: 6, price: 60.00, image: 'img/featured/feature-6.jpg' },
        { id: 7, price: 35.00, image: 'img/featured/feature-7.jpg' },
        { id: 8, price: 65.00, image: 'img/featured/feature-8.jpg' }
        // ... Add details for other products
    ];

    var cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    var cartItemsList = document.getElementById('cart-items-list');
    var subtotalElement = document.getElementById('subtotal');
    var totalElement = document.getElementById('total');

    function updateCart() {
        var updatedTotal = cartItems.reduce(function (sum, item) {
            return sum + item.price * item.quantity;
        }, 0);

        totalElement.textContent = `$${updatedTotal.toFixed(2)}`;
    }

    function renderCartItems() {
        cartItemsList.innerHTML = '';

        cartItems.forEach(function (item) {
            var row = document.createElement('tr');

            row.innerHTML = `
                <td class="shoping__cart__item">
                    <img src="${item.image}" alt="${item.id}">
                    <h5>${item.id}</h5>
                </td>
                <td class="shoping__cart__price">
                    $${item.price.toFixed(2)}
                </td>
                <td class="shoping__cart__quantity">
                    <div class="quantity" data-id="${item.id}">
                        <div class="pro-qty">
                            <input type="number" value="${item.quantity}" min="1">
                        </div>
                    </div>
                </td>
                <td class="shoping__cart__total">
                    $${(item.price * item.quantity).toFixed(2)}
                </td>
                <td class="shoping__cart__item__close">
                    <span class="icon_close" data-product-id="${item.id}"></span>
                </td>
            `;
            cartItemsList.appendChild(row);

            var quantityInput = row.querySelector('.pro-qty input');
            quantityInput.addEventListener('change', function () {
                item.quantity = parseInt(quantityInput.value);
                localStorage.setItem('cartItems', JSON.stringify(cartItems));
                updateCart();
            });
        });

        var closeIcons = cartItemsList.querySelectorAll('.icon_close');
        closeIcons.forEach(function (icon) {
            icon.addEventListener('click', function () {
                var productIdToRemove = icon.getAttribute('data-product-id');
                var rowToRemove = icon.closest('tr');
                rowToRemove.remove();

                cartItems = cartItems.filter(function (item) {
                    return item.id !== parseInt(productIdToRemove);
                });

                localStorage.setItem('cartItems', JSON.stringify(cartItems));
                updateCart();
            });
        });
    }

    var updateCartButton = document.getElementById('updateCartButton');
    if (updateCartButton) {
        updateCartButton.addEventListener('click', function () {
            cartItems.forEach(function (item) {
                var quantityInput = document.querySelector(`.pro-qty[data-id="${item.id}"] input`);
                if (quantityInput) {
                    item.quantity = parseInt(quantityInput.value);
                }
            });

            localStorage.setItem('cartItems', JSON.stringify(cartItems));
            renderCartItems();
        });
    }

    renderCartItems();
    updateCart();
});
