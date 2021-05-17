<?php

require('../database/DBController.php');
require('../database/Product.php');
require('../database/Cart.php');

$db = new DBController();
$Product = new Product($db);
$Cart = new Cart($db);

if (isset($_POST['cart_id'])) {
    $result = $Cart->updateQty($_POST['cart_id'], $_POST['count']);
    echo json_encode($result);
}

if (isset($_POST['item_id'])) {
    $result = $Product->getProduct($_POST['item_id']);
    echo json_encode($result);
}
