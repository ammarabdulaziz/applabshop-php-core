<?php
require('database/DBController.php');
require('database/Product.php');
require('database/Cart.php');

$db = new DBController();
$Product = new Product($db);
$Cart = new Cart($db);
