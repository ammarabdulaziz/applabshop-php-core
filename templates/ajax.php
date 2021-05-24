<?php

require('../database/DBController.php');
require('../database/Product.php');
require('../database/Cart.php');
require('../database/Order.php');

// $db = new DBController();
$Product = new Product();
$Cart = new Cart();
$Order = new Order();

if (session_status() == PHP_SESSION_NONE) session_start();

if (isset($_POST['deleteCart'])) {
    $result = $result = $Cart->deleteCart($_POST['product_id']);
    echo json_encode($result);
}

if (isset($_POST['qtyDec']) || isset($_POST['qtyInc'])) {
    $result = $Cart->updateQty($_POST['cart_id'], $_POST['count'], $_POST['item_id']);
    echo json_encode($result);
}

if (isset($_POST['addCart'])) {
    $result = $Cart->addToCart($_POST['product_id'], $_POST['price']);
    echo json_encode($result);
}

if (isset($_POST['getPrice'])) {
    $result = $Product->getProduct($_POST['item_id']);
    echo json_encode($result);
}

if (isset($_POST['deleteProduct'])) {
    $result = $Product->deleteProduct($_POST['id'], $_POST['image']);
    echo json_encode($result);
}

if (isset($_POST['updateOrderStatus'])) {
    $result = $Order->updateStatus($_POST['order_id'], $_POST['status']);
    echo json_encode($result);
}
