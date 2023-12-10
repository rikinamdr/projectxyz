<?php
global $conn;
require('../dbconnect.php');

$error = $success = $message = "";
$status = $_POST['status'];
$orderId = $_POST['orderId'];
$date =  date("Y-m-d");

$sql = "UPDATE orders SET status=$status, delivery_date='$date' WHERE id=$orderId";
$result = mysqli_query($conn, $sql);


if ($result) {
    $success = true;
    $message = 'Order delivered successfully';
} else {
    $success = false;
    $message = 'Database error';
}
echo json_encode(['success' => $success, 'message' => $message]);
?>