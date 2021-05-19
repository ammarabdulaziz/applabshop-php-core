<?php

require('../database/DBController.php');
require('../database/Product.php');
require('../database/Cart.php');

$db = new DBController();
$Product = new Product($db);
$Cart = new Cart($db);

if (session_status() == PHP_SESSION_NONE) session_start();

if (isset($_POST['deleteCart'])) {
    $result = $result = $Cart->deleteCart($_POST['user_id'], $_POST['product_id']);
    echo json_encode($result);
}

if (isset($_POST['qtyDec']) || isset($_POST['qtyInc'])) {
    $result = $Cart->updateQty($_POST['cart_id'], $_POST['count'], $_POST['item_id']);
    echo json_encode($result);
}

if (isset($_POST['addCart'])) {
    $result = $Cart->addToCart($_POST['user_id'], $_POST['product_id']);
    echo json_encode($result);
}

if (isset($_POST['getPrice'])) {
    $result = $Product->getProduct($_POST['item_id']);
    echo json_encode($result);
}
