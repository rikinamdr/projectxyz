<?php
global $conn;
session_start();
$cart_count = 0;
require('dbconnect.php');
$status = "";
if (isset($_POST['productId']) && $_POST['productId'] != "") {
    $productId = $_POST['productId'];
    $result = mysqli_query(
        $conn,
        "SELECT * FROM `products` WHERE `id`=$productId"
    );
    $row = mysqli_fetch_assoc($result);

    $name = $row['name'];
    $description = $row['description'];
    $price = $row['price'];
    $quantity = $row['quantity'];
    $image = $row['image'];
    $cartArray = array(
        $productId => array(
            'id' => $row['id'],
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'quantity' => 1,
            'maxQuantity' => $quantity,
            'image' => $image
        )
    );

    if (empty($_SESSION["shopping_cart"])) {
        // If the shopping cart is empty, simply set the cartArray
        $_SESSION["shopping_cart"] = $cartArray;
        $status = "<div class='box' id='messageBox'>Product is added to your cart!</div>";
    } else {

        // If the shopping cart is not empty, check if the product already exists
        $cartIds = array_column($_SESSION["shopping_cart"], 'id');

        $existingProduct = in_array($productId, $cartIds);

        if ($existingProduct) {
            // Product already exists in the cart
            $status = "<div class='box'  id='messageBox' style='color:red;'> Product is already added to your cart!</div>";
        } else {
            // Product does not exist in the cart, merge the arrays
            $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"], $cartArray);
            $status = "<div class='box'  id='messageBox'>Product is added to your cart!</div>";
        }
    }
}

function getProducts()
{
    global $conn;
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
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> -->
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
    <?php

    if (!empty($_SESSION["shopping_cart"])) {
        $cart_count = count(array_keys($_SESSION["shopping_cart"]));
    }
    ?>

    <div class="cart-icons">
        <a href="cart.php">
            <button type="button" class="btn btn-success my-2 my-sm-0" data-toggle="modal"
                    data-target="#paymentCartModal">
                <i class="fas fa-shopping-cart total-count">
                    <?php echo $cart_count > 0 ? $cart_count : ''; ?>
                </i>
            </button>
        </a>


    </div>

</header>

<div class="header-container" style="margin-top: 110px;  text-align: center;   margin-bottom: -77px;">
    <h1> Our New Product</h1>
    <p> They are crafted in a variety of designs and patterns.</p>
    <div style="clear:both;"></div>

    <div class="message_box" style="margin:10px 0px;">
        <?php echo $status; ?>
    </div>
</div>
<section id="product1" class="section-p1">

    <div class="pro-container">
        <?php foreach ($products as $key => $product): ?>
            <div class="pro">
                <form action="" method="post">
                    <input type='hidden' name='productId' value="<?php echo $product['id']; ?>"/>
                    <img src="images/products/<?php echo $product['image']; ?>">
                    <div class="des">
                        <h5>
                            <?php echo $product['name']; ?>
                        </h5>

                        <h4>
                            <?php echo $product['description']; ?>
                        </h4>
                        <h4>Rs.
                            <?php echo $product['price']; ?>
                        </h4>

                    </div>

                    <button type="submit" class="default-btn border-radius-5"> Add to cart
                    </button>
                </form>

            </div>
        <?php endforeach; ?>

    </div>
</section>
<!-- <div class="modal fade payment-cart-modal" id="paymentCartModal" data-backdrop="static" data-keyboard="false"
 tabindex="-1" aria-labelledby="paymentCartModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-right" id="staticBackdropLabel">CHECKOUT</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="container container-fluid">
            <div class="row">
                <div class="col-lg-12 "id="message"></div>
            </div>
            <div class="row">

                <div class="col-lg-5">
                    <div class="left-content">

                        <h5 class="modal-title" id="paymentCartDetailsModalLabel">Shipping details</h5>
                        <form id="accountOptionsForm">

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="accountOption"
                                       id="existingAccount" value="existing" checked>
                                <label class="form-check-label" for="existingAccount">
                                    Already have an account
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="accountOption" id="newAccount"
                                       value="new">
                                <label class="form-check-label" for="newAccount">
                                    Create a new account
                                </label>
                            </div>
                        </form>
                        <div id="existingAccountForm" style="display:block;">

                            <form id="form1">
                                <div class="form-group">
                                    <div class="input-box">
                                        <input type="hidden" name="type" value="update">
                                        <label for="inputEmail">Enter your Email address:</label>
                                        <input type="email" class="form-control" id="inputEmail" name="email"
                                               required>
                                    </div>
                                    <div class="input-box">
                                        <label for="password">Enter your Password:</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                               required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary checkoutButton">Checkout</button>
                            </form>
                        </div>

                        <div id="newAccountForm" style="display:none;">

                            <form method="POST" class="container" id="form2">
                                <h5>Account</h5>
                                <div class="form-group">
                                    <div class="input-content">
                                        <div class="input-box">
                                            <input type="hidden" name="type" value="add">
                                            <input type="text" placeholder="First name" name="f_name" d="f_name"
                                                   required class="form-control">
                                            <i class="bi bi-person-fill icon"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-content">
                                        <div class="input-box">
                                            <input type="text" placeholder="Last name" name="l_name" id="l_name"
                                                   required class="form-control">
                                            <i class="bi bi-person-fill icon"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-content">
                                        <div class="input-box">
                                            <input type="email" placeholder="Email Address" required name="email"
                                                   class="form-control">
                                            <i class="bi bi-envelope-at-fill icon"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-content">
                                        <div class="input-box">
                                            <input type="password" id="form2password" placeholder="Password" name="password" required
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-content">
                                        <div class="input-box">
                                            <input type="password" placeholder="Confirm Password" name="confirm_password" required equalTo="#form2password" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-content">
                                        <div class="input-box">
                                            <h5>Payment Details</h5>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="pm1" name="pay" checked
                                                       class="custom-control-input">
                                                <label class="custom-control-label" for="pm1">
                                                <span>
                                                    <i class="bi bi-wallet-fill"></i>
                                                    Cash on Delivery
                                                </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-content">
                                        <div class="input-box">
                                            <input type="text" placeholder="Address" name="address" required
                                                   class="form-control">
                                            <i class="bi bi-envelope-at-fill icon"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-content">
                                        <div class="input-box">
                                            <input type="number" placeholder="Phone Number" name="phone" required
                                                   class="form-control">
                                            <i class="bi bi-envelope-at-fill icon"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-content">
                                        <div class="input-box">
                                            <button type="submit" class="btn btn-primary checkoutButton">Checkout
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="col-lg-7">
                    <div class="right-content">

                        <h5 class="modal-title" id="paymentCartDetailsModalLabel">Cart Details</h5>
                        <p></p>
                        <table class="table">
                            <thead>
                            <td> Product</td>
                            <td> Price</td>
                            <td> Qty</td>

                            <td>Total</td>
                            <td>Action</td>

                            </thead>
                        </table>
                        <table class="show-cart table">

                        </table>
                        <div class="grand-total text-right" style="margin-right: 65px">Total price: ₹<span
                                    class="total-cart"></span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
    </div>
</div>
</div> -->
<!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
<!-- <script src="assets/shop.js"></script> -->


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script> -->

</body>

</html>
<script>
    // Get a reference to the div
    var myDiv = document.getElementById('messageBox');

    // Display the div
    myDiv.style.display = 'block';

    // Set a timeout to hide the div after 5000 milliseconds (5 seconds)
    setTimeout(function () {
        myDiv.style.display = 'none';
    }, 5000);
</script>