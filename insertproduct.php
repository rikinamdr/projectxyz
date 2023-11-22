<?php
// dashboard.php

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Now you can access session data
$userID = $_SESSION['user_id'];
$userName = $_SESSION['user_name'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="grid-container">
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>
            <div class="header-left">
                <span class="material-icons-outlined">search</span>
            </div>
            <div class="header-right">
                <span class="material-icons-outlined">notifications</span>
                <span class="material-icons-outlined">email</span>
                <span class="material-icons-outlined">account_circle</span>
            </div>
        </header>

        <aside id="sidebar">
            <div class="sidebar-title">
                <div class="sidebar-brand">
                    <span class="material-icons-outlined">account_circle</span>
                    <?php echo $userName; ?>
                </div>
                <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
            </div>

            <ul class="sidebar-list tab">
                <li class="sidebar-list-item tablinks" onclick="openCity(event, 'dashboard')">
                    <span class="material-icons-outlined ">dashboard</span> Dashboard
                </li>
                <li class="sidebar-list-item tablinks" onclick="openCity(event, 'Products')">
                    <span class="material-icons-outlined">inventory_2</span> Products
                </li>
                <li class="sidebar-list-item tablinks" onclick="openCity(event, 'purchaseOrder')">
                    <span class="material-icons-outlined">add_shopping_cart</span> Purchase Orders
                </li>
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">shopping_cart</span> Sales Orders
                </li>
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">poll</span> Reports
                </li>
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">settings</span>Settings
                </li>
            </ul>
        </aside>
        
            <main class="main-container">
            <div id="dashboard" class="tabcontent">
                <div class="main-title">
                    <p class="font-weight-bold">OVERVIEW</p>
                </div>
                <div class="main-cards">
                    <div class="card">
                        <div class="card-inner">
                            <p class="text-primary">PRODUCTS</p>
                            <span class="material-icons-outlined text-blue">inventory_2</span>
                        </div>
                        <span class="text-primary font-weight-bold">249</span>
                    </div>

                    <div class="card">
                        <div class="card-inner">
                            <p class="text-primary">PURCHASE ORDERS</p>
                            <span class="material-icons-outlined text-orange">add_shopping_cart</span>
                        </div>
                        <span class="text-primary font-weight-bold">83</span>
                    </div>

                    <div class="card">
                        <div class="card-inner">
                            <p class="text-primary">SALES ORDERS</p>
                            <span class="material-icons-outlined text-green">shopping_cart</span>
                        </div>
                        <span class="text-primary font-weight-bold">79</span>
                    </div>

                    <div class="card">
                        <div class="card-inner">
                            <p class="text-primary">NOTIFICATIONS</p>
                            <span class="material-icons-outlined text-red">notification_important</span>
                        </div>
                        <span class="text-primary font-weight-bold">56</span>
                    </div>
                </div>
        </div>

        <div id="Products" class="tabcontent">
           
            <div class="main-title">
                    <p class="font-weight-bold">PRODUCTS</p>

                    <p  class="font-weight-bold tablinks" onclick="openCity(event, 'addProductPage')">Add product</a >
                </div>
                <div class="main-cards">
                    
                </div>
        </div>

        <div id="purchaseOrder" class="tabcontent">
            <h3>purchaseOrder</h3>
            <p>Tokyo is the capital of Japan.</p>
        </div>
        <div id="addProductPage" class="tabcontent">
        
        </div>


        <script src="admin.js"></script>


</body>

</html>

