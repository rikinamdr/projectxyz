<?php
global $conn;
require('../dbconnect.php');

$error = $success = $message = "";
$response = 0;
$f_name = $_POST['f_name'];
if ($f_name == "") {
    $message = "First name field is required";
}
$l_name = $_POST['l_name'];
if ($l_name == "") {
    $message = "Last name field is required";
}
$email = $_POST['email'];
if ($email == "") {
    $message = "Email field is required";
}
$userId = $_POST['userId'];
$confirmpassword = $_POST['confirmPassword'];

$password = $_POST['password'];
if ($message) {
    $success = false;
} else {

    if ($userId) {

        $sql = "SELECT * FROM users WHERE email='$email' AND id !='$userId'";

        $result = $conn->query($sql);

        $users = [];

        if ($result->num_rows > 0) {
            $success = false;
            $message = 'Email already exits in our system.';
        } else {
            $sql = "UPDATE users SET f_name='$f_name', l_name='$l_name', email='$email' WHERE id=$userId";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $success = true;
                $message = 'User updated successfully';
            } else {
                $success = false;
                $message = 'Database error';
            }
        }

    } else {
        if ($password != $confirmpassword) {
            $success = false;
            $message = 'Password and Confirm password does not match';
        } else {
            $sql = "SELECT * FROM users where email='$email'";
            $result = $conn->query($sql);

            $users = [];

            if ($result->num_rows > 0) {
                $success = false;
                $message = 'Email already exits in our system.';
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (f_name, l_name, email, password)
         VALUES ('$f_name', '$l_name', '$email', '$hashedPassword')";

                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $success = true;
                    $message = 'User added successfully';
                } else {
                    $success = false;
                    $message = 'Database error';
                }
            }
        }

    }
}

echo json_encode(['success' => $success, 'message' => $message]);
?>