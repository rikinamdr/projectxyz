<?php
global $conn;
$error = $success = "";
$sql = "";
function getOrders()
{
    global $conn;
    require('dbconnect.php');
    $sql = "SELECT orders.*, customers.f_name as customer_name FROM orders JOIN customers ON orders.customer_id = customers.id order by created_at desc";
    $result = $conn->query($sql);

    $orders = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
    }

    return $orders;
}
$orders = getOrders();

function getOrder($id)
{
    global $conn;
    require('dbconnect.php');
    $sql = "SELECT * FROM orders WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    return ($result->num_rows > 0) ? $result->fetch_assoc() : null;
}
?>


<div id="message">
    <?php
    if ($error) {
        ?>
        <div class="error">
            <?php echo $error; ?>
        </div>
        <?php
    }
    if ($success) {
        ?>
        <div class="success">
            <?php echo $success ?>
        </div>
        <?php
    }
    ?>
</div>
<div>
    <div class="main-title">
        <p class="font-weight-bold">Order</p>

    </div>
    <div class="cards" id="orderList">
        <table>
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Customer</th>
                    <th>Payment Method</th>
                    <th>Total Price</th>
                    <th>Ordered date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($orders as $key => $order): ?>
                    <tr id="table-<?php echo $order['id']; ?>">
                        <td>
                            <?php echo $key + 1; ?>
                        </td>

                        <td>
                            <?php echo $order['customer_name']; ?>
                        </td>
                        <td>
                            <?php echo $order['payment_method']; ?>
                        </td>
                        <td>
                            <?php echo $order['total_price']; ?>
                        </td>
                        <td>
                            <?php echo $order['order_date']; ?>
                        </td>
                        <td>
                            <?php echo $order['status']==1?"Delivered":"Pending"; ?>
                        </td>
                        <td class="action-buttons">
                            
                            <button data-id="<?php echo $order['id']; ?>" class="showOrderDetails">View</button>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="orderDetailsPopup" #2196F3role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jsonModalLabel">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- Container for displaying JSON data in the modal -->
                <div id="jsonDataContainer">
                    <!-- JSON data will be inserted here dynamically -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
    .cards {
        margin-top: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        overflow-x: auto;

    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .action-buttons form,
    .action-buttons button {
        display: inline;
        padding: 5px 10px;
        margin-right: 5px;
        text-decoration: none;
        color: #fff;
        cursor: pointer;
    }

    #orderList {
        display: block;

    }

    #addEditOrderForm {
        display: none;
        margin-top: 20px;
    }

    select {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 4px;
        cursor: pointer;
        margin-bottom: 20px;
    }


    select:hover {
        border-color: #555;
    }

    select:focus {
        outline: none;
        border-color: #2196F3;
    }
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>

    function closeSuccessMessage(button) {
        const successMessageDiv = button.closest('.alert');
        if (successMessageDiv) {
            successMessageDiv.remove();
        }
    }

    $(document).ready(function () {
        $('#orderDetailsPopup').modal('hide');
        
        $(".showOrderDetails").on("click", function (e) {
            e.preventDefault();
            // Get the order ID 
            var orderId = $(this).attr('data-id');

            // Make an AJAX request to fetch order details
            $.ajax({
                url: "Controller/get_order_products.php",
                method: "POST",
                data: { order_id: orderId },
                dataType: "json",
                success: function (response) {
                    var jsonDataContainer = $('#jsonDataContainer');
                    jsonDataContainer.empty();
                    // Update the content of the popup with the order details
                    displayOrderDetails((response));
                    console.log(response);
                    // Show the popup
                    $('#orderDetailsPopup').modal('show');
                    $(".deliver-button").on("click", function (e) {
            e.preventDefault();
            // Get the order ID 
            var orderId = $(this).attr('data-id');

            // Make an AJAX request to fetch order details
            $.ajax({
                url: "Controller/change_order_status.php",
                method: "POST",
                data: { orderId: orderId, status: 1 },
                dataType: "json",
                success: function (response) {
                    console.log(response);
                   
                    $('#message').empty();
                     // Display success message with a close button
                     var successMessage = $('<div>').text('Order  has been delivered!').addClass('success-message');
                        var closeButton = $('<button>').text('Close').addClass('close-button');
                        $('#message').append(closeButton);
                        $('#message').append(successMessage);
                        location.reload();
                },
                error: function () {
                    console.log("Error fetching order details.");
                }
            });
        });
                },
                error: function () {
                    console.log("Error fetching order details.");
                }
            });
        });

       

        

        function displayOrderDetails(orderDetails) {
            var orderDetailsContainer = $('#jsonDataContainer');

            // Clear previous content
            orderDetailsContainer.empty();

            orderDetailsContainer.append('<div id="message"></div>');

            orderDetailsContainer.append('<p><strong>Order ID:</strong> ' + orderDetails.order_id + '</p>');
            orderDetailsContainer.append('<p><strong>Order Date:</strong> ' + orderDetails.order_date + '</p>');
            orderDetailsContainer.append('<p><strong>Total Price:</strong>  ' + parseFloat(orderDetails.total_price).toFixed(2) + '</p>');
            
            orderDetailsContainer.append('<p><strong>Order status:</strong> ' + (orderDetails.status == 1 ? 'Delivered' : 'Pending') + '</p>');
            if(orderDetails.status == 1){
                orderDetailsContainer.append('<p><strong>Delivery date:</strong> ' + orderDetails.delivery_date + '</p>');

            }else{
                var deliveredButton = $('<button>').text('Delivered').addClass('deliver-button').attr('data-id', orderDetails.order_id);
                orderDetailsContainer.append("Click on the button to deliver order:");
                orderDetailsContainer.append(deliveredButton);    
            }

                console.log('Pending');

            
            orderDetailsContainer.append('<h2>Products</h2>');
            if (orderDetails.products && orderDetails.products.length > 0) {
                var table = $('<table>').addClass('product-table');
                var headerRow = $('<tr>').append(
                    $('<th>').text('Product Name'),
                    $('<th>').text('Quantity'),
                    $('<th>').text('Price')
                );
                table.append(headerRow);

                // Iterate through each product in the order
                orderDetails.products.forEach(function (product) {
                    var row = $('<tr>').append(
                        $('<td>').text(product.product_name),
                        $('<td>').text(product.quantity),
                        $('<td>').text('$' + parseFloat(product.price).toFixed(2))
                    );
                    table.append(row);
                });

                orderDetailsContainer.append(table);
            } else {
                orderDetailsContainer.append('<p>No products found for this order.</p>');
            }
        }
    });
</script>