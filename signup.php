
<?php 
$success=$error = "";
if($_POST){
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $ph_no = $_POST['ph_no'];
    $password = $_POST['password'];
    $conformPassword = $_POST['confirm-password'];
    if($password != $conformPassword){
            $error="Confirm password didnt match.";
    }else{
       
        require('dbconnect.php');

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // SQL query to insert data into the users table
        $query = "INSERT INTO customers (f_name, l_name,  email, password, address, ph_no) VALUES ('$fname','$lname', '$email', '$hashedPassword', '$address', '$ph_no')";    
        $result = mysqli_query($conn, $query);
        if ($result) {
            $success=  "User data inserted successfully.";
        } else {
            $error =  "Error: " . mysqli_error($conn);
        }
    }    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/sign.css">
    <link rel="stylesheet" href="assets/header.css">
    <title>Signup Page</title>
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
    
    <section class="sign_up">
    
    
    <form method="post" action="signup.php">
    
        <div class="container">
            <h1>SIGN UP</h1>
                <?php
                if($error){
                    ?>
                    <div class="error"><?php echo $error;?></div>
                    <?php
                }
                if($success){
                    ?>
                    <div class="success"><?php echo $success?></div>
                    <?php
                }
            ?>
                <div class="name" >
                    <input type="text" class="fname" name="fname" placeholder="First Name" required>
                    <input type="text" class="lname" name="lname" placeholder="Last Name" required>
                </div>
                <input type="email" placeholder="Email" name="email" required >
                <input type="text" placeholder="Address" name="address" required >
                <input type="number" placeholder="Phone Number" name="ph_no" required >
                <input type="password" placeholder="Password" name="password" required>
                <input type="password" placeholder="Confirm-Password" name="confirm-password" required>
                <input type="submit" id="register" placeholder="submit">
                <!-- <a href="signup.php" id="register">SIGN UP</a> -->
        
                <div class="login">
                    <p>Already have an account? <a href="index.php">LOG IN</a> </p>
                </div>
        
        </div>
    </form>

    </section>
</body>
</html>