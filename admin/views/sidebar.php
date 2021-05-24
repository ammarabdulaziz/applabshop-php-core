<?php
//if (session_status() == PHP_SESSION_NONE) session_start();
//if (!isset($_SESSION['admin'])) header('Location: login.php');
//require('functions.php');
?>

<head>
    <html lang="en" dir="ltr">
    <meta charset="UTF-8">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../public/stylesheets/sidebar.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <!-- <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div> -->
    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <i class='bx bxl-c-plus-plus'></i>
                <div class="logo_name">ApplabShop</div>
            </div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav_list" style="padding-left: 0px">
            <!-- <li>
                <i class='bx bx-search'></i>
                <input type="text" placeholder="Search...">
                <span class="tooltip">Search</span>
            </li> -->
            <li>
                <a href="#">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="/applabshop/admin/products/index.php">
                    <i class='bx bx-mobile-alt'></i>
                    <span class="links_name">Products</span>
                </a>
                <span class="tooltip">Products</span>
            </li>
            <!-- <li>
                <a href="products-add.php">
                    <i class='bx bxs-cart-add'></i>
                    <span class="links_name">Add Products</span>
                </a>
                <span class="tooltip">Add</span>
            </li> -->
            <li>
                <a href="/applabshop/admin/users/index.php">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Users</span>
                </a>
                <span class="tooltip">Users</span>
            </li>
            <!-- <li>
                <a href="#">
                    <i class='bx bx-folder'></i>
                    <span class="links_name">Orders</span>
                </a>
                <span class="tooltip">Orders</span>
            </li> -->
            <li>
                <a href="/applabshop/admin/orders/index.php">
                    <i class='bx bx-cart-alt'></i>
                    <span class="links_name">Orders</span>
                </a>
                <span class="tooltip">Orders</span>
            </li>
            <!-- <li>
                <a href="#">
                    <i class='bx bx-heart'></i>
                    <span class="links_name">Saved</span>
                </a>
                <span class="tooltip">Saved</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">Setting</span>
                </a>
                <span class="tooltip">Setting</span>
            </li> -->
        </ul>
        <div class="profile_content">
            <div class="profile">
                <div class="profile_details">
                    <img src="" alt="">
                    <div class="name_job">
                        <div class="name">Prem Shahi</div>
                        <div class="job">Web Designer</div>
                    </div>
                </div>
                <a href="logout.php"><i class='bx bx-log-out' id="log_out"></i></a>
            </div>
        </div>
    </div>
    <div class="home_content">
        <div class="text">
            <p style="margin-bottom: 0; font-weight: 200">Applab Shop</p>
        </div>



        <script>
            let btn = document.querySelector("#btn");
            let sidebar = document.querySelector(".sidebar");
            let searchBtn = document.querySelector(".bx-search");
            let homeContent = document.querySelector(".home_content");

            btn.onclick = function() {
                sidebar.classList.toggle("active");
                if (btn.classList.contains("bx-menu")) {
                    btn.classList.replace("bx-menu", "bx-menu-alt-right");
                } else {
                    btn.classList.replace("bx-menu-alt-right", "bx-menu");
                }
            }
            homeContent.onclick = function() {
                btn.classList.replace("bx-menu-alt-right", "bx-menu");
                sidebar.classList.remove("active");
            }
        </script>