<?php
global $conn;
require('../dbconnect.php');

$success = false;


parse_str($_POST['formData'], $customerData);


$grandTotal = $_POST['grandTotal'];
$products = $_POST['products'];
$cashOnDelivery = "Cash on Delivery";
$data = [];
if ($customerData['type'] == "add") {
    $email = $customerData['email'];

    $f_name = $customerData['f_name'];
    $l_name = $customerData['l_name'];
    $phone = $customerData['phone'];
    $address = $customerData['address'];
    $password = $customerData['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO customers (f_name, l_name, email, password, address, phone)
         VALUES ('$f_name', '$l_name', '$email', '$hashedPassword','$address',$phone)";

    $customerResult = mysqli_query($conn, $sql);

    if ($customerResult) {
        $customerId = mysqli_insert_id($conn);

        $currentDate = date("Y-m-d");

        $cashOnDelivery = "Cash on Delivery";
        $sql = "INSERT INTO orders (customer_id, total_price, payment_method, order_date)
         VALUES ($customerId, $grandTotal, '$cashOnDelivery', '$currentDate')";

        $orderResults = mysqli_query($conn, $sql);
        $productArrs = [];
        if ($orderResults && $products) {
            $orderId = mysqli_insert_id($conn);
            foreach ($products as $product) {
                $productId = $product['id'];

                $sql = "SELECT * FROM products WHERE id = $productId";
                $result = mysqli_query($conn, $sql);

                $productData = ($result->num_rows > 0) ? $result->fetch_assoc() : [];

                if ($productData) {
                    $name = $productData['name'];
                    $price = $productData['price'];
                    $quantity = $product['quantity'];
                    $total = $productData['price'] * $product['quantity'];

                    $sql = "INSERT INTO order_products (order_id,product_id, price, quantity)
                VALUES ($orderId,$productId, $price, $quantity)";

                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        $productArrs[] = mysqli_insert_id($conn);
                    }
                }

            }

            if ($productArrs) {
                $data = $productArrs;
                $success = true;
                $message = 'Order checkout successfully';
            }
        }

    }
} else {
    $email = $customerData['email'];
    $password = $customerData['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "select * from customers where email = '$email'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        

        if (mysqli_num_rows($result) > 0) {
            $customer = mysqli_fetch_assoc($result);

            // Verify the entered password against the stored hashed password
            if (password_verify($password, $customer['password'])) {

                
                if ($customer) {
                    $customerId = $customer['id'];
                    $currentDate = date("Y-m-d");

                    $cashOnDelivery = "Cash on Delivery";
                    $sql = "INSERT INTO orders (customer_id, total_price, payment_method, order_date)
         VALUES ($customerId, $grandTotal, '$cashOnDelivery', '$currentDate')";

                    $orderResults = mysqli_query($conn, $sql);
                    $productArrs = [];
                    if ($orderResults && $products) {
                        $orderId = mysqli_insert_id($conn);

                        foreach ($products as $product) {
                            $productId = $product['id'];

                            $sql = "SELECT * FROM products WHERE id = $productId";
                            $result = mysqli_query($conn, $sql);

                            $productData = ($result->num_rows > 0) ? $result->fetch_assoc() : [];

                            if ($productData) {
                                $name = $productData['name'];
                                $price = $productData['price'];
                                $quantity = $product['quantity'];
                                $total = $productData['price'] * $product['quantity'];

                                $sql = "INSERT INTO order_products (order_id,product_id, price, quantity)
                VALUES ($orderId,$productId, $price, $quantity)";

                                $result = mysqli_query($conn, $sql);

                                if ($result) {
                                    $productArrs[] = mysqli_insert_id($conn);

                                }
                            }

                        }

                        if ($productArrs) {
                            $data = $productArrs;
                            $success = true;
                            $message = 'Order checkout successfully';
                        }

                    }

                }

            } else {
                $message = "Incorrect email or password";
                $success = false;
            }
        } else {
            $success = false;
            $message = "User not found.Try creating new";
        }

    } else {
        $success = false;
        $message = "Incorrect email or password";
    }

}

echo json_encode(['success' => $success, 'message' => $message]);
?>