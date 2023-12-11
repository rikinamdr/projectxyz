<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/shoppingcart.css">
    <link rel="stylesheet" href="assets/header.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
        }

        .container {
            display: flex;
            max-width: 800px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .left-side,
        .right-side {
            flex: 1;
            padding: 20px;
        }

        .left-side {
            background-color: #fff; /* Change background color as needed */
        }

        .right-side {
            background-color: #fff;
        }

        .shipping {
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
        }

        input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
    <title>Customer Details</title>
</head>
<body>
<header class="header">
    <a href="#" class="logo">XYZshoe</a>

    <nav class="navbar">
        <a href="home.html">HOME</a>
        <a href="login.html">LOG IN</a>
        <a href="shop.html">SHOP</a>
        <a href="contactus.html">CONTACT</a>
        <a href="aboutus.html">ABOUT US</a>
    </nav>


</header>
<div class="container">
    <div class="left-side">
        <div class="shipping">
            <h2>Already have an account</h2>
            <form id="form1" onsubmit="validateForm1()">
                <h2>Form 1</h2>
                <label for="email1">Enter your Email address:</label><br>
                <input type="email" id="email1" class="email"><br><br>
                <label for="password1">Enter your Password:</label><br>
                <input type="password" id="password1" class="password">
                <button type="submit">Submit Form 1</button>
            </form>
        </div>
    </div>
    <div class="right-side">
        <form action="#" method="post" id="accountForm">
            <h2>Create an Account</h2>
            <div class="form-group" id="form2">
                <h2>Form 2</h2>
                <label for="firstName">First Name:</label><br>
                <input type="text" id="firstName" placeholder="First Name" class="form2"><br><br>
                <label for="lastName">Last Name:</label><br>
                <input type="text" id="lastName" placeholder="Last Name" class="form2"><br><br>
                <label for="email2">Email Address:</label><br>
                <input type="email" id="email2" placeholder="Email Address" class="form2"><br><br>
                <label for="password2">Password:</label><br>
                <input type="password" id="password2" placeholder="Password" class="form2"><br><br>
                <label for="confirmPassword">Confirm Password:</label><br>
                <input type="password" id="confirmPassword" placeholder="Confirm Password" class="form2"><br><br>
                <label for="address">Address:</label><br>
                <input type="text" id="address" placeholder="Address" class="form2"><br><br>
                <label for="phone_number">Phone Number:</label><br>
                <input type="text" id="phone_number" placeholder="Phone Number" class="form2"><br><br>
                <button type="button" onclick="validateForm2()">Submit Form 2</button>
            </div>
        </form>
    </div>
</div>

<!--<div class="container1">-->
<!---->
<!--    <div class="shipping">-->
<!--        <h2> Delivery details</h2>-->
<!--        <input type="radio" name="formSelector" value="form1" onclick="toggleForm('form1')">-->
<!--        <label>Already have an account</label><br>-->
<!--        <input type="radio" name="formSelector" value="form2" onclick="toggleForm('form2')">-->
<!--        <label>Create a new account</label>-->
<!--    </div>-->
<!---->
<!--    <div id="form1" class="form-group">-->
<!---->
<!--        <form onsubmit="validateForm1()">-->
<!--            <h2>Form 1</h2>-->
<!--            <label>Enter your Email address:</label><br>-->
<!--            <input type="email" id="email" class="email"><br><br>-->
<!--            <label>Enter your Password:</label><br>-->
<!--            <input type="password" id="password" class="password">-->
<!--        </form>-->
<!--    </div>-->
<!---->
<!---->
<!--    <div id="form2" class="form-group">-->
<!---->
<!--        <form onsubmit="validateForm2()">-->
<!--            <h2>Form 2</h2>-->
<!--            <input type="text" id="firstName" placeholder="First Name" class="form2"><br><br>-->
<!--            <input type="text" id="lastName" placeholder="Last Name" class="form2"><br><br>-->
<!--            <input type="email" id="email" placeholder="Email Address" class="form2"><br><br>-->
<!--            <input type="password" id="password" placeholder="Password" class="form2"><br><br>-->
<!--            <input type="password" id="confirmPassword" placeholder=" Confirm Password" class="form2"><br><br>-->
<!--            <input type="text" id="address" placeholder="Address" class="form2"><br><br>-->
<!--            <input type="text" id="phone_number" placeholder="Phone Number" class="form2"><br><br>-->
<!---->
<!--        </form>-->
<!--    </div>-->
<!---->
<!--    <br>-->
<!--    <button class="button1" onclick="navigatefromcheckout('Payment.html')"> Checkout</button><br><br>-->
<!--</div>-->
<script src="assets/cart.js"></script>
</body>
</html>