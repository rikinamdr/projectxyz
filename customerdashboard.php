<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-5">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>customerdashboard</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="assets/header.css">
        <link rel="stylesheet" href="assets/customerdashboard.css">
    </head>
    <body>
        <header class="header">
            <a href="#" class="logo">XYZshoe</a>
            <div class="navbar">
                <a href="home.html">HOME</a>
                <a href="login.html">LOG IN</a>
                <a href="shop.html">SHOP</a>
                <a href="contactus.html">CONTACT</a>
                <a href="aboutus.html">ABOUT US</a>
            </div>
            <div class="navbar-icon" onclick="toggleNavbar()">
                <i class="bi bi-list"></i>
            </div>
        </header>
    
        <script>
            function toggleNavbar() {
                var navbar = document.querySelector('.navbar');
                navbar.classList.toggle('show');
            }
        </script>
        <aside id="sidebar">
            <div class="sidebar-title">
                <div class="sidebar-brand">
                    <span class="material-icons-outlined">account_circle</span>Jenisha
                </div>
                <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
            </div>

            <ul class="sidebar-list">
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">dashboard</span> Dashboard
                </li>
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">reorder</span> Orders
                </li>
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">history</span> History
                </li>
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">poll</span> Reports
                </li>
                <li class="sidebar-list-item">
                    <span class="material-icons-outlined">settings</span>Settings
                </li>
            </ul>
        </aside>
        
    </body>