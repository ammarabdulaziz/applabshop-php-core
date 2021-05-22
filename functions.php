<?php

if (session_status() == PHP_SESSION_NONE) session_start();

require('database/DBController.php');
require('database/User.php');
require('database/Product.php');
require('database/Cart.php');
require('database/Order.php');

$db = new DBController();
$User = new User($db);
$Product = new Product($db);
$Cart = new Cart($db);
$Order = new Order($db);
