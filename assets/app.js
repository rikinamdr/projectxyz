const products = [
    { id: 1, name: 'Product 1', price: 20 },
    { id: 2, name: 'Product 2', price: 30 },
    // Add more products as needed
];

let cart = [];

function renderProducts() {
    const productList = document.getElementById('product-list');
    productList.innerHTML = '';

    products.forEach(product => {
        const productItem = document.createElement('div');
        productItem.classList.add('product');
        productItem.innerHTML = `
            <p>${product.name} - $${product.price}</p>
            <button onclick="addToCart(${product.id})">Add to Cart</button>
        `;
        productList.appendChild(productItem);
    });
}

function renderCart() {
    const cartItemsContainer = document.getElementById('cart-items');
    const totalPriceElement = document.getElementById('total-price');

    cartItemsContainer.innerHTML = '';
    
    cart.forEach(item => {
        const cartItem = document.createElement('div');
        cartItem.classList.add('cart-item');
        cartItem.innerHTML = `
            <p>${item.name} - Quantity: ${item.quantity} - $${(item.price * item.quantity).toFixed(2)}</p>
        `;
        cartItemsContainer.appendChild(cartItem);
    });

    const totalAmount = cart.reduce((total, item) => total + (item.price * item.quantity), 0);
    totalPriceElement.textContent = `Total: $${totalAmount.toFixed(2)}`;
}

function addToCart(productId) {
    const product = products.find(p => p.id === productId);
    if (product) {
        const existingCartItem = cart.find(item => item.id === productId);
        if (existingCartItem) {
            existingCartItem.quantity += 1;
        } else {
            cart.push({ ...product, quantity: 1 });
        }

        renderCart();
    }
}

document.addEventListener('DOMContentLoaded', () => {
    renderProducts();
    renderCart();
});
