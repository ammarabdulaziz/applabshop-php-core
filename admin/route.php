<?php
if (session_status() == PHP_SESSION_NONE) session_start();
if (!$_SESSION['admin']) header('Location: /applabshop/auth/login.php?login=false');

require_once(dirname(__DIR__) . '/database/DBController.php');
require('products/productController.php');
require('users/userController.php');
require('orders/orderController.php');

$productCtrl = new productController();
$userCtrl = new userController();
$orderCtrl = new orderController();

$base_url = '/applabshop/admin/';
// var_dump($_SERVER);
// print("<pre>" . print_r($_SERVER, true) . "</pre>");
// exit;

if ($_SERVER['SCRIPT_NAME'] == $base_url . 'products/index.php')  return $productCtrl->index();
if ($_SERVER['SCRIPT_NAME'] == $base_url . 'products/add.php') return $productCtrl->create();
if ($_SERVER['SCRIPT_NAME'] == $base_url . 'products/store.php') return $productCtrl->store();
if ($_SERVER['SCRIPT_NAME'] == $base_url . 'products/edit.php') return $productCtrl->update();
if ($_SERVER['SCRIPT_NAME'] == $base_url . 'products/change.php') return $productCtrl->change();
if ($_SERVER['SCRIPT_NAME'] == $base_url . 'products/delete.php') return $productCtrl->delete();

if ($_SERVER['SCRIPT_NAME'] == $base_url . 'users/index.php') return $userCtrl->index();
if ($_SERVER['SCRIPT_NAME'] == $base_url . 'orders/index.php') return $orderCtrl->index();
if ($_SERVER['SCRIPT_NAME'] == $base_url . 'orders/change.php') return $orderCtrl->change();
