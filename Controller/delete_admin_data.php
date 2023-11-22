<?php
global $conn;
$error = $success = "";
$sql = "";

require('../dbconnect.php');


$adminId = isset($_GET['id']) ? $_GET['id'] : null;

$sql = "DELETE FROM users WHERE id=$adminId";
$result = mysqli_query($conn, $sql);

echo $result

?>