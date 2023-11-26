<?php
global $conn;
require('../dbconnect.php');

$error = $success = $message = "";
$response = 0;
$name = $_POST['name'];
if ($name == "") {
    $message = " Name field is required";
}


$categoryId = $_POST['categoryId'];
$description = $_POST['description'];

// $password = $_POST['password'];
if ($message) {
    $success = false;
} else {

    if ($categoryId) {

        $sql = "SELECT * FROM category WHERE name='$name' AND id !='$categoryId'";

        $result = $conn->query($sql);

        $category = [];

        
            $sql = "UPDATE category SET name='$name', description='$description' WHERE id=$categoryId";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $success = true;
                $message = 'Category updated successfully';
            } else {
                $success = false;
                $message = 'Database error';
            }
        

    } else {
        // if ($password != $confirmpassword) {
        //     $success = false;
        //     $message = 'Password and Confirm password does not match';
        // } else {
            $sql = "SELECT * FROM category where name='$name'";
            $result = $conn->query($sql);

            $category = [];

            if ($result->num_rows > 0) {
                $success = false;
                $message = 'This category already exits in our system.';
            } else {
               
                $sql = "INSERT INTO category (name, description)
         VALUES ('$name', '$description')";

                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $success = true;
                    $message = 'Category added successfully';
                } else {
                    $success = false;
                    $message = 'Database error';
                }
            }
        // }

    }
}

echo json_encode(['success' => $success, 'message' => $message]);
?>