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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home page</title>
    <link rel="stylesheet" href="assets/welcome.css">
    <link rel="stylesheet" href="assets/header.css">
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
                  <a href="cart.php" > <img src="images/cart-icon.png"  ></a> 
                  <span class="quantity">0</span>
            </div>
        
    </header>
    <div class="img">
        
        <div class="img1"><img src="tag.png" height="250px" width="600px" ></div>
        <?php foreach ($products as $key => $product):  ?>
        <div class="img2">
            <?php if (!empty($product['image']) && $key==0): ?>
                    <img  height="250px" width="350px" src="data:image/jpeg;base64,<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                <?php endif; ?>
           </div>
        <?php endforeach; ?>
    </div>
    <div class="product">
        <?php foreach ($products as $key => $product): ?>
        <div class="product<?php echo $key+1;?>">
            <?php if (!empty($product['image']) && $key > 0): ?>
                    <img height="150px" width="150px" src="data:image/jpeg;base64,<?php echo $product['image']; ?>" alt="Product Image">
                <?php endif; ?>
            
            <p><?php echo $product['name'];?></p>
            <p><?php echo $product['price'];?></p>
            <p><?php echo $product['description'];?></p>
            <a href="">Add to cart</a>
        </div>
            <?php if (!empty($product['image']) && $key==0): ?>
                    <img height="250px" width="350px" src="data:image/jpeg;base64,<?php echo $product['image']; ?>" alt="Product Image">
                <?php endif; ?>
           </div>
        <?php endforeach; ?>
        
        <div class="product2">
            <img src="shoe1.JPG" height="150px" width="150px">
            <p>Name</p>
            <p>Price</p>
            <p>description</p>
            <a href="">Add to cart</a>
        </div>
        <div class="product3">
            <img src="shoe1.JPG" height="150px" width="150px">
            <p>Name</p>
            <p>Price</p>
            <p>description</p>
            <a href="">Add to cart</a>
        </div>
        <div class="product4">
            <img src="shoe1.JPG" height="150px" width="150px">
            <p>Name</p>
            <p>Price</p>
            <p>description</p>
            <a href="">Add to cart</a>
        </div>
    </div>
</body>
</html>