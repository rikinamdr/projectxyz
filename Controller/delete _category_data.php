<?php
global $conn;
$error = $success = "";
$sql = "";

require('../dbconnect.php');


$categoryId = isset($_GET['id']) ? $_GET['id'] : null;

$sql = "DELETE FROM category WHERE id=$categoryId";
$result = mysqli_query($conn, $sql);

echo $result

?>