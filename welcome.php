<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>home page</title>
        <link rel="stylesheet" href="assets/newhome.css">
        <link rel="stylesheet" href="assets/header.css">
    </head>

    <body>
    <?/*php include ('header.php'*/ ?>
        <header class="header">
            <a href="#" class="logo">XYZshoe</a>

            <nav class="navbar">
                <a href="welcome.php">HOME</a>
                <a href="index.php">LOG IN</a>
                <a href="shop.php">SHOP</a>
                <a href="contactus.php">CONTACT</a>
                <a href="aboutus.php">ABOUT US</a>
            </nav>
            

        </header>
        <div class="top">
            <div class="content">
                <h1>Step into style, Stride with confidence</h1>
                <h3> Your Sole Destination for Trendsetting Footwear!</h3>
                <button>Explore</button>
            </div>
        </div>
        <div class="category">
            <div class="title">
                <h1>Category</h1>
            </div>
            <div class="product">
                <div class="card">
                    <img src="images/m6.jpg" alt="">
                    <p>Fancy</p>
                    
                </div>
                <div class="card">
                    <img src="images/s1.png" alt="">
                    <p>Casual</p>
                    
                </div>
                <div class="card">
                    <img src="images/m4.jpg" alt="">
                    <p>Formal</p>
                    
                </div>
            </div>
        </div>
        <div class="popular">
            <div class="title">
                <h1>Popular</h1>
            </div>
            <div class="product1">
                <div class="card">
                    <img src="images/m2.jpg" alt="">
                    <p>Name</p>
                    
                </div>
                <div class="card">
                    <img src="images/m5.jpg" alt="">
                    <p>Name</p>
                    
                </div>
                <div class="card">
                    <img src="images/m7.jpg" alt="">
                    <p>Name</p>
                    
                </div>
            </div>
        </div>
        <div class="new">
            <div class="title">
                <h1>New Products</h1>
            </div>
            <div class="product2">
                <div class="card">
                    <img src="images/m8.jpg" alt="">
                    <p>Name</p>
                    
                </div>
                <div class="card">
                    <img src="images/s2.png" alt="">
                    <p>Name</p>
                    
                </div>
                <div class="card">
                    <img src="images/m10.jpg" alt="">
                    <p>Name</p>
                    
                </div>
            </div>
        </div>
        <div class="foot">
            <?php include ('footer.php') ?>
        </div>
        
    </body>

</html>