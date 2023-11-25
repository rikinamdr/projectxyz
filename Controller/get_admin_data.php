<?php
global $conn;
$error = $success = "";
$sql = "";

require('../dbconnect.php');

$userId = isset($_GET['id']) ? $_GET['id'] : null;

$sql = "SELECT * FROM users WHERE id = $userId";
$result = mysqli_query($conn, $sql);
$users = [];
//return ($result->num_rows > 0) ? $result->fetch_assoc() : null;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users = $row;
    }
    echo json_encode($users);
} else {
    echo "No user data found";
}

?>