<?php
global $conn;
$error = $success = "";
$sql = "";

require('../dbconnect.php');

$productId = isset($_GET['id']) ? $_GET['id'] : null;

$sql = "SELECT * FROM products WHERE id = $productId and is_deleted=0";
$result = mysqli_query($conn, $sql);
$products = [];
//return ($result->num_rows > 0) ? $result->fetch_assoc() : null;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products = $row;
    }
    echo json_encode($products);
} else {
    echo "No product data found";
}

?>