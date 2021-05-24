<?php
if (session_status() == PHP_SESSION_NONE) session_start();
require_once(dirname(__DIR__) . '/database/DBController.php');
require('products/productController.php');
require('cart/cartController.php');
require('orders/orderController.php');

$productCtrl = new productController();
$cartCtrl = new cartController();
$orderCtrl = new orderController();

$base_url = '/applabshop/user/';
// var_dump($_SERVER);
// print("<pre>" . print_r($_SERVER, true) . "</pre>");
// exit;

if ($_SERVER['SCRIPT_NAME'] == $base_url . 'products/index.php')  return $productCtrl->index();
if ($_SERVER['SCRIPT_NAME'] == $base_url . 'orders/index.php')  return $orderCtrl->index();


if (
    $_SERVER['SCRIPT_NAME'] == $base_url . 'cart/index.php'
    && isset($_SESSION['user_id'])
    && isset($_GET['checkout'])
    && $_GET['checkout'] == 'true'
    // && count($Cart->getCart()) != 0
) return $orderCtrl->checkout();
if ($_SERVER['SCRIPT_NAME'] == $base_url . 'cart/index.php')  return $cartCtrl->index();
