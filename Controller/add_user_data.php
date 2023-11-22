<?php

$error = $success = "";
$response=0;
$f_name = $_POST['f_name'];
$l_name = $_POST['l_name'];
$email = $_POST['email'];
$confirmpassword = $_POST['confirmPassword'];

$password = $_POST['password'];
if ($password == $confirmpassword) {
    $response=0;
    $error = 'Password and Confirm password does not match';
} else {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    require('dbconnect.php');
    $sql = "INSERT INTO users (f_name, l_name, email, password)
         VALUES ('$f_name', '$l_name', '$email', '$hashedPassword')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $response=1;
    } else {
        $response=0;
        // $error = "Something went wrong.Please try again.";
    }
    
    echo $response;
}
?>