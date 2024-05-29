
let cart = [];
let total = 0;

function sortMenu() {
    const sortBy = document.getElementById("sort-option").value;
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'delivery.php?ajax=1&sort=' + sortBy, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('menu-container').innerHTML = xhr.responseText;
            attachEventListeners(); 
        }
    };
    xhr.send();
}

function attachEventListeners() {
    document.querySelectorAll('.add-to-cart').forEach(function(button) {
        button.addEventListener('click', function() {
            const name = this.getAttribute('data-name');
            const price = parseFloat(this.getAttribute('data-price'));
            addToCart(name, price);
        });
    });
    document.getElementById('order-now').addEventListener('click', function() {
        placeOrder();
    });
    document.getElementById('clear').addEventListener('click', function() {
        clearCart();
    });
}

function addToCart(name, price) {
    const item = cart.find(item => item.name === name);
    if (item) {
        item.quantity++;
    } else {
        cart.push({ name, price, quantity: 1 });
    }
    total += price;
    updateCart();
}

function updateCart() {
    const cartContainer = document.getElementById('cart');
    cartContainer.innerHTML = '';
    cart.forEach(item => {
        const cartItem = document.createElement('div');
        cartItem.textContent = `${item.name} - $${item.price} x ${item.quantity}`;
        cartContainer.appendChild(cartItem);
    });
    document.getElementById('total').textContent = `$${total.toFixed(2)}`;
}

function clearCart() {
    cart = [];
    total = 0;
    updateCart();
}

function placeOrder() {
    if (cart.length === 0) {
        alert("Your cart is empty!");
    } else {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'delivery.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                window.location.href = 'checkout.php';
            }
        };
        xhr.send(JSON.stringify({ action: 'update_cart', cart: cart }));
    }
}


document.addEventListener('DOMContentLoaded', function() {
    attachEventListeners();
});
