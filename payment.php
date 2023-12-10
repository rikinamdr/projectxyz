<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-5">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>paymentmethod</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="assets/payment.css">
    </head>
    <body>

        <div class="container">
            <div class="title">
                <h4>Select a <span style="color: rgb(144, 5, 123)">Payment </span>method</h4>
            </div>

            <form action="#">
                <input type="radio" name="payment" id="card">
                <input type="radio" name="payment" id="cash">
                <input type="radio" name="payment" id="paypal">
                <input type="radio" name="payment" id="esewa">

                <div class="category">
                    <label for="card" class="cardMethod">
                        <div class="imgname">
                            <div class="imgcontainer card">
                                <img src="assets/visa.png" alt="">
                            </div>
                            <span class="name">Credit Card</span>
                        </div>
                        <span class="check"><i class="fa-sharp fa-solid fa-circle-check" style="color: #6064b6;"></i></span>
                    </label>
                    <label for="cash" class="cashMethod">
                        <div class="imgname">
                            <div class="imgcontainer cash">
                                <img src="assets/cash.png" alt="">
                            </div>
                            <span class="name">Cash on Delivery</span>
                        </div>
                        <span class="check"><i class="fa-sharp fa-solid fa-circle-check" style="color: #6064b6;"></i></span>
                    </label>
                    <label for="paypal" class="paypalMethod">
                        <div class="imgname">
                            <div class="imgcontainer paypal">
                                <img src="assets/paypal.png" alt="">
                            </div>
                            <span class="name">Paypal</span>
                        </div>
                        <span class="check"><i class="fa-sharp fa-solid fa-circle-check" style="color: #6064b6;"></i></span>
                    </label>
                    <label for="esewa" class="esewaMethod">
                        <div class="imgname">
                            <div class="imgcontainer esewa">
                                <img src="assets/esewa.png" alt="">
                            </div>
                            <span class="name">Esewa</span>
                        </div>
                        <span class="check"><i class="fa-sharp fa-solid fa-circle-check" style="color: #6064b6;"></i></span>
                    </label>
                </div>

                <div class="confirm">
                    <button><a href="thankyou.php">Confirm</a></button>
                    <!-- <a href="thankyou.php" class="button"> Confirm </a> -->
                </div>    
            </form>
        </div>
    </body>
    