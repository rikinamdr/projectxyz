<?php
global $conn;
$error = $success = "";
$sql = "";

require('../dbconnect.php');




$productId = isset($_GET['id']) ? $_GET['id'] : null;


$sql = "UPDATE products SET is_deleted=1 WHERE id=$productId";
$result = mysqli_query($conn, $sql);
//print_r($sql);die('11222');
echo $result;
?>