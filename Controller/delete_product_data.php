<?php
global $conn;
$error = $success = "";
$sql = "";

require('../dbconnect.php');


$productId = isset($_GET['id']) ? $_GET['id'] : null;

$sql = "DELETE FROM products WHERE id=$productId";
$result = mysqli_query($conn, $sql);

echo $result

?>