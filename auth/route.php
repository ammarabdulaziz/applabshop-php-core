<?php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once(dirname(__DIR__) . '/database/DBController.php');
require('login/loginController.php');
require('login/registerController.php');

$loginCtrl = new loginController();
$registerCtrl = new registerController();

// var_dump($_SERVER);
// print("<pre>" . print_r($_SERVER, true) . "</pre>");
// exit;

if ($_SERVER['SCRIPT_NAME'] == '/applabshop/auth/login.php' && $_SERVER['REQUEST_METHOD'] == 'GET')  return $loginCtrl->index();
if ($_SERVER['SCRIPT_NAME'] == '/applabshop/auth/login.php' && $_SERVER['REQUEST_METHOD'] == 'POST')  return $loginCtrl->loginUser();

if ($_SERVER['SCRIPT_NAME'] == '/applabshop/auth/register.php' && $_SERVER['REQUEST_METHOD'] == 'GET')  return $registerCtrl->index();
if ($_SERVER['SCRIPT_NAME'] == '/applabshop/auth/register.php' && $_SERVER['REQUEST_METHOD'] == 'POST')  return $registerCtrl->registerUser();
