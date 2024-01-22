let openShopping = document.querySelector('.shopping');
let closeShopping = document.querySelector('.closeShopping');
let list = document.querySelector('.list');
let listCard = document.querySelector('.listCard');
let body = document.querySelector('body');
let total = document.querySelector('.total');
let quantity = document.querySelector('.quantity');
let checkout = document.querySelector('.checkout');

openShopping.addEventListener('click', () => {
    body.classList.add('active');
})
closeShopping.addEventListener('click', () => {
    body.classList.remove('active');
})

let products = [
    {
        id: 1,
        name: 'SEVILLE ORANGES',
        image: 'oranges-sales7.jpg',
        price: 4000
    },
    {
        id: 2,
        name: 'MANZANO BANANA',
        image: 'bananas-sales2.jpg',
        price: 1200
    },
    {
        id: 3,
        name: 'CRIMSON GRAPES',
        image: 'grapes-sales5.jpg',
        price: 2200
    },
    {
        id: 4,
        name: 'AMRAPALI MANGOES',
        image: 'mangos-sales5.jpg',
        price: 1230
    },
    {
        id: 5,
        name: 'RED SPANISH PINEAPLES',
        image: 'pineaples-sales8.jpg',
        price: 3200
    },
    {
        id: 6,
        name: 'DETWILER GUAVAS',
        image: 'guavas-sales3.jpg',
        price: 1200
    },
    {
        id: 1,
        name: 'SEVILLE ORANGES',
        image: 'oranges-sales7.jpg',
        price: 4000
    },
    {
        id: 2,
        name: 'MANZANO BANANA',
        image: 'bananas-sales2.jpg',
        price: 1200
    },
    {
        id: 3,
        name: 'CRIMSON GRAPES',
        image: 'grapes-sales5.jpg',
        price: 2200
    },
    {
        id: 4,
        name: 'AMRAPALI MANGOES',
        image: 'mangos-sales5.jpg',
        price: 1230
    },
    {
        id: 5,
        name: 'RED SPANISH PINEAPLES',
        image: 'pineaples-sales8.jpg',
        price: 3200
    },
    {
        id: 6,
        name: 'DETWILER GUAVAS',
        image: 'guavas-sales3.jpg',
        price: 1200
    }
];
let listCards = [];
function initApp() {
    products.forEach((value, key) => {
        let newDiv = document.createElement('div');
        newDiv.classList.add('item');
        newDiv.innerHTML = `
            <img src="image/${value.image}" alt="fruit image">
            <div class="title">${value.name}</div>
            <div class="price">Ksh ${value.price.toLocaleString()}</div>
            <button onclick="addToCard(${key})">Add To Card</button>`;
        list.appendChild(newDiv);
    })
}
initApp();
function addToCard(key) {
    if (listCards[key] == null) {
        // copy product form list to list card
        listCards[key] = JSON.parse(JSON.stringify(products[key]));
        listCards[key].quantity = 1;
    }
    reloadCard();
}
function reloadCard() {
    listCard.innerHTML = '';
    let count = 0;
    let totalPrice = 0;
    listCards.forEach((value, key) => {
        totalPrice = totalPrice + value.price;
        count = count + value.quantity;
        if (value != null) {
            let newDiv = document.createElement('li');
            newDiv.innerHTML = `
                <div><img src="image/${value.image}"/></div>
                <div>${value.name}</div>
                <div>${value.price.toLocaleString()}</div>
                <div>
                    <button onclick="changeQuantity(${key}, ${value.quantity - 1})">-</button>
                    <div class="count">${value.quantity}</div>
                    <button onclick="changeQuantity(${key}, ${value.quantity + 1})">+</button>
                </div>`;
            listCard.appendChild(newDiv);
        }
    })
    total.innerText = "Ksh " + totalPrice.toLocaleString();
    quantity.innerText = count;
}
function changeQuantity(key, quantity) {
    if (quantity == 0) {
        delete listCards[key];
    } else {
        listCards[key].quantity = quantity;
        listCards[key].price = quantity * products[key].price;
    }
    reloadCard();
}
/*Check Out button */
checkout.addEventListener('click', () => {
    console.log("Check Out");

});