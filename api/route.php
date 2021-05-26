<?php
if (session_status() == PHP_SESSION_NONE) session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once(dirname(__DIR__) . '/database/DBController.php');
require_once(dirname(__DIR__) . '/auth/jwt_utils.php');
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


$bearer_token = get_bearer_token();
if (empty($bearer_token)) return print_r(json_encode(['message' => 'Access denied. No JWT found']));

$is_jwt_valid = is_jwt_valid($bearer_token);
if (!($is_jwt_valid)) return print_r(json_encode(array('error' => 'Access denied')));

$user_id = get_token_data($bearer_token, 'user_id');
$type = get_token_data($bearer_token, 'type');

// Order Routes
if ($url == $base_url . 'url/order.php') return
    $method == 'GET' && empty($query)
    ? $orderCtrl->read($user_id, $type)
    : (($method == 'GET')
        ? $orderCtrl->readOne($user_id, $type)
        : print_r(json_encode(['message' => 'Invalid request method'])));

// User Routes
if ($url == $base_url . 'url/user.php') return
    $method == 'GET' && empty($query)
    ? $userCtrl->read($user_id, $type)
    : (($method == 'GET')
        ? $userCtrl->readOne($user_id, $type)
        : print_r(json_encode(['message' => 'Invalid request method'])));

// Cart Routes
if ($url == $base_url . 'url/cart.php') return
    $method == 'GET' && empty($query)
    ? $cartCtrl->read($user_id, $type)
    : (($method == 'GET')
        ? $cartCtrl->readOne($user_id, $type)
        : (($method == 'POST')
            ? $cartCtrl->create($user_id, $type)
            : (($method == 'PUT')
                ? $cartCtrl->update($user_id, $type)
                : (($method == 'DELETE')
                    ? $cartCtrl->delete($user_id, $type)
                    : print_r(json_encode(['message' => 'Invalid request method']))))));
