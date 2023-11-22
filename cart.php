<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="assets/cart.css">
    <link rel="stylesheet" href="assets/header.css">
    <style>
        
    </style>
</head>
<body>
<header class="header">
        <a href="#" class="logo">XYZshoe</a>

        <nav class="navbar">
            <a href="welcome.php">HOME</a>
            <a href="index.php">LOG IN</a>
            <a href="shop.php">SHOP</a>
            <a href="contactus.php">CONTACT</a>
            <a href="aboutus.php">ABOUT US</a>
        </nav>
        <div class="cart-icons">
                  <a href="cart.php" > <img src="images/cart-icon.png" height="50px" width="50px" ></a> 
                  <span class="quantity">0</span>
        </div>

    </header>

    


    <div class="cart-container">
        <div class="topic1">
            <h1>Shopping Cart</h1>
        </div>
        <!-- <div class="topic" data-id="0">
            <h3>Image</h3>
            <h3>Name</h3>
            <h3>Price</h3>
            <h3>Quantity</h3>
        </div>
        <div class="cart-item" data-id="1">
            <img src="product1.jpg" alt="Product 1">
            <span>Product 1</span>
            <span>$20.00</span>
            <input type="number" class="quantity-input" value="1" min="1">
            <button class="remove-item">Remove</button>
        </div>

        <div class="cart-item" data-id="2">
            <img src="product2.jpg" alt="Product 2">
            <span>Product 2</span>
            <span>$30.00</span>
            <input type="number" class="quantity-input" value="1" min="1">
            <button class="remove-item">Remove</button> -->
        <!-- </div> -->

        <div class="cart-total">
            <strong>Total: 0.00</strong>
        </div>

        
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const removeButtons = document.querySelectorAll('.remove-item');
            const quantityInputs = document.querySelectorAll('.quantity-input');
            const checkoutButton = document.getElementById('checkout');

            removeButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const item = this.closest('.cart-item');
                    item.remove();
                    updateTotal();
                });
            });

            quantityInputs.forEach(input => {
                input.addEventListener('input', function () {
                    updateTotal();
                });
            });

            checkoutButton.addEventListener('click', function () {
                alert('Checkout clicked! Implement your checkout logic here.');
            });

            function updateTotal() {
                const items = document.querySelectorAll('.cart-item');
                let total = 0;

                items.forEach(item => {
                    const price = parseFloat(item.children[2].innerText.substring(1));
                    const quantity = parseInt(item.querySelector('.quantity-input').value);
                    total += price * quantity;
                });

                const totalElement = document.querySelector('.cart-total strong');
                totalElement.innerText = `Total: $${total.toFixed(2)}`;
            }
        });
    </script>

</body>
</html>
