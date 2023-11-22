<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONTACT US</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.2/css/fontawesome.min.css" 
    integrity="sha384-X8QTME3FCg1DLb58++lPvsjbQoCT9bp3MsUU3grbIny/3ZwUJkRNO8NPW6zqzuW9" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/contactus.css">
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
                  <a href="cart.php" > <img src="images/cart-icon.png" height="50px" width="50px" ></a> 
                  <span class="quantity">0</span>
        </div>

    </header>
    <section class="contact">
        <div class="content">
            <h2> CONTACT US</h2>
            
        </div>
        <div class="content2">
            <div class="contactinfo">
                <div class="box">
                    <div class="icon"> <i class="fa fa-map-marker" aria-hidden="true"></i></div>
                    <div class="text">
                        <h3> Address</h3>
                        <p> Tinkune,Kathmandu</p>
                    </div>
                </div>
                <div class="box">
                        <div class="icon"> <i class="fa fa-phone" aria-hidden="true"></i></div>
                        <div class="text">
                            <h3> Phone no</h3>
                            <p> 4112252,4112403</p>
                        </div>
                </div>
                <div class="box">
                    <div class="icon"> <i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                    <div class="text">
                        <h3> E-mail</h3>
                        <p> xyz@test.com</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="contactform"> 
            <form action="post">
                <fieldset>
                <legend><h2> Message</h2></legend>
                <div class="inputbox">
                    <label for="name" >Full Name:</label><br>
                    <input type="text" name="fullname" placeholder="Enter your fullname">
                </div>
                <div class="inputbox">
                    <label for="E-mail">E-mail:</label><br>
                    <input type="email" name="email" placeholder="Enter your email">
                </div>
                <div class="inputbox">
                    <label for="message">Message</label><br>
                    <input type="text" class="message" name="message" placeholder="Enter your message">

                </div>
                <div class="inputbox">
                    <br><input type="submit" class="button" value="SEND" onclick="alert('Thank you!!!')">
                </div>
                </fieldset>
            </form>
        </div>
    </section>
</body>
</html>