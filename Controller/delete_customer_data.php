<?php
global $conn;
$error = $success = "";
$sql = "";

require('../dbconnect.php');



$customerId = isset($_GET['id']) ? $_GET['id'] : null;

$sql = "UPDATE customers SET is_deleted=1 WHERE id=$customerId";
$result = mysqli_query($conn, $sql);

echo $result;

?>