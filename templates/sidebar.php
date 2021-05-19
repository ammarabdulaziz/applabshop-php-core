<head>
    <html lang="en" dir="ltr">
    <meta charset="UTF-8">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="templates/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="templates/bootstrap/bootstrap.min.css">
    <style>
        /* Google Font CDN Link */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            position: relative;
            min-height: 100vh;
            width: 100%;
            overflow: hidden;
        }

        ::selection {
            color: #fff;
            background: #2C3E50;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 78px;
            background: #2C3E50;
            padding: 6px 14px;
            z-index: 99;
            transition: all 0.5s ease;
        }

        .sidebar.active {
            width: 240px
        }

        .sidebar .logo_content .logo {
            color: #fff;
            display: flex;
            height: 50px;
            width: 100%;
            align-items: center;
            opacity: 0;
            pointer-events: none;
            transition: all 0.5s ease;
        }

        .sidebar.active .logo_content .logo {
            opacity: 1;
            pointer-events: none;
        }

        .logo_content .logo i {
            font-size: 28px;
            margin-right: 5px;
        }

        .logo_content .logo .logo_name {
            font-size: 20px;
            font-weight: 400;
        }

        .sidebar #btn {
            position: absolute;
            color: #fff;
            top: 6px;
            left: 50%;
            font-size: 22px;
            height: 50px;
            width: 50px;
            text-align: center;
            line-height: 50px;
            transform: translateX(-50%);
        }

        .sidebar.active #btn {
            left: 90%;
        }

        .sidebar ul {
            margin-top: 20px;
        }

        .sidebar ul li {
            position: relative;
            height: 50px;
            width: 100%;
            margin: 0 5px;
            list-style: none;
            line-height: 50px;
            margin: 5px 0;
        }

        .sidebar ul li .tooltip {
            position: absolute;
            left: 125px;
            top: 0;
            transform: translate(-50%, -50%);
            border-radius: 6px;
            height: 35px;
            width: 120px;
            background: #fff;
            line-height: 35px;
            text-align: center;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            transition: 0s;
            opacity: 0;
            pointer-events: none;
            display: block;
        }

        .sidebar.active ul li .tooltip {
            display: none;
        }

        .sidebar ul li:hover .tooltip {
            transition: all 0.5s ease;
            opacity: 1;
            top: 50%
        }

        .sidebar ul li input {
            position: absolute;
            height: 100%;
            width: 100%;
            left: 0;
            top: 0;
            border-radius: 12px;
            outline: none;
            border: none;
            background: #1d2d3e;
            padding-left: 50px;
            font-size: 18px;
            color: #fff;
        }

        .sidebar ul li .bx-search {
            position: absolute;
            z-index: 99;
            color: #fff;
            font-size: 22px;
            transition: all 0.5 ease;
        }

        .sidebar ul li .bx-search:hover {
            background: #fff;
            color: #1d2d3e;
        }

        .sidebar ul li a {
            color: #fff;
            display: flex;
            align-items: center;
            text-decoration: none;
            border-radius: 12px;
            white-space: nowrap;
            transition: all 0.4s ease;
        }

        .sidebar ul li a:hover {
            color: #2C3E50;
            background: #fff;
        }

        .sidebar ul li i {
            font-size: 18px;
            font-weight: 400;
            height: 50px;
            min-width: 50px;
            border-radius: 12px;
            line-height: 50px;
            text-align: center;
        }

        .sidebar .links_name {
            font-size: 15px;
            font-weight: 400;
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .sidebar.active .links_name {
            transition: 0s;
            opacity: 1;
            pointer-events: auto
        }

        .sidebar .profile_content {
            position: absolute;
            color: #fff;
            bottom: 0;
            left: 0;
            width: 100%;
        }

        .sidebar .profile_content .profile {
            position: relative;
            padding: 10px 6px;
            height: 60px;
            background: none;
            transition: all 0.4s ease;
        }

        .sidebar.active .profile_content .profile {
            background: #1d2d3e;
        }

        .profile_content .profile .profile_details {
            display: flex;
            align-items: center;
            opacity: 0;
            pointer-events: none;
            white-space: nowrap;
            transition: all 0.4s ease;
        }

        .sidebar.active~.profile .profile_details {
            opacity: 1;
            pointer-events: auto;
        }

        .profile .profile_details img {
            height: 45px;
            width: 45px;
            object-fit: cover;
            border-radius: 12px;
        }

        .profile .profile_details .name_job {
            color: #fff;
            margin-left: 10px;
        }

        .profile .profile_details .name {
            color: #fff;
            font-size: 15px;
            font-weight: 400;
        }

        .profile .profile_details .job {
            color: #fff;
            font-size: 12px;
        }

        .profile #log_out {
            position: absolute;
            bottom: 5px;
            left: 50%;
            transform: translateX(-50%);
            min-width: 50px;
            line-height: 50px;
            font-size: 20px;
            border-radius: 12px;
            text-align: center;
            transition: all 0.4s ease;
            background: #1d2d3e;
        }

        .sidebar.active .profile #log_out {
            left: 88%;
        }

        .sidebar.active .profile #log_out {
            background: none
        }

        .home_content {
            position: absolute;
            overflow-y: scroll;
            height: 100%;
            width: calc(100% - 78px);
            left: 78px;
            background: #fff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2px);
            transition: all 0.5s ease;
        }

        .sidebar.active~.home_content {
            z-index: 100;
        }

        .home_content .text {
            position: fixed;
            overflow: hidden;
            top: 0;
            width: 100%;
            font-size: 25px;
            font-weight: 500;
            color: #fff;
            background: #2C3E50;
        }

        .home_content .text p {
            padding: 12px;
        }

        .sidebar.active~.home_content {
            width: calc(100% - 240px);
            left: 240px;
        }

        ::-webkit-scrollbar {
            width: 0px;
            background: transparent;
            /* make scrollbar transparent */
        }
    </style>
</head>

<body>
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
                <a href="admin.php">
                    <i class='bx bx-mobile-alt'></i>
                    <span class="links_name">Products</span>
                </a>
                <span class="tooltip">Products</span>
            </li>
            <li>
                <a href="products-add.php">
                    <i class='bx bxs-cart-add'></i>
                    <span class="links_name">Add Products</span>
                </a>
                <span class="tooltip">Add</span>
            </li>
            <li>
                <a href="#">
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
                <a href="#">
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
                    <img src="profile.jpg" alt="">
                    <div class="name_job">
                        <div class="name">Prem Shahi</div>
                        <div class="job">Web Designer</div>
                    </div>
                </div>
                <i class='bx bx-log-out' id="log_out"></i>
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
            searchBtn.onclick = function() {
                sidebar.classList.toggle("active");
            }
            homeContent.onclick = function() {
                btn.classList.replace("bx-menu-alt-right", "bx-menu");
                sidebar.classList.remove("active");
            }
        </script>