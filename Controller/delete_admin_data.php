<?php
global $conn;
$error = $success = "";
$sql = "";

require('../dbconnect.php');


$adminId = isset($_GET['id']) ? $_GET['id'] : null;

$sql = "DELETE FROM users WHERE id=$adminId";
$result = mysqli_query($conn, $sql);

if ($result) {
    $success = true;
    $message = 'User deleted successfully';
} else {
    $success = false;
    $message = 'Database error';
}
echo json_encode(['success' => $success, 'message' => $message]);
?>