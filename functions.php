<?php
require('database/DBController.php');
$db = new DBController();

require('database/Product.php');
$product = new Product($db);
