<?php
if (session_status() == PHP_SESSION_NONE) session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once(dirname(__DIR__) . '/database/DBController.php');
require_once(dirname(__DIR__) . '/api/controllers/productController.php');
require_once(dirname(__DIR__) . '/api/controllers/cartController.php');
require_once(dirname(__DIR__) . '/api/controllers/orderController.php');
require_once(dirname(__DIR__) . '/api/controllers/userController.php');

$productCtrl = new productController();
$cartCtrl = new cartController();
$orderCtrl = new orderController();
$userCtrl = new userController();

$base_url = '/applabshop/api/';
$url = $_SERVER['SCRIPT_NAME'];
$method = $_SERVER['REQUEST_METHOD'];
$query = $_SERVER['QUERY_STRING'];

// Product Routes
if ($url == $base_url . 'url/product.php') return
    $method == 'GET' && empty($query)
    ? $productCtrl->read()
    : (($method == 'GET')
        ? $productCtrl->readOne()
        : print_r(json_encode(['message' => 'Invalid request method'])));

// Order Routes
if ($url == $base_url . 'url/order.php') return
    $method == 'GET' && empty($query)
    ? $orderCtrl->read()
    : (($method == 'GET')
        ? $orderCtrl->readOne()
        : print_r(json_encode(['message' => 'Invalid request method'])));

// User Routes
if ($url == $base_url . 'url/user.php') return
    $method == 'GET' && empty($query)
    ? $userCtrl->read()
    : (($method == 'GET')
        ? $userCtrl->readOne()
        : print_r(json_encode(['message' => 'Invalid request method'])));

// Cart Routes
if ($url == $base_url . 'url/cart.php') return
    $method == 'GET' && empty($query)
    ? $cartCtrl->read()
    : (($method == 'GET')
        ? $cartCtrl->readOne()
        : (($method == 'POST')
            ? $cartCtrl->create()
            : (($method == 'PUT')
                ? $cartCtrl->update()
                : (($method == 'DELETE')
                    ? $cartCtrl->delete()
                    : print_r(json_encode(['message' => 'Invalid request method']))))));
