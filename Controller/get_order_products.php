<?php
global $conn;
$error = $success = "";
$sql = "";

require('../dbconnect.php');

$orderId = isset($_POST['order_id']) ? $_POST['order_id'] : null;
$sql = "SELECT 
    orders.id AS order_id,
    orders.total_price,
    orders.order_date,
    orders.status,
    orders.delivery_date,
    products.name,
    order_products.quantity,
    order_products.price
FROM 
    orders
JOIN 
    order_products ON orders.id = order_products.order_id 
JOIN 
    products ON order_products.product_id = products.id 
WHERE 
    orders.id = $orderId";

$result = mysqli_query($conn, $sql);
$order = [];
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Append each product to the order array
        $order['order_id'] = $row['order_id'];
        $order['total_price'] = $row['total_price'];
        $order['order_date'] = $row['order_date'];
        $order['status'] = $row['status'];
        $order['delivery_date'] = $row['delivery_date'];


        // Check if the 'products' key is already present in $order
        if (!isset($order['products'])) {
            $order['products'] = [];
        }

        // Append product details to the 'products' array
        $order['products'][] = [
            'product_name' => $row['name'],
            'quantity' => $row['quantity'],
            'price' => $row['price']
        ];
    }
    echo json_encode($order);
} else {
    echo json_encode(['error' => 'No order data found']);
}

?>