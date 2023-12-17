<?php
global $conn;
$error = $success = "";
$sql = "";

require('../dbconnect.php');

$customerId = isset($_GET['id']) ? $_GET['id'] : null;

$sql = "SELECT * FROM customers WHERE id = $customerId";
$result = mysqli_query($conn, $sql);
$customers = [];
//return ($result->num_rows > 0) ? $result->fetch_assoc() : null;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $customers = $row;
    }
    echo json_encode($customers);
} else {
    echo "No customer data found";
}

?>