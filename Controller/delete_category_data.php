<?php
global $conn;
$error = $success = "";
// $sql = "";

require('../dbconnect.php');


$categoryId = isset($_GET['id']) ? $_GET['id'] : null;


$sql = "DELETE FROM category WHERE id=$categoryId";
$result = mysqli_query($conn, $sql);
if ($result) {
    $success = true;
    $message = 'Category deleted successfully';
} else {
    $success = false;
    $message = 'Database error';
}
echo json_encode(['success' => $success, 'message' => $message]);
?>