<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout Page</title>
  <link rel="stylesheet" href="assets/checkout.css">
  <link rel="stylesheet" href="assets/header.css">
   
</head>
<body>
<header class="header">
    <a href="#" class="logo">XYZshoe</a>

    <nav class="navbar">
        <a href="welcome.php">HOME</a>
        <a href="login.php">LOG IN</a>
        <a href="shop.php">SHOP</a>
        <a href="contactus.php">CONTACT</a>
        <a href="aboutus.php">ABOUT US</a>
    </nav>
    <div class="cart-icons">
                  <a href="cart.php" > <img src="images/cart-icon.png" height="50px" width="50px" ></a> 
                  <span class="quantity">0</span>
        </div>
    
    </header>

  
    <h1>Checkout Page</h1>
  

  <div class="container">
    <form id="checkout-form">
      <label for="name">Name</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>

      <label for="phone">Phone</label>
      <input type="tel" id="phone" name="phone" required>

      <label for="card-number">Card Number</label>
      <input type="text" id="card-number" name="card-number" required>

      <!-- <label for="expiry-date">Expiry Date</label>
      <input type="text" id="expiry-date" name="expiry-date" placeholder="MM/YY" required>

      <label for="cvv">CVV</label>
      <input type="text" id="cvv" name="cvv" required> -->

      <input type="submit" value="Submit">
    </form>
  </div>

  <script>
    // You can add JavaScript for validation or additional functionality here
  </script>
</body>
</html>
