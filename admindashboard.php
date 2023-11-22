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
<?php
$activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'dashboards';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-5">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>admindashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <link rel="stylesheet" href="assets/admin.css">
    <style>


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
                <li class="sidebar-list-item tablinks <?php echo ($activeTab == 'dashboards') ? 'active' : ''; ?>"><a class="text-primary" href="?tab=dashboards" ><span
                            class="material-icons-outlined ">dashboard</span> Dashboard</a></li>
                <li class="sidebar-list-item tablinks <?php echo ($activeTab == 'products') ? 'active' : ''; ?>"><a class="text-primary" href="?tab=products" ><span
                            class="material-icons-outlined">inventory_2</span> Products</a></li>
                <li class="sidebar-list-item tablinks <?php echo ($activeTab == 'customers') ? 'active' : ''; ?>"><a class="text-primary" href="?tab=customers"><span
                            class="material-icons-outlined">add_shopping_cart</span> Customer</a></li>
                <li class="sidebar-list-item tablinks <?php echo ($activeTab == 'categories') ? 'active' : ''; ?>"><a class="text-primary" href="?tab=categories"><span
                            class="material-icons-outlined">add_shopping_cart</span> Category</a></li>
                <li class="sidebar-list-item tablinks <?php echo ($activeTab == 'admins') ? 'active' : ''; ?>"><a class="text-primary" href="?tab=admins"><span
                            class="material-icons-outlined">add_shopping_cart</span> Admins</a></li>
                    
                <li class="sidebar-list-item tablinks <?php echo ($activeTab == 'purchaseOrder') ? 'active' : ''; ?>"><a class="text-primary" href="?tab=purchaseOrder"><span
                            class="material-icons-outlined">add_shopping_cart</span> Purchase Orders
                    </a></li>
            </ul>

            <!-- <ul class="sidebar-list tab">

                <li class="sidebar-list-item tablinks active" onclick="openCity(event, 'dashboards')">
                    <span class="material-icons-outlined ">dashboard</span> Dashboard
                </li>
                <li class="sidebar-list-item tablinks" onclick="openCity(event, 'Products')">
                    <span class="material-icons-outlined">inventory_2</span> Products
                </li>
                <li class="sidebar-list-item tablinks" onclick="openCity(event, 'purchaseOrder')">
                    <
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
            </ul> -->
        </aside>

        <main class="main-container">
            <?php
            // Include the content based on the active tab
            $tabContentFile = $activeTab . '.php';
            // print_r($tabContentFile);
            if (file_exists($tabContentFile)) {
                include($tabContentFile);
            } else {
                echo 'File not found for tab: ' . $activeTab;
            }
            ?>


            <script src="assets/admin.js"></script>


</body>

</html>