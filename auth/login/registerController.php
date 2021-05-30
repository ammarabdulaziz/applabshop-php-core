<!-- 

if (session_status() == PHP_SESSION_NONE) session_start();
require('functions.php');

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

$errors = array('name' => '', 'username' => '', 'password' => '');
$checkout = isset($_GET['checkout']) && $_GET['checkout'] == 'true' ? true : null;

if (isset($_POST['submit'])) {

    if (empty($_POST['name'])) $errors['name'] = 'Name is empty';
    if (empty($_POST['username'])) $errors['username'] = 'Username is empty';
    if (empty($_POST['password'])) $errors['password'] = 'Password is empty';

    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    if (!array_filter($errors)) $errors['username'] = $User->createUser($name, $username, $password, $checkout, $errors);
}
 -->

<?php

require_once(dirname(__DIR__) . '/../database/User.php');

class registerController
{
    public $User;
    public function __construct()
    {
        $this->User = new User();
    }

    public function index()
    {
        // $users = $this->User->getData();
        // $User = $this->User;
        return include('./views/register.php');
    }

    public function registerUser()
    {
        $errors = array('name' => '', 'username' => '', 'password' => '');
        $checkout = isset($_GET['checkout']) && $_GET['checkout'] == 'true' ? true : null;

        if (isset($_POST['submit'])) {
            if (empty($_POST['name'])) $errors['name'] = 'Name is empty';
            if (empty($_POST['username'])) $errors['username'] = 'Username is empty';
            if (empty($_POST['password'])) $errors['password'] = 'Password is empty';
            if (empty($_POST['email'])) $errors['email'] = 'Email is empty';

            if (!array_filter($errors)) {
                $name = $_POST['name'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = md5($_POST['password']);

                $errors['username'] = $this->User->createUser($name, $username, $email, $password, $checkout, $errors);
                if (isset($errors)) return include('./views/register.php');
            } else {
                return include('./views/register.php');
            }
        }
    }
}
