<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>payment</title>
   <link href="assets/payment.css" rel="stylesheet">
   <link href="assets/header.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>

<body>
    <?php include ('header.php')?>
    <div class="top">
        <h2>Payment form</h2>
        <form method="POST">
            <h4>Account</h4>
            <div class="input-content">
                <div class="input-box">
                    <input type="text" placeholder="Full name" required class="name">
                    <i class="bi bi-person-fill icon"></i>
                </div>
            </div> 
            <div class="input-content">
                <div class="input-box">
                    <input type="text" placeholder="Email Address" required class="name">
                    <i class="bi bi-envelope-at-fill icon"></i>
                </div>
            </div>

            <div class="input-content">
                <div class="input-box">
                     <h4>Payment Details</h4>
                     <input type="radio" name="pay" id="pm1" checked class="radio">
                     <label for="pm1">
                     <span>
                         <i class="bi bi-wallet-fill"></i>
                         Cash on Delivery
                     </span>
                 </label>
                 <input type="radio" name="pay" id="pm2" class="radio">
                 <label for="pm2">
                    <span>
                        <i class="bi bi-credit-card-fill"></i>
                        Credit card
                    </span>
                 </label>

                </div> 
             </div> 
             <div class="input-content">
                <div class="input-box">
                    <input type="text" placeholder="Your address" required class="name">
                </div>
             </div>
             <div class="input-content">
                <div class="input-box">
                    <input type="text" placeholder="Phone Number" required class="name">
                    <i class="bi bi-telephone icon"></i>
                </div>
             </div>
             <div class="input-content">
                <div class="input-box">
                   <!-- <button type="submit" onclick="myFunction()">Proceed to Checkout</button>  -->
                   <a href="thankyou.php" class="button">Confirm Order</a>
                </div>
             </div>

        </form>
    </div>
</body>
<!-- <script>
    myFunction(){
        windows.location.href="thankyou.php"
    }
</script> -->
    
</html>