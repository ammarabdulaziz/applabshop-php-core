<?php
require('database/DBController.php');
require('database/User.php');
require('database/Product.php');
require('database/Cart.php');

$db = new DBController();
$User = new User($db);
$Product = new Product($db);
$Cart = new Cart($db);
