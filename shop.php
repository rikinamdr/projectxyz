<?php
function getProducts()
{
    global $conn;
    require('dbconnect.php');
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    $products = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    return $products;
}
$products = getProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/shop.css">
    <link rel="stylesheet" href="assets/cart.css">
    <link rel="stylesheet" href="assets/header.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.6.0/css/all.min.css">
  
    <title>product Page</title>
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
        <button type="button" class="btn btn-success my-2 my-sm-0" data-toggle="modal"
               data-target="#staticBackdrop">
                <i class="fas fa-shopping-cart total-count"></i>
            </button>
        
                  <!-- <a href="cart.php" > <img src="images/cart-icon.png"  ></a> 
                  <span class="quantity">0</span> -->
            </div>
        
    </header>
        
    <section id="feature" class="section-p1">
         </section>

    <section id="product1" class="section-p1">
         <h1> Our New Product</h1>
        <p> They are crafted in a variety of designs and patterns.</p>
        
       
        <div class="pro-container">
            <?php foreach ($products as $key => $product): ?>
            <div class="pro">
                <img src="images/products/<?php echo $product['image']; ?>">
                <div class="des">
                    <h5> <?php echo $product['name'];?></h5>
        
                    <h4><?php echo $product['description'];?></h4>
                    <h4>Rs.<?php echo $product['price'];?></h4>

                </div>
                <!-- <button onclick="addToCart(1)">Add to Cart</button> -->
                <button type="button" data-name="<?php echo $product['name'];?>" data-id="<?php echo $product['id'];?>"  data-image="images/products/<?php echo $product['image'];?>"  data-price="<?php echo $product['price'];?>" class="default-btn border-radius-5"> Add to cart</button>
            </div>
            <?php endforeach; ?>


                
   </section>
   <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Your Cart</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <table class="show-cart table">
        
                  </table>
                  <div class="grand-total">Total price: ₹<span class="total-cart"></span></div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <a href="payment.php" class="btn btn-secondary">Checkout</a>
                  <!-- <button type="button" class="btn btn-danger clear-all">Clear All</button> -->
                </div>
            </div>
         </div>
      </div>
<script src="assets/script.js"></script>

<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
   <script src="script.js"></script>

</body>
</html>


