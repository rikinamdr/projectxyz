<?php
global $conn;
$error = $success = "";
$sql = "";

require('../dbconnect.php');

$categoryId = isset($_GET['id']) ? $_GET['id'] : null;

$sql = "SELECT * FROM categorys WHERE id = $categoryId";
$result = mysqli_query($conn, $sql);
$categorys = [];
//return ($result->num_rows > 0) ? $result->fetch_assoc() : null;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categorys = $row;
    }
    echo json_encode($categorys);
} else {
    echo "No category data found";
}

?>